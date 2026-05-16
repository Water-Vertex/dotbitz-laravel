<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\QuizAttempt;
use App\Models\AssignmentAttempt;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GradeController extends Controller
{
    // Admin — saare courses
    public function adminCourses()
    {
        $courses = \App\Models\Course::select('id', 'course_name', 'thumbnail_image')
            ->orderBy('course_name')
            ->get();

        return response()->json(['success' => true, 'data' => $courses]);
    }

    // Instructor — assigned courses
    public function instructorCourses()
    {
        $user       = Auth::user();
        $instructor = \App\Models\Instructor::where('email', $user->email)->first();

        if (!$instructor) {
            return response()->json(['success' => false, 'message' => 'Instructor not found.'], 404);
        }

        $courseIds = \App\Models\CourseInstructor::where('instructor_id', $instructor->id)
            ->pluck('course_id');

        $courses = \App\Models\Course::whereIn('id', $courseIds)
            ->select('id', 'course_name', 'thumbnail_image')
            ->orderBy('course_name')
            ->get();

        return response()->json(['success' => true, 'data' => $courses]);
    }

    // Batches by course
    public function batchesByCourse($courseId)
    {
        $batches = \App\Models\Batch::where('course_id', $courseId)
            ->select('id', 'name')
            ->get();

        return response()->json(['success' => true, 'data' => $batches]);
    }

    // Students of batch with grade summary
public function batchStudents($courseId, $batchId)
{
    try {
        $enrolledIds = DB::table('courses_by_students')
            ->where('course_id', $courseId)
            ->where('batch_id', $batchId)
            ->pluck('student_id');

        // Use correct columns from your students table
        $students = Student::whereIn('id', $enrolledIds)
            ->select('id', 'first_name', 'last_name', 'email', 'student_uid', 'phone')  // Removed profile_image, added student_uid
            ->get()
            ->map(function($student) use ($courseId) {

                // Quiz summary
                $quizAttempts = QuizAttempt::where('student_id', $student->id)
                    ->where('is_checked', true)
                    ->whereHas('quiz', fn($q) => $q->where('course_id', $courseId))
                    ->whereIn('status', ['completed', 'time_up', 'expired'])
                    ->with('quiz')
                    ->get();

                $quizTotal    = $quizAttempts->sum(fn($a) => (float)($a->quiz->marks ?? 0));
                $quizObtained = $quizAttempts->sum(fn($a) => (float)($a->obtained_marks ?? 0));
                $quizPercent  = $quizTotal > 0 ? round(($quizObtained / $quizTotal) * 100) : null;

                // Assignment summary
                $assignmentIds = Assignment::where('course_id', $courseId)->pluck('id');
                $assignAttempts = AssignmentAttempt::where('student_id', $student->id)
                    ->whereIn('assignment_id', $assignmentIds)
                    ->whereNotNull('marks')
                    ->with('assignment')
                    ->get();

                $assignTotal    = $assignAttempts->sum(fn($a) => (float)($a->assignment->total_marks ?? 0));
                $assignObtained = $assignAttempts->sum(fn($a) => (float)($a->marks ?? 0));
                $assignPercent  = $assignTotal > 0 ? round(($assignObtained / $assignTotal) * 100) : null;

                // Overall
                $overallTotal    = $quizTotal + $assignTotal;
                $overallObtained = $quizObtained + $assignObtained;
                $overallPercent  = $overallTotal > 0 ? round(($overallObtained / $overallTotal) * 100) : null;

                return [
                    'student_id'       => $student->id,
                    'student_uid'      => $student->student_uid,
                    'first_name'       => $student->first_name,
                    'last_name'        => $student->last_name,
                    'email'            => $student->email,
                    'phone'            => $student->phone,
                    'profile_image'    => null, // No profile image in table
                    'quiz_total'       => $quizTotal,
                    'quiz_obtained'    => $quizObtained,
                    'quiz_percent'     => $quizPercent,
                    'quiz_count'       => $quizAttempts->count(),
                    'assign_total'     => $assignTotal,
                    'assign_obtained'  => $assignObtained,
                    'assign_percent'   => $assignPercent,
                    'assign_count'     => $assignAttempts->count(),
                    'overall_total'    => $overallTotal,
                    'overall_obtained' => $overallObtained,
                    'overall_percent'  => $overallPercent,
                ];
            });

        return response()->json(['success' => true, 'data' => $students]);
        
    } catch (\Exception $e) {
        \Log::error('Error in batchStudents: ' . $e->getMessage(), [
            'course_id' => $courseId,
            'batch_id' => $batchId,
            'trace' => $e->getTraceAsString()
        ]);
        
        return response()->json([
            'success' => false,
            'message' => 'Error loading students: ' . $e->getMessage(),
            'data' => []
        ], 500);
    }
}

    // Student detail — full grade breakdown
 public function studentDetail($courseId, $studentId)
{
    // Use correct columns from your students table
    $student = Student::select('id', 'first_name', 'last_name', 'email', 'student_uid', 'phone', 'date_of_birth', 'gender', 'address', 'state', 'city', 'zipcode', 'status')
        ->find($studentId);

    if (!$student) {
        return response()->json(['success' => false, 'message' => 'Student not found.'], 404);
    }

    // Quiz details
    $quizAttempts = QuizAttempt::where('student_id', $studentId)
        ->where('is_checked', true)
        ->whereHas('quiz', fn($q) => $q->where('course_id', $courseId))
        ->whereIn('status', ['completed', 'time_up', 'expired'])
        ->with('quiz')
        ->orderBy('updated_at', 'desc')
        ->get()
        ->map(function($attempt) {
            $total    = (float)($attempt->quiz->marks ?? 0);
            $obtained = (float)($attempt->obtained_marks ?? 0);
            $percent  = $total > 0 ? round(($obtained / $total) * 100) : 0;
            return [
                'quiz_name'      => $attempt->quiz->name ?? '-',
                'total_marks'    => $total,
                'obtained_marks' => $obtained,
                'percent'        => $percent,
                'status'         => $attempt->status,
                'is_overdue'     => $attempt->is_overdue,
                'remarks'        => $attempt->remarks,
            ];
        });

    // Assignment details
    $assignmentIds  = Assignment::where('course_id', $courseId)->pluck('id');
    $assignAttempts = AssignmentAttempt::where('student_id', $studentId)
        ->whereIn('assignment_id', $assignmentIds)
        ->whereNotNull('marks')
        ->with('assignment')
        ->orderBy('updated_at', 'desc')
        ->get()
        ->map(function($attempt) {
            $total    = (float)($attempt->assignment->total_marks ?? 0);
            $obtained = (float)($attempt->marks ?? 0);
            $percent  = $total > 0 ? round(($obtained / $total) * 100) : 0;
            return [
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
        'data'    => [
            'student'     => $student,
            'quizzes'     => $quizAttempts,
            'assignments' => $assignAttempts,
        ],
    ]);
}
}