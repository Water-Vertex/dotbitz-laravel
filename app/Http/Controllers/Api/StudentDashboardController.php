<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AssessmentQuery;
use App\Models\AssessmentAttempt;
use App\Models\Assignment;
use App\Models\AssignmentAttempt;
use App\Models\Batch;
use App\Models\CoursesByStudent;
use App\Models\Quiz;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    public function getStats(Request $request)
    {
        $student = Student::find($request->user()->id);

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found'
            ], 404);
        }

        // Get student ID and email
        $studentId = $student->id;
        $studentEmail = $student->email;

        // Total courses for this student
        $total_courses = CoursesByStudent::where('student_id', $studentId)->count();

        // Course progress stats
        $completed_courses = CoursesByStudent::where('student_id', $studentId)
            ->where('status', 'completed')
            ->count();

        $in_progress_courses = CoursesByStudent::where('student_id', $studentId)
            ->where('status', 'in-progress')
            ->count();

        // Total assessments (quizzes) across all students
        $total_assessments = AssessmentQuery::where('email', $studentEmail)->count();

        $completed_assessments = AssessmentAttempt::where('student_id', $studentId)
            ->where('status', 'completed')
            ->count();

        $pending_assessments = AssessmentAttempt::where('student_id', $studentId)
            ->where('status', 'pending')
            ->count();

        // Get unique batch_ids from courses the student is enrolled in
        $batchIds = CoursesByStudent::where('student_id', $studentId)
            ->pluck('batch_id')
            ->unique()
            ->filter()
            ->values()
            ->toArray();

        // Total assignments for this student (based on batch_id)
        $total_assignments = Assignment::whereIn('batch_id', $batchIds)->count();

        // Get submitted assignments (has record in assignment_attempts with submitted_at)
        $submitted_assignments = AssignmentAttempt::where('student_id', $studentId)
            ->whereNotNull('submitted_at')
            ->count();

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
