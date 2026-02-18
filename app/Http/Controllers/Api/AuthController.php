<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Guardian;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /* ================= USER LOGIN ================= */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        $token = $user->createToken('user_token',['user'])->plainTextToken;

        return response()->json([
            'success' => true,
            'type' => 'user',
            'user' => $user,
            'token' => $token
        ]);
    }

    /* ================= GUARDIAN LOGIN ================= */
    public function guardianLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $guardian = Guardian::where('email', $request->email)->first();

        if (!$guardian || !Hash::check($request->password, $guardian->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        $token = $guardian->createToken('guardian_token',['guardian'])->plainTextToken;

        return response()->json([
            'success' => true,
            'type' => 'guardian',
            'guardian' => $guardian,
            'token' => $token
        ]);
    }

    /* ================= STUDENT LOGIN ================= */
    public function studentLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $student = Student::where('email', $request->email)->first();

        if (!$student || !Hash::check($request->password, $student->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        $token = $student->createToken('student_token',['student'])->plainTextToken;

        return response()->json([
            'success' => true,
            'type' => 'student',
            'student' => $student,
            'token' => $token
        ]);
    }

    /* ================= LOGOUT (FOR ANY TYPE) ================= */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully'
        ]);
    }
}
