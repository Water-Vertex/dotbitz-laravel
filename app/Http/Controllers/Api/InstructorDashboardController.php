<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use App\Models\Course;
use App\Models\CourseInstructor;
use App\Models\CoursesByStudent;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorDashboardController extends Controller
{
    //
    public function getStats(Request $request)
    {
        $instructorId = $request->user()->id;
        $totalCourses = CourseInstructor::where('instructor_id', $instructorId)->count();
        $totalBatches = Batch::where('instructor_id', $instructorId)->count();
        $totalStudents = CoursesByStudent::whereHas('batch', function($query) use ($instructorId) {
            $query->where('instructor_id', $instructorId);
        })->count();

        return response()->json([
            'success' => true,
            'data' => [
                'total_students' => $totalStudents,
                'total_batches' => $totalBatches,
                'total_courses' => $totalCourses,
            ],
        ]);
    }
}
