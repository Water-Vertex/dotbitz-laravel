<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\QuizAttempt;
use App\Models\AssignmentAttempt;
use App\Models\Assignment;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    // Student k enrolled courses
    public function myCourses()
    {
        $user      = Auth::user();
        $student   = Student::where('email', $user->email)->first();
        $studentId = $student ? $student->id : $user->id;

        $enrollments = DB::table('courses_by_students')
            ->where('student_id', $studentId)
            ->join('courses', 'courses.id', '=', 'courses_by_students.course_id')
            ->select(
                'courses.id',
                'courses.course_name',
                'courses.thumbnail_image',
                'courses.course_level',
                'courses.course_duration'
            )
            ->distinct()
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $enrollments,
        ]);
    }

    // Quiz results — sirf checked wale
    public function quizResults($courseId)
    {
        $user      = Auth::user();
        $student   = Student::where('email', $user->email)->first();
        $studentId = $student ? $student->id : $user->id;

        $attempts = QuizAttempt::with('quiz')
            ->where('student_id', $studentId)
            ->where('is_checked', true)
            ->whereHas('quiz', function($q) use ($courseId) {
                $q->where('course_id', $courseId);
            })
            ->whereIn('status', ['completed', 'time_up', 'expired'])
            ->orderBy('updated_at', 'desc')
            ->get()
            ->map(function($attempt) {
                $total    = (float)($attempt->quiz->marks ?? 0);
                $obtained = (float)($attempt->obtained_marks ?? 0);
                $percent  = $total > 0
                    ? round(($obtained / $total) * 100)
                    : 0;

                return [
                    'attempt_id'     => $attempt->id,
                    'quiz_id'        => $attempt->quiz_id,
                    'quiz_name'      => $attempt->quiz->name ?? '-',
                    'total_marks'    => $total,
                    'obtained_marks' => $obtained,
                    'percent'        => $percent,
                    'status'         => $attempt->status,
                    'is_overdue'     => $attempt->is_overdue,
                    'remarks'        => $attempt->remarks,
                ];
            });

        return response()->json([
            'success' => true,
            'data'    => $attempts,
        ]);
    }

    // Assignment results — sirf graded wale
    public function assignmentResults($courseId)
    {
        $user      = Auth::user();
        $student   = Student::where('email', $user->email)->first();
        $studentId = $student ? $student->id : $user->id;

        $assignmentIds = Assignment::where('course_id', $courseId)->pluck('id');

        $attempts = AssignmentAttempt::with('assignment')
            ->where('student_id', $studentId)
            ->whereIn('assignment_id', $assignmentIds)
            ->whereNotNull('marks')
            ->orderBy('updated_at', 'desc')
            ->get()
            ->map(function($attempt) {
                $total    = (float)($attempt->assignment->total_marks ?? 0);
                $obtained = (float)($attempt->marks ?? 0);
                $percent  = $total > 0
                    ? round(($obtained / $total) * 100)
                    : 0;

                return [
                    'attempt_id'      => $attempt->id,
                    'assignment_name' => $attempt->assignment->title ?? '-',
                    'total_marks'     => $total,
                    'obtained_marks'  => $obtained,
                    'percent'         => $percent,
                    'is_late'         => $attempt->is_late,
                    'remarks'         => $attempt->remarks,
                    'submitted_at'    => $attempt->submitted_at,
                ];
            });

        return response()->json([
            'success' => true,
            'data'    => $attempts,
        ]);
    }

     public function guardianStudentCourses($studentId)
    {
        // Verify that this student actually belongs to the logged-in guardian
        $guardian = Auth::user();

        if ((int) $guardian->student_id !== (int) $studentId) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $enrollments = DB::table('courses_by_students')
            ->where('student_id', $studentId)
            ->join('courses', 'courses.id', '=', 'courses_by_students.course_id')
            ->select(
                'courses.id',
                'courses.course_name',
                'courses.thumbnail_image',
                'courses.course_level',
                'courses.course_duration'
            )
            ->distinct()
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $enrollments,
        ]);
    }

    /**
     * Guardian side quiz results for a student.
     * GET /api/guardian/results/quiz/{studentId}/{courseId}
     */
    public function guardianQuizResults($studentId, $courseId)
    {
        $guardian = Auth::user();

        if ((int) $guardian->student_id !== (int) $studentId) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        return response()->json([
            'success' => true,
            'data'    => $this->fetchQuizResults($studentId, $courseId),
        ]);
    }

    /**
     * Guardian side assignment results for a student.
     * GET /api/guardian/results/assignment/{studentId}/{courseId}
     */
    public function guardianAssignmentResults($studentId, $courseId)
    {
        $guardian = Auth::user();

        if ((int) $guardian->student_id !== (int) $studentId) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        return response()->json([
            'success' => true,
            'data'    => $this->fetchAssignmentResults($studentId, $courseId),
        ]);
    }
 private function fetchQuizResults(int $studentId, int $courseId)
{
    return QuizAttempt::with('quiz')
        ->where('student_id', $studentId)
        ->where('is_checked', true)
        ->whereHas('quiz', function ($q) use ($courseId) {
            $q->where('course_id', $courseId);
        })
        ->whereIn('status', ['completed', 'time_up', 'expired'])
        ->orderBy('updated_at', 'desc')
        ->get()
        ->map(function ($attempt) {
            $total    = (float) ($attempt->quiz->marks ?? 0);
            $obtained = (float) ($attempt->obtained_marks ?? 0);
            $percent  = $total > 0 ? round(($obtained / $total) * 100) : 0;

            return [
                'attempt_id'     => $attempt->id,
                'quiz_id'        => $attempt->quiz_id,
                'quiz_name'      => $attempt->quiz->name ?? '-',
                'total_marks'    => $total,
                'obtained_marks' => $obtained,
                'percent'        => $percent,
                'status'         => $attempt->status,
                'is_overdue'     => $attempt->is_overdue,
                'remarks'        => $attempt->remarks,
            ];
        });
}
 private function fetchAssignmentResults(int $studentId, int $courseId)
{
    $assignmentIds = Assignment::where('course_id', $courseId)->pluck('id');

    return AssignmentAttempt::with('assignment')
        ->where('student_id', $studentId)
        ->whereIn('assignment_id', $assignmentIds)
        ->whereNotNull('marks')
        ->orderBy('updated_at', 'desc')
        ->get()
        ->map(function ($attempt) {
            $total    = (float) ($attempt->assignment->total_marks ?? 0);
            $obtained = (float) ($attempt->marks ?? 0);
            $percent  = $total > 0 ? round(($obtained / $total) * 100) : 0;

            return [
                'attempt_id'      => $attempt->id,
                'assignment_name' => $attempt->assignment->title ?? '-',
                'total_marks'     => $total,
                'obtained_marks'  => $obtained,
                'percent'         => $percent,
                'is_late'         => $attempt->is_late,
                'remarks'         => $attempt->remarks,
                'submitted_at'    => $attempt->submitted_at,
            ];
        });
}
}
