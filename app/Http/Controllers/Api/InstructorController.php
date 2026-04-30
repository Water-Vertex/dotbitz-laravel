<?php

// app/Http/Controllers/Api/InstructorController.php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InstructorController extends Controller
{
    public function index(Request $request)
    {
       $query = Instructor::query();

        // Optional search
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%");
            });
        }


        $instructors = $query->orderBy('id', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $instructors
        ]);
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'first_name' => 'required|string|min:2',
        'last_name' => 'required|string|min:2',
        'email' => 'required|email|unique:instructors,email',
        'phone' => 'nullable|unique:instructors,phone',
        'password' => 'required|min:6',
        'gender' => 'nullable|string|max:255',
        'address' => 'nullable|string|max:255',
        'state' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',
        'zipcode' => 'nullable|string|max:255',
        'work_experience' => 'nullable|string|max:50',
        'salary' => 'nullable|string|max:50',
        'status' => 'nullable|string|max:255',

        'details' => 'required|array|min:1',
        'details.*.institution' => 'required|string|max:255',
        'details.*.degree' => 'required|string|max:255',
        'details.*.field_of_study' => 'nullable|string|max:255',
        'details.*.start_date' => 'required|date',
        'details.*.end_date' => 'nullable|date',
        'details.*.is_current' => 'boolean',
        'details.*.description' => 'nullable|string'
    ]);

    DB::beginTransaction();

    try {
        $validated['password'] = Hash::make($validated['password']);
        $validated['instructor_uid'] = 'DB-'.uniqid();
        $instructor = Instructor::create($validated);

        foreach ($validated['details'] as $detail) {
            $instructor->details()->create($detail);
        }

        DB::commit();

        return response()->json([
            'success' => true,
            'data' => $instructor->load('details'),
            'message' => 'Instructor and details saved successfully'
        ]);

    } catch (\Exception $e) {
        DB::rollBack();

        return response()->json([
            'success' => false,
            'message' => 'Failed to save instructor',
            'error' => $e->getMessage()
        ], 500);
    }
}

    public function show($id)
    {
        $instructor = Instructor::with('details')->findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $instructor
        ]);
    }

    public function update(Request $request, $id)
{
    $instructor = Instructor::findOrFail($id);

    $validated = $request->validate([
        'first_name' => 'required|string|min:2',
        'last_name' => 'required|string|min:2',
        'email' => 'required|email|unique:instructors,email,' . $id,
        'phone' => 'nullable|unique:instructors,phone,' . $id,
        'gender' => 'nullable|string|max:255',
        'address' => 'nullable|string|max:255',
        'state' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',
        'zipcode' => 'nullable|string|max:255',
        'work_experience' => 'nullable|string|max:50',
        'salary' => 'nullable|string|max:50',
        'status' => 'nullable|string|max:255',

        'details' => 'required|array|min:1',
        'details.*.institution' => 'required|string|max:255',
        'details.*.degree' => 'required|string|max:255',
        'details.*.field_of_study' => 'nullable|string|max:255',
        'details.*.start_date' => 'required|date',
        'details.*.end_date' => 'nullable|date',
        'details.*.is_current' => 'boolean',
        'details.*.description' => 'nullable|string'
    ]);

    DB::beginTransaction();

    try {
        $instructor->update($validated);

        // Remove old details
        $instructor->details()->delete();

        // Insert new details
        foreach ($validated['details'] as $detail) {
            $instructor->details()->create($detail);
        }

        DB::commit();

        return response()->json([
            'success' => true,
            'data' => $instructor->load('details'),
            'message' => 'Instructor updated successfully'
        ]);

    } catch (\Exception $e) {
        DB::rollBack();

        return response()->json([
            'success' => false,
            'message' => 'Update failed',
            'error' => $e->getMessage()
        ], 500);
    }
}


    public function destroy($id)
    {
        Instructor::findOrFail($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Instructor deleted successfully'
        ]);
    }

    public function profile(Request $request)
    {
        $instructor = $request->user(); // logged-in instructor

        return response()->json([
            'id' => $instructor->id,
            'instructor_uid' => $instructor->instructor_uid,
            'first_name' => $instructor->first_name,
            'last_name' => $instructor->last_name,
            'user_name' => $instructor->user_name,
            'email' => $instructor->email,
            'phone' => $instructor->phone,
            'date_of_birth' => $instructor->date_of_birth,
            'gender' => $instructor->gender,
            'address' => $instructor->address,
            'zipcode' => $instructor->zipcode,
            'city' => $instructor->city,
            'state' => $instructor->state,
        ]);
    }

    public function updateProfile(Request $request)
    {
        $instructor = $request->user(); // Get authenticated instructor

        // Validation
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'user_name' => 'required|string|max:255|unique:instructors,user_name,' . $instructor->id,
            'email' => 'required|email|unique:instructors,email,' . $instructor->id,
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string|max:255',
            'zipcode' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
        ]);

        // Update instructor
        $instructor->update($validated);

        return response()->json([
            'message' => 'Profile updated successfully',
            'data' => $instructor
        ], 200);
    }

    // InstructorController.php mein add karein
public function resetPassword(Request $request)
{
    $instructor = $request->user(); // Authenticated instructor

    $request->validate([
        'new_password' => 'required|min:6',
        'confirm_password' => 'required|same:new_password'
    ]);

    try {
        $instructor->password = Hash::make($request->new_password);
        $instructor->save();

        return response()->json([
            'success' => true,
            'message' => 'Password updated successfully'
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to update password',
            'error' => $e->getMessage()
        ], 500);
    }
}
}
