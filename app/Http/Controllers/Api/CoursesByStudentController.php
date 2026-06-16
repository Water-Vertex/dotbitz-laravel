<?php

// namespace App\Http\Controllers\Api;

// use App\Http\Controllers\Controller;
// use App\Models\CoursesByStudent;
// use App\Models\Student;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Log;

// class CoursesByStudentController extends Controller
// {
//     /**
//      * Get all enrolled courses of logged-in student
//      */
//     public function myEnrolledCourses(Request $request)
//     {
//         $student = $request->user();


//         $enrolledCourses = CoursesByStudent::where('student_id', $student->id)
//             ->with(['course.instructor'])
//             ->orderBy('enrolled_at', 'desc')
//             ->get();

//         $data = $enrolledCourses->map(function ($enrollment) {
//             return [

//                 'enrollment_id' => $enrollment->id,
//                 'status'        => $enrollment->status,
//                 'enrolled_at'   => $enrollment->enrolled_at,
//                 'completed_at'  => $enrollment->completed_at,
//                 'course'        => $enrollment->course ? [
//                     'id'              => $enrollment->course->id,
//                     'course_name'     => $enrollment->course->course_name,
//                     'course_level'    => $enrollment->course->course_level,
//                     'course_duration' => $enrollment->course->course_duration,
//                     'course_fee'      => $enrollment->course->course_fee,
//                     'start_date'      => $enrollment->course->start_date,
//                     'thumbnail_image' => $enrollment->course->thumbnail_image,
//                     'status'          => $enrollment->course->status,
//                     'instructor'      => $enrollment->course->instructor ? [
//                         'first_name' => $enrollment->course->instructor->first_name,
//                         'last_name'  => $enrollment->course->instructor->last_name,
//                         'title'      => $enrollment->course->instructor->title,
//                     ] : null,
//                 ] : null,
//             ];
//         });

//         return response()->json([
//             'success' => true,
//             'total'   => $data->count(),
//             'data'    => $data,
//         ]);
//     }

//     /**
//      * Get single enrollment detail
//      */

// public function show(Request $request, $courseId)
// {
//     $courseByStudent = CoursesByStudent::where('student_id', $request->user()->id)
//         ->where('course_id', $courseId)
//         ->with(['course.instructor'])
//         ->first();

//     if (!$courseByStudent) {
//         return response()->json([
//             'success' => false,
//             'message' => 'You are not enrolled in this course.',
//         ], 404);
//     }

//     $course = $courseByStudent->course;
    
//     // 🔍 DEBUG: Log the batch_id value
//     Log::info('=== DEBUG ===');
//     Log::info('Batch ID from DB: ' . $courseByStudent->batch_id);
//     Log::info('Course ID: ' . $courseId);
//     Log::info('Student ID: ' . $request->user()->id);

//     return response()->json([
//         'success' => true,
//         'data' => [
//             'batch_id' => $courseByStudent->batch_id,  // ← Ye value log mein check karo
//             'debug_check' => $courseByStudent->batch_id, // Extra field for debugging
            
//             // Course details
//             'id' => $course->id,
//             'course_name' => $course->course_name,
//             'course_code' => $course->course_code,
//             'course_level' => $course->course_level,
//             'course_duration' => $course->course_duration,
//             'course_fee' => $course->course_fee,
//             'course_description' => $course->course_description,
//             'short_description' => $course->short_description,
//             'benefits' => $course->benefits,
//             'age_limit' => $course->age_limit,
//             'thumbnail_image' => $course->thumbnail_image,
//             'start_date' => $course->start_date,
//             'end_date' => $course->end_date,
//             'status' => $course->status,
//             'is_featured' => $course->is_featured,
//             'slug' => $course->slug,
//             'instructor_id' => $course->instructor_id,
//             'created_at' => $course->created_at,
//             'updated_at' => $course->updated_at,
//             'instructor' => $course->instructor ? [
//                 'first_name' => $course->instructor->first_name,
//                 'last_name' => $course->instructor->last_name,
//                 'title' => $course->instructor->title,
//             ] : null,
//         ]
//     ]);
// }
//      public function getCoursesByStudentForGuardian($student_id)
//     {
//         // Fetch courses with course relation
//         $courses = CoursesByStudent::with('course')
//             ->where('student_id', $student_id)
//             ->get();

