<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\CoursesByStudent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Services\StripeService;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    protected $stripeService;

    public function __construct(StripeService $stripeService)
    {
        $this->stripeService = $stripeService;
    }

    /**
     * Validate coupon code
     */
    public function validateCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string',
        ]);

        $coupon = Coupon::where('code', $request->coupon_code)
            ->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('valid_until')
                  ->orWhere('valid_until', '>=', now());
            })
            ->where(function ($q) {
                $q->whereNull('valid_from')
                  ->orWhere('valid_from', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('usage_limit')
                  ->orWhereColumn('used_count', '<', 'usage_limit');
            })
            ->first();

        if (!$coupon) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid or expired coupon code.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Coupon applied successfully.',
            'data' => [
                'coupon_code'    => $coupon->code,
                'discount_type'  => $coupon->discount_type,
                'discount_value' => $coupon->discount_amount,
            ]
        ]);
    }

    /**
     * Store order for guardian (parent purchasing for student)
     */
    public function GuardianOrderstore(Request $request)
    {
        $request->validate([
            'guardian_id'      => 'required|exists:guardians,id',
            'student_id'       => 'required|exists:students,id',
            'course_id'        => 'required|exists:courses,id',
            'batch_id'         => 'required|exists:batches,id',
            'sub_amount'       => 'required|numeric',
            'total_amount'     => 'required|numeric',
            'payment_method'   => 'required|string',
            'discount'         => 'nullable|numeric',
            'coupon_code'      => 'nullable|string',
            'note'             => 'nullable|string',
            'is_financed'      => 'nullable|boolean',
            'finance_id'       => 'required_if:is_financed,true|nullable|string',
            'finance_provider' => 'required_if:is_financed,true|nullable|string',
            'success_url'      => 'required_if:payment_method,stripe|nullable|url',
            'cancel_url'       => 'required_if:payment_method,stripe|nullable|url',
        ]);

        try {
            return DB::transaction(function () use ($request) {

                // 1. Already enrolled check
                $alreadyEnrolled = CoursesByStudent::where('student_id', $request->student_id)
                    ->where('course_id', $request->course_id)
                    ->where('status', 'enrolled')
                    ->exists();

                if ($alreadyEnrolled) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Student already enrolled in this course.',
                    ], 422);
                }

                // 2. Batch limit check
                $batch = Batch::findOrFail($request->batch_id);
                if ($batch->students !== null) {
                    $enrolledCount = CoursesByStudent::where('batch_id', $request->batch_id)
                        ->where('status', 'enrolled')
                        ->count();

                    if ($enrolledCount >= $batch->students) {
                        return response()->json([
                            'success' => false,
                            'message' => 'This batch is full. No more enrollments allowed.',
                        ], 422);
                    }
                }

                // 3. Coupon check
                if ($request->coupon_code) {
                    $coupon = Coupon::where('code', $request->coupon_code)
                        ->where('is_active', true)
                        ->where(function ($q) {
                            $q->whereNull('valid_until')
                              ->orWhere('valid_until', '>=', now());
                        })
                        ->where(function ($q) {
                            $q->whereNull('valid_from')
                              ->orWhere('valid_from', '<=', now());
                        })
                        ->where(function ($q) {
                            $q->whereNull('usage_limit')
                              ->orWhereColumn('used_count', '<', 'usage_limit');
                        })
                        ->lockForUpdate()
                        ->first();

                    if (!$coupon) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Coupon code is no longer valid.',
                        ], 422);
                    }

                    $coupon->increment('used_count');
                }

                // 4. Order create
                $order = Order::create([
                    'order_number'     => 'ORD-' . date('Ymd') . '-' . strtoupper(Str::random(6)),
                    'guardian_id'      => $request->guardian_id,
                    'student_id'       => $request->student_id,
                    'sub_amount'       => $request->sub_amount,
                    'total_amount'     => $request->total_amount,
                    'discount'         => $request->discount ?? 0,
                    'coupon_code'      => $request->coupon_code,
                    'payment_method'   => $request->payment_method,
                    'status'           => 'pending',
                    'payment_status'   => 'pending',
                    'note'             => $request->note,
                    'is_financed'      => $request->is_financed ?? false,
                    'finance_id'       => $request->finance_id,
                    'finance_provider' => $request->finance_provider,
                    'ordered_at'       => now(),
                ]);

                // 5. Order detail
                OrderDetail::create([
                    'order_id'   => $order->id,
                    'course_id'  => $request->course_id,
                    'student_id' => $request->student_id,
                    'price'      => $request->total_amount,
                ]);

                // 6. Enrollment (temporary until payment is confirmed for Stripe)
                // For non-Stripe payments, enroll immediately
                if ($request->payment_method !== 'stripe') {
                    CoursesByStudent::create([
                        'course_id'   => $request->course_id,
                        'student_id'  => $request->student_id,
                        'batch_id'    => $request->batch_id,
                        'order_id'    => $order->id,
                        'enrolled_at' => now(),
                        'status'      => 'enrolled',
                    ]);

                    return response()->json([
                        'success' => true,
                        'message' => 'Order placed and course enrolled successfully.',
                        'data'    => $order,
                    ], 201);
                } else {
                    // For Stripe, create enrollment with pending status
                    CoursesByStudent::create([
                        'course_id'   => $request->course_id,
                        'student_id'  => $request->student_id,
                        'batch_id'    => $request->batch_id,
                        'order_id'    => $order->id,
                        'enrolled_at' => null,
                        'status'      => 'pending_payment',
                    ]);

                    // Create Stripe Checkout Session
                    $checkoutUrl = $this->createStripeCheckoutSession($order, $request->success_url, $request->cancel_url);

                    if (!$checkoutUrl) {
                        throw new \Exception('Failed to create Stripe checkout session');
                    }
                    
                    

                    return response()->json([
                        'success' => true,
                        'message' => 'Redirect to Stripe checkout.',
                        'data' => [
                            'order' => $order,
                            'checkout_url' => $checkoutUrl,
                            'redirect' => true
                        ],
                    ], 201);
                }
            });

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store order for student (self purchase)
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id'        => 'required|exists:courses,id',
            'batch_id'         => 'required|exists:batches,id',
            'sub_amount'       => 'required|numeric',
            'total_amount'     => 'required|numeric',
            'payment_method'   => 'required|string',
            'discount'         => 'nullable|numeric',
            'coupon_code'      => 'nullable|string',
            'note'             => 'nullable|string',
            'is_financed'      => 'nullable|boolean',
            'finance_id'       => 'required_if:is_financed,true|nullable|string',
            'finance_provider' => 'required_if:is_financed,true|nullable|string',
            'success_url'      => 'required_if:payment_method,stripe|nullable|url',
            'cancel_url'       => 'required_if:payment_method,stripe|nullable|url',
        ]);

        // 1. Already enrolled check
        $alreadyEnrolled = CoursesByStudent::where('student_id', Auth::user()->id)
            ->where('course_id', $request->course_id)
            ->where('status', 'enrolled')
            ->exists();

        if ($alreadyEnrolled) {
            return response()->json([
                'success' => false,
                'message' => 'You are already enrolled in this course.',
            ], 409);
        }

        // 2. Batch limit check
        $batch = Batch::findOrFail($request->batch_id);
        if ($batch->students !== null) {
            $enrolledCount = CoursesByStudent::where('batch_id', $request->batch_id)
                ->where('status', 'enrolled')
                ->count();

            if ($enrolledCount >= $batch->students) {
                return response()->json([
                    'success' => false,
                    'message' => 'This batch is full. No more enrollments allowed.',
                ], 422);
            }
        }

        // 3. Coupon check
        if ($request->coupon_code) {
            $coupon = Coupon::where('code', $request->coupon_code)
                ->where('is_active', true)
                ->where(function ($q) {
                    $q->whereNull('valid_until')
                      ->orWhere('valid_until', '>=', now());
                })
                ->where(function ($q) {
                    $q->whereNull('valid_from')
                      ->orWhere('valid_from', '<=', now());
                })
                ->where(function ($q) {
                    $q->whereNull('usage_limit')
                      ->orWhereColumn('used_count', '<', 'usage_limit');
                })
                ->lockForUpdate()
                ->first();

            if (!$coupon) {
                return response()->json([
                    'success' => false,
                    'message' => 'Coupon code is invalid or expired.',
                ], 422);
            }

            $coupon->increment('used_count');
        }

        try {
            DB::beginTransaction();

            // 4. Order create
            $order = Order::create([
                'order_number'     => 'ORD-' . date('Ymd') . '-' . strtoupper(Str::random(6)),
                'student_id'       => Auth::user()->id,
                'sub_amount'       => $request->sub_amount,
                'total_amount'     => $request->total_amount,
                'discount'         => $request->discount ?? 0,
                'coupon_code'      => $request->coupon_code,
                'payment_method'   => $request->payment_method,
                'status'           => 'pending',
                'payment_status'   => 'pending',
                'note'             => $request->note,
                'is_financed'      => $request->is_financed ?? false,
                'finance_id'       => $request->finance_id,
                'finance_provider' => $request->finance_provider,
                'ordered_at'       => now(),
            ]);

            // 5. Order detail
            OrderDetail::create([
                'order_id'   => $order->id,
                'course_id'  => $request->course_id,
                'student_id' => Auth::user()->id,
                'price'      => $request->total_amount,
            ]);

            // 6. Enrollment (temporary until payment is confirmed for Stripe)
            if ($request->payment_method !== 'stripe') {
                CoursesByStudent::create([
                    'course_id'   => $request->course_id,
                    'student_id'  => Auth::user()->id,
                    'batch_id'    => $request->batch_id,
                    'order_id'    => $order->id,
                    'enrolled_at' => now(),
                    'status'      => 'enrolled',
                ]);

                DB::commit();

                return response()->json([
                    'success' => true,
                    'message' => 'Order placed successfully.',
                    'data'    => $order->load('orderDetails.course'),
                ], 201);
            } else {
                // For Stripe, create enrollment with pending status
                CoursesByStudent::create([
                    'course_id'   => $request->course_id,
                    'student_id'  => Auth::user()->id,
                    'batch_id'    => $request->batch_id,
                    'order_id'    => $order->id,
                    'enrolled_at' => null,
                    'status'      => 'pending_payment',
                ]);

                DB::commit();

                // Create Stripe Checkout Session
                $checkoutUrl = $this->createStripeCheckoutSession($order, $request->success_url, $request->cancel_url);

                if (!$checkoutUrl) {
                    throw new \Exception('Failed to create Stripe checkout session');
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Redirect to Stripe checkout.',
                    'data' => [
                        'order' => $order,
                        'checkout_url' => $checkoutUrl,
                        'redirect' => true
                    ],
                ], 201);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Order failed: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Create Stripe Checkout Session
     */
    private function createStripeCheckoutSession($order, $successUrl, $cancelUrl)
    {
        try {
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

            // Get course details from order detail
            $orderDetail = OrderDetail::where('order_id', $order->id)->first();
            $courseName = $orderDetail->course->name ?? 'Course Enrollment';

            // Prepare line items
            $lineItems = [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $courseName,
                            'description' => 'Order #' . $order->order_number,
                            'metadata' => [
                                'order_id' => $order->id,
                                'order_number' => $order->order_number,
                            ]
                        ],
                        'unit_amount' => $order->total_amount * 100, // Convert to cents
                    ],
                    'quantity' => 1,
                ],
            ];

            // Add discount if coupon applied
            if ($order->discount > 0) {
                // You can add coupon handling here if needed
            }

            // Create checkout session
            $session = $stripe->checkout->sessions->create([
                'success_url' => $successUrl . '?session_id={CHECKOUT_SESSION_ID}&order_id=' . $order->id,
                'cancel_url' => $cancelUrl . '?order_id=' . $order->id,
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'metadata' => [
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                    'student_id' => $order->student_id,
                ],
                'customer_email' => Auth::user()->email ?? null,
                'payment_intent_data' => [
                    'metadata' => [
                        'order_id' => $order->id,
                        'order_number' => $order->order_number,
                    ]
                ],
            ]);

            // Store checkout session ID in order
            $order->update([
                'checkout_session_id' => $session->id,
            ]);

            return $session->url;

        } catch (\Exception $e) {
            Log::error('Stripe Checkout Session Error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Handle Stripe Webhook
     */
    public function handleStripeWebhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $webhookSecret = config('services.stripe.webhook_secret');

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sigHeader,
                $webhookSecret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response()->json(['error' => 'Invalid payload'], 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response()->json(['error' => 'Invalid signature'], 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                $this->handleCheckoutSessionCompleted($session);
                break;

            case 'checkout.session.expired':
                $session = $event->data->object;
                $this->handleCheckoutSessionExpired($session);
                break;

            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object;
                $this->handleSuccessfulPayment($paymentIntent);
                break;

            case 'payment_intent.payment_failed':
                $paymentIntent = $event->data->object;
                $this->handleFailedPayment($paymentIntent);
                break;

            case 'charge.refunded':
                $charge = $event->data->object;
                $this->handleRefundedPayment($charge);
                break;

            default:
                Log::info('Received unknown event type: ' . $event->type);
        }

        return response()->json(['received' => true]);
    }

    /**
     * Handle checkout session completed
     */
    protected function handleCheckoutSessionCompleted($session)
    {
        try {
            DB::transaction(function () use ($session) {
                $orderId = $session->metadata->order_id ?? null;

                if (!$orderId) {
                    Log::warning('No order_id in checkout session metadata', ['session_id' => $session->id]);
                    return;
                }

                $order = Order::where('id', $orderId)
                    ->lockForUpdate()
                    ->first();

                if ($order && $order->status !== 'paid') {
                    // Get payment intent details
                    $paymentIntentId = $session->payment_intent;

                    // Update order
                    $order->update([
                        'status' => 'paid',
                        'payment_status' => 'succeeded',
                        'payment_intent_id' => $paymentIntentId,
                        'paid_at' => now(),
                    ]);

                    // Update enrollment from pending to enrolled
                    $enrollment = CoursesByStudent::where('order_id', $order->id)
                        ->where('status', 'pending_payment')
                        ->first();

                    if ($enrollment) {
                        $enrollment->update([
                            'enrolled_at' => now(),
                            'status' => 'enrolled',
                        ]);
                    }

                    Log::info('Payment successful for order', ['order_id' => $order->id, 'order_number' => $order->order_number]);

                    // Send email notification
                    // Mail::to($order->student->email)->send(new OrderPaidMail($order));
                }
            });
        } catch (\Exception $e) {
            Log::error('Failed to handle checkout session completed: ' . $e->getMessage());
        }
    }

    /**
     * Handle checkout session expired
     */
    protected function handleCheckoutSessionExpired($session)
    {
        try {
            $orderId = $session->metadata->order_id ?? null;

            if ($orderId) {
                $order = Order::find($orderId);

                if ($order && $order->status === 'pending') {
                    DB::transaction(function () use ($order) {
                        $order->update([
                            'status' => 'expired',
                            'payment_status' => 'expired',
                        ]);

                        // Delete pending enrollment
                        CoursesByStudent::where('order_id', $order->id)
                            ->where('status', 'pending_payment')
                            ->delete();

                        // Refund coupon usage if applicable
                        if ($order->coupon_code) {
                            $coupon = Coupon::where('code', $order->coupon_code)->first();
                            if ($coupon) {
                                $coupon->decrement('used_count');
                            }
                        }
                    });
                }
            }
        } catch (\Exception $e) {
            Log::error('Failed to handle checkout session expired: ' . $e->getMessage());
        }
    }

    /**
     * Handle successful payment
     */
    protected function handleSuccessfulPayment($paymentIntent)
    {
        try {
            DB::transaction(function () use ($paymentIntent) {
                $order = Order::where('payment_intent_id', $paymentIntent->id)
                    ->lockForUpdate()
                    ->first();

                // If order not found by payment_intent_id, try to find by metadata
                if (!$order && isset($paymentIntent->metadata->order_id)) {
                    $order = Order::where('id', $paymentIntent->metadata->order_id)
                        ->lockForUpdate()
                        ->first();
                }

                if ($order && $order->status !== 'paid') {
                    // Update order
                    $order->update([
                        'status' => 'paid',
                        'payment_status' => 'succeeded',
                        'paid_at' => now(),
                    ]);

                    // Update enrollment from pending to enrolled
                    $enrollment = CoursesByStudent::where('order_id', $order->id)
                        ->where('status', 'pending_payment')
                        ->first();

                    if ($enrollment) {
                        $enrollment->update([
                            'enrolled_at' => now(),
                            'status' => 'enrolled',
                        ]);
                    }

                    Log::info('Payment successful for order via payment_intent', ['order_id' => $order->id]);
                }
            });
        } catch (\Exception $e) {
            Log::error('Failed to handle successful payment: ' . $e->getMessage());
        }
    }

    /**
     * Handle failed payment
     */
    protected function handleFailedPayment($paymentIntent)
    {
        try {
            $order = Order::where('payment_intent_id', $paymentIntent->id)->first();

            if ($order) {
                $order->update([
                    'payment_status' => 'failed',
                    'status' => 'failed',
                ]);

                // Delete or mark as cancelled the pending enrollment
                CoursesByStudent::where('order_id', $order->id)
                    ->where('status', 'pending_payment')
                    ->delete();

                Log::info('Payment failed for order', ['order_id' => $order->id]);

                // Send email notification about failed payment
                // Mail::to($order->student->email)->send(new PaymentFailedMail($order));
            }
        } catch (\Exception $e) {
            Log::error('Failed to handle failed payment: ' . $e->getMessage());
        }
    }

    /**
     * Handle refunded payment
     */
    protected function handleRefundedPayment($charge)
    {
        try {
            $paymentIntentId = $charge->payment_intent;

            if ($paymentIntentId) {
                $order = Order::where('payment_intent_id', $paymentIntentId)->first();

                if ($order) {
                    DB::transaction(function () use ($order) {
                        $order->update([
                            'status' => 'refunded',
                            'payment_status' => 'refunded',
                        ]);

                        // Update enrollment status
                        CoursesByStudent::where('order_id', $order->id)
                            ->update([
                                'status' => 'refunded',
                                'enrolled_at' => null,
                            ]);

                        Log::info('Order refunded', ['order_id' => $order->id]);

                        // Send email notification about refund
                        // Mail::to($order->student->email)->send(new OrderRefundedMail($order));
                    });
                }
            }
        } catch (\Exception $e) {
            Log::error('Failed to handle refunded payment: ' . $e->getMessage());
        }
    }

    /**
     * Verify Stripe payment after redirect
     */
    public function verifyPayment(Request $request)
    {
        $request->validate([
            'session_id' => 'required|string',
            'order_id' => 'required|exists:orders,id',
        ]);

        $order = Order::find($request->order_id);
        $orderdetails = OrderDetail::where('order_id', $order->id)->first();
        $course = $orderdetails->course_id;
        $student = $orderdetails->student_id;

        // Check if order belongs to authenticated user
        if ($order->student_id !== Auth::user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized.',
            ], 403);
        }

        try {
            $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
            $session = $stripe->checkout->sessions->retrieve($request->session_id);

            if ($session->payment_status === 'paid') {
                // Order should already be updated via webhook, but just in case
                if ($order->status !== 'paid') {
                    $order->update([
                        'status' => 'paid',
                        'payment_status' => 'succeeded',
                        'paid_at' => now(),
                    ]);

                    // Update enrollment
                    CoursesByStudent::where([
                        'course_id' => $course,
                        'student_id' => $student,
                        'payment_status' => 'pending_payment',
                    ])
                        
                        ->update([
                            'enrolled_at' => now(),
                            'status' => 'enrolled',
                            'payment_status' => 'paid',
                        ]);
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Payment verified successfully.',
                    'data' => [
                        'order' => $order,
                        'payment_status' => 'paid'
                    ]
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment not completed.',
                    'data' => [
                        'payment_status' => $session->payment_status
                    ]
                ], 422);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to verify payment: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Process refund for an order
     */
    public function refundOrder(Request $request, $orderId)
    {
        $request->validate([
            'amount' => 'nullable|numeric|min:0',
            'reason' => 'nullable|string',
        ]);

        $order = Order::findOrFail($orderId);

        // Check if order is paid
        if ($order->status !== 'paid') {
            return response()->json([
                'success' => false,
                'message' => 'Only paid orders can be refunded.',
            ], 422);
        }

        // Check if already refunded
        if ($order->status === 'refunded') {
            return response()->json([
                'success' => false,
                'message' => 'Order already refunded.',
            ], 422);
        }

        // Check if order has payment intent
        if (!$order->payment_intent_id) {
            return response()->json([
                'success' => false,
                'message' => 'No payment record found for this order.',
            ], 422);
        }

        $refundAmount = $request->amount ? $request->amount * 100 : null;

        $result = $this->stripeService->refundPayment(
            $order->payment_intent_id,
            $refundAmount
        );

        if (!$result['success']) {
            return response()->json([
                'success' => false,
                'message' => $result['message'],
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Refund processed successfully.',
            'data' => [
                'refund_id' => $result['refund_id'],
                'order_id' => $order->id,
            ],
        ]);
    }

    /**
     * Get payment status for an order
     */
    public function getPaymentStatus($orderId)
    {
        $order = Order::where('student_id', Auth::user()->id)
            ->find($orderId);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'status' => $order->status,
                'payment_status' => $order->payment_status,
                'paid_at' => $order->paid_at,
                'amount' => $order->total_amount,
            ],
        ]);
    }

    /**
     * List student orders
     */
    public function index()
    {
        $orders = Order::where('student_id', Auth::user()->id)
            ->with(['orderDetails.course', 'coursesByStudent.batch'])
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $orders,
        ]);
    }

    /**
     * Show specific order
     */
    public function show($id)
    {
        $order = Order::where('student_id', Auth::user()->id)
            ->with(['orderDetails.course', 'coursesByStudent.batch'])
            ->find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $order,
        ]);
    }

    /**
     * Cancel pending order
     */
    public function cancelOrder($orderId)
    {
        $order = Order::where('student_id', Auth::user()->id)
            ->where('status', 'pending')
            ->find($orderId);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order not found or cannot be cancelled.',
            ], 404);
        }

        try {
            DB::transaction(function () use ($order) {
                $order->update([
                    'status' => 'cancelled',
                ]);

                // Delete pending enrollment
                CoursesByStudent::where('order_id', $order->id)
                    ->where('status', 'pending_payment')
                    ->delete();

                // If coupon was used, decrement usage count
                if ($order->coupon_code) {
                    $coupon = Coupon::where('code', $order->coupon_code)->first();
                    if ($coupon) {
                        $coupon->decrement('used_count');
                    }
                }
            });

            return response()->json([
                'success' => true,
                'message' => 'Order cancelled successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to cancel order: ' . $e->getMessage(),
            ], 500);
        }
    }


    
}
