<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CoursesByStudent;
use Illuminate\Http\Request;

class CoursesByStudentController extends Controller
{
    /**
     * Get all enrolled courses of logged-in student
     */
    public function myEnrolledCourses(Request $request)
    {
        $student = $request->user();


        $enrolledCourses = CoursesByStudent::where('student_id', $student->id)
            ->with(['course.instructor'])
            ->orderBy('enrolled_at', 'desc')
            ->get();

        $data = $enrolledCourses->map(function ($enrollment) {
            return [
                'enrollment_id' => $enrollment->id,
                'status'        => $enrollment->status,
                'enrolled_at'   => $enrollment->enrolled_at,
                'completed_at'  => $enrollment->completed_at,
                'course'        => $enrollment->course ? [
                    'id'              => $enrollment->course->id,
                    'course_name'     => $enrollment->course->course_name,
                    'course_level'    => $enrollment->course->course_level,
                    'course_duration' => $enrollment->course->course_duration,
                    'course_fee'      => $enrollment->course->course_fee,
                    'start_date'      => $enrollment->course->start_date,
                    'thumbnail_image' => $enrollment->course->thumbnail_image,
                    'status'          => $enrollment->course->status,
                    'instructor'      => $enrollment->course->instructor ? [
                        'first_name' => $enrollment->course->instructor->first_name,
                        'last_name'  => $enrollment->course->instructor->last_name,
                        'title'      => $enrollment->course->instructor->title,
                    ] : null,
                ] : null,
            ];
        });

        return response()->json([
            'success' => true,
            'total'   => $data->count(),
            'data'    => $data,
        ]);
    }

    /**
     * Get single enrollment detail
     */
    public function show(Request $request, $id)
    {
        $enrollment = CoursesByStudent::where('student_id', $request->user()->id)
            ->with(['course.instructor'])
            ->find($id);

        if (!$enrollment) {
            return response()->json([
                'success' => false,
                'message' => 'Enrollment not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $enrollment,
        ]);
    }

     public function getCoursesByStudentForGuardian($student_id)
    {
        // Fetch courses with course relation
        $courses = CoursesByStudent::with('course')
            ->where('student_id', $student_id)
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $courses
        ]);
    }
}
