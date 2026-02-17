<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Guardian;

class GuardianController extends Controller
{
    /**
     * Return the authenticated guardian's profile.
     */
    public function index()
    {
        // Get the currently logged-in guardian
        $guardian = Auth::guard('guardian')->user();

        if (!$guardian) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        // Return important fields only
        return response()->json([
            'id' => $guardian->id,
            'first_name' => $guardian->first_name,
            'last_name' => $guardian->last_name,
            'email' => $guardian->email,
            'phone' => $guardian->phone,
            'gender' => $guardian->gender,
            'address' => $guardian->address,
            'city' => $guardian->city,
            'state' => $guardian->state,
            'zipcode' => $guardian->zipcode,
            'status' => $guardian->status,
             'relationship' => $guardian->relationship,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request)
    {
        // 1. Get the user
        $user = Auth::guard('guardian')->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $guardian = Guardian::find($user->id);

        if (!$guardian) {
            return response()->json(['message' => 'Guardian record not found'], 404);
        }
        $validatedData = $request->validate([
            'first_name' => 'nullable|string|max:100',
            'last_name'  => 'nullable|string|max:100',
            'email'      => 'nullable|email|unique:guardians,email,' . $guardian->id,
            'phone'      => 'nullable|string|max:20',
            'gender'     => 'nullable|in:male,female,other',
            'address'    => 'nullable|string|max:255',
            'city'       => 'nullable|string|max:255',
            'state'      => 'nullable|string|max:255',
            'zipcode'    => 'nullable|string|max:255',
        ]);
        $guardian->update($validatedData);

        return response()->json([
            'message' => 'Profile updated successfully',
            'data' => $guardian
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
