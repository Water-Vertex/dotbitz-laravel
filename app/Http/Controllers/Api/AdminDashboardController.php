<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AssessmentQuery;
use App\Models\Guardian;
use App\Models\Instructor;
use App\Models\Student;
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminDashboardController extends Controller
{
    //
    public function getStats()
    {
        $totalStudents = Student::count();
        $totalInstructors = Instructor::count();
        $totalGuardians = Guardian::count();
        $totalAssessmentsQueries = AssessmentQuery::count();

        return response()->json([
            'success' => true,
            'data' => [
                'total_students' => $totalStudents,
                'total_instructors' => $totalInstructors,
                'total_guardians' => $totalGuardians,
                'total_assessments_queries' => $totalAssessmentsQueries,
            ],
        ]);
    }


    public function resetPassword(Request $request)
    {
        // 1. Validation
        $validator = Validator::make($request->all(), [
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // 2. Get Authenticated Admin (User table)
            $admin = $request->user(); 

            // 3. Update Password
            $admin->password = Hash::make($request->new_password);
            $admin->save();

            return response()->json([
                'success' => true,
                'message' => 'Admin password updated successfully!'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server Error',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
