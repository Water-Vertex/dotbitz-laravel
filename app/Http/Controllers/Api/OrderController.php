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

class OrderController extends Controller
{
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

                // 6. Enrollment
                CoursesByStudent::create([
                    'course_id'   => $request->course_id,
                    'student_id'  => $request->student_id,
                    'batch_id'    => $request->batch_id,
                    'enrolled_at' => now(),
                    'status'      => 'enrolled',
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Order placed and course enrolled successfully.',
                    'data'    => $order,
                ], 201);
            });

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }

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
        ]);

        // 1. Already enrolled check
        $alreadyEnrolled = CoursesByStudent::where('student_id', Auth::user()->id)
            ->where('course_id', $request->course_id)
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
                    $q->whereNull('usage_limit')
                      ->orWhereColumn('used_count', '<', 'usage_limit');
                })
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
                'note'             => $request->note,
                'is_financeed'     => $request->is_financed ?? false,
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

            // 6. Enrollment
            CoursesByStudent::create([
                'course_id'   => $request->course_id,
                'student_id'  => Auth::user()->id,
                'batch_id'    => $request->batch_id,
                'enrolled_at' => now(),
                'status'      => 'enrolled',
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully.',
                'data'    => $order->load('orderDetails.course'),
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Order failed: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function index()
    {
        $orders = Order::where('student_id', Auth::user()->id)
            ->with('orderDetails.course')
            ->orderBy('id', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $orders,
        ]);
    }

    public function show($id)
    {
        $order = Order::where('student_id', Auth::user()->id)
            ->with('orderDetails.course')
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
}