<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $coupons = Coupon::all();

        return response()->json($coupons);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'code' => 'required|string|min:2|max:50|unique:coupons,code',
            'discount_type' => 'required|in:fixed,percentage',
            'usage_limit' => 'nullable|integer|min:1',
            'used_count'  => 'nullable|integer|min:0',
            'description' => 'required|string|min:2|max:500',
            'is_active' => 'required|boolean',
            'valid_from'  => 'required|date',
            'valid_until' => 'required|date|after_or_equal:valid_from',
        ]);

        $coupon = Coupon::create($validated);

        return response()->json($coupon);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $coupon = Coupon::find($id);

        if (!$coupon) {
            return response()->json([
                'success' => false,
                'message' => 'coupon not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $coupon,  // Wrap in 'data' property
            'message' => 'Coupon retrieved successfully'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $coupon = Coupon::find($id);

        if (!$coupon) {
            return response()->json([
                'success' => false,
                'message' => 'Coupon not found'
            ], 404);
        }

        $validated = $request->validate([
            'code' => [
                'required',
                'string',
                'min:2',
                'max:50',
                Rule::unique('coupons', 'code')->ignore($id),
            ],
            'discount_type' => 'required|in:fixed,percentage',
            'usage_limit' => 'nullable|integer|min:1',
            'used_count'  => 'nullable|integer|min:0',
            'description' => 'required|string|min:2|max:500',
            'is_active' => 'required|boolean',
            'valid_from'  => 'required|date',
            'valid_until' => 'required|date|after_or_equal:valid_from',
        ]);

        $coupon->update($validated);

        return response()->json($coupon);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Coupon::findOrFail($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Coupon deleted successfully'
        ]);
    }
}