//         return response()->json([
//             'success' => true,
//             'data'    => $courses
//         ]);
//     }

//     public function getstudents($id)
//     {
//         // 1️⃣ Get all student IDs for the course
//         $studentIds = CoursesByStudent::where('course_id', $id)
//                         ->pluck('student_id'); // gives array of IDs

//         // 2️⃣ Fetch student details from students table
//         $students = Student::whereIn('id', $studentIds)->get();

//         // 3️⃣ Return response
//         return response()->json([
//             'success' => true,
//             'data' => $students
//         ]);
//     }
// }


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CoursesByStudent;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

     // new update
    public function show(Request $request, $courseId)
    {
        $courseByStudent = CoursesByStudent::where('student_id', $request->user()->id)
            ->where('course_id', $courseId)
            ->with([
                'course.instructor',
                'course.curriculums', //   // new update
            ])
            ->first();

        if (!$courseByStudent) {
            return response()->json([
                'success' => false,
                'message' => 'You are not enrolled in this course.',
            ], 404);
        }

        $course = $courseByStudent->course;

        Log::info('=== DEBUG ===');
        Log::info('Batch ID from DB: ' . $courseByStudent->batch_id);
        Log::info('Course ID: ' . $courseId);
        Log::info('Student ID: ' . $request->user()->id);

        return response()->json([
            'success' => true,
            'data'    => [
                'batch_id'           => $courseByStudent->batch_id,
                'debug_check'        => $courseByStudent->batch_id,

                // Course details
                'id'                 => $course->id,
                'course_name'        => $course->course_name,
                'course_code'        => $course->course_code,
                'course_level'       => $course->course_level,
                'course_duration'    => $course->course_duration,
                'course_fee'         => $course->course_fee,
                'course_description' => $course->course_description,
                'short_description'  => $course->short_description,
                'benefits'           => $course->benefits,
                'age_limit'          => $course->age_limit,
                'thumbnail_image'    => $course->thumbnail_image,
                'start_date'         => $course->start_date,
                'end_date'           => $course->end_date,
                'status'             => $course->status,
                'is_featured'        => $course->is_featured,
                'slug'               => $course->slug,
                'instructor_id'      => $course->instructor_id,
                'created_at'         => $course->created_at,
                'updated_at'         => $course->updated_at,

                // Instructor
                'instructor'         => $course->instructor ? [
                    'first_name' => $course->instructor->first_name,
                    'last_name'  => $course->instructor->last_name,
                    'title'      => $course->instructor->title,
                ] : null,

                //  ADDED: Curriculums 
                'curriculums'        => $course->curriculums->map(function ($item) {
                    return [
                        'id'             => $item->id,
                        'title'          => $item->title,
                        'description'    => $item->description,
                        'duration'       => $item->duration,
                        'sorting_order'  => $item->sorting_order,
                    ];
                }),
            ],
        ]);
    }
  // new update
    public function getCoursesByStudentForGuardian($student_id)
    {
        $courses = CoursesByStudent::with([
                'course',
                'course.curriculums', //   // new update
            ])
            ->where('student_id', $student_id)
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $courses,
        ]);
    }

    /**
     * Get students enrolled in a course
     */
    public function getstudents($id)
    {
        $studentIds = CoursesByStudent::where('course_id', $id)
            ->pluck('student_id');

        $students = Student::whereIn('id', $studentIds)->get();

        return response()->json([
            'success' => true,
            'data'    => $students,
        ]);
    }
}