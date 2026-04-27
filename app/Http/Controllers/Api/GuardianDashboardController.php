<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AssessmentAttempt;
use App\Models\AssessmentQuery;
use App\Models\Assignment;
use App\Models\AssignmentAttempt;
use App\Models\CoursesByStudent;
use App\Models\Guardian;
use App\Models\Student;
use Illuminate\Http\Request;

class GuardianDashboardController extends Controller
{
    //
   public function getStats(Request $request)
{
    $guardian = Guardian::find($request->user()->id);

    if (!$guardian) {
        return response()->json([
            'success' => false,
            'message' => 'Guardian not found'
        ], 404);
    }

    // Get all guardian records with same email (all students under this guardian)
    $guardianRecords = Guardian::where('email', $guardian->email)->get();

    // Get unique student IDs
    $studentIds = $guardianRecords
        ->pluck('student_id')
        ->filter() // Remove null values
        ->unique()
        ->values()
        ->toArray();

    $total_students = count($studentIds);

    // If no students found
    if ($total_students == 0) {
        return response()->json([
            'success' => true,
            'data' => [
                'total_students' => 0,
                'total_courses' => 0,
                'total_assessments' => 0,
                'total_assignments' => 0,
                'completed_courses' => 0,
                'in_progress_courses' => 0,
                'completed_assessments' => 0,
                'pending_assessments' => 0,
                'submitted_assignments' => 0,
                'pending_assignments' => 0,
                'average_completion_rate' => 0,
            ],
        ]);
    }

    // Get all student details
    $students = Student::whereIn('id', $studentIds)->get();
    $studentEmails = $students->pluck('email')->toArray();

    // Total courses across all students
    $total_courses = CoursesByStudent::whereIn('student_id', $studentIds)
        ->distinct('course_id')
        ->count('course_id');

    // Course progress stats
    $completed_courses = CoursesByStudent::whereIn('student_id', $studentIds)
        ->where('courses_by_students.status', 'completed')
        ->distinct('course_id')
        ->count('course_id');

    $in_progress_courses = CoursesByStudent::whereIn('student_id', $studentIds)
        ->where('courses_by_students.status', 'in-progress')
        ->distinct('course_id')
        ->count('course_id');

    // Total assessments (quizzes) across all students
    $total_assessments = AssessmentQuery::whereIn('email', $studentEmails)->count();

    $completed_assessments = AssessmentAttempt::whereIn('student_id', $studentIds)
        ->where('assessment_attempts.status', 'completed')
        ->count();

    $pending_assessments = AssessmentAttempt::whereIn('student_id', $studentIds)
        ->where('assessment_attempts.status', 'pending')
        ->count();

    // Get unique batch_ids from courses the students are enrolled in
    $batchIds = CoursesByStudent::whereIn('student_id', $studentIds)
        ->pluck('batch_id')
        ->unique()
        ->filter()
        ->values()
        ->toArray();

    // Total assignments across all students (based on batch_id)
    $total_assignments = Assignment::whereIn('batch_id', $batchIds)->count();

    // Get submitted assignments (has record in assignment_attempts with submitted_at)
    $submittedAssignmentIds = AssignmentAttempt::whereIn('student_id', $studentIds)
        ->whereNotNull('submitted_at')
        ->pluck('assignment_id')
        ->unique()
        ->toArray();

    $submitted_assignments = count($submittedAssignmentIds);

    // Pending assignments = total assignments - submitted assignments
    $pending_assignments = $total_assignments - $submitted_assignments;

    // Calculate average completion rate
    $average_completion_rate = 0;
    if ($total_courses > 0) {
        $average_completion_rate = round(($completed_courses / $total_courses) * 100, 2);
    }

    return response()->json([
        'success' => true,
        'data' => [
            'total_students' => $total_students,
            'total_courses' => $total_courses,
            'total_assessments' => $total_assessments,
            'total_assignments' => $total_assignments,
            'completed_courses' => $completed_courses,
            'in_progress_courses' => $in_progress_courses,
            'completed_assessments' => $completed_assessments,
            'pending_assessments' => $pending_assessments,
            'submitted_assignments' => $submitted_assignments,
            'pending_assignments' => $pending_assignments,
            'average_completion_rate' => $average_completion_rate,
        ],
    ]);
}
}
