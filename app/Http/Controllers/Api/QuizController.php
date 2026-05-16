<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizMcq;
use App\Models\Mcq;
use App\Models\QuizAttempt;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class QuizController extends Controller
{
//      public function getByBatch($batchId)
// {
//     $quizzes = Quiz::with(['mcqs'])
//         ->where('batch_id', $batchId)
//         ->where('status', 'active')
//         ->orderBy('created_at', 'desc')
//         ->get();

//     return response()->json([
//         'success' => true,
//         'data'    => $quizzes,
//     ]);
// }
public function getByBatch($batchId)
{
    try {
        $now = now();

        $quizzes = Quiz::where('batch_id', $batchId)
            ->where('status', 'active')
            ->where(function($q) use ($now) {
                $q->whereNull('start_date')
                  ->orWhere('start_date', '<=', $now);
            })
          ->with(['mcqs' => function($q) {
    $q->select('mcqs.id', 'mcqs.question', 'mcqs.is_single', 'mcqs.marks');
}])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $quizzes,
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error'   => $e->getMessage(),
            'line'    => $e->getLine(),
            'file'    => $e->getFile(),
        ], 500);
    }
}
    public function instructorIndex(Request $request)
{
    $user = Auth::user();

    // Instructor model se id nikalo
    $instructor = \App\Models\Instructor::where('email', $user->email)->first();

    if (!$instructor) {
        return response()->json([
            'success' => false,
            'message' => 'Instructor not found.',
        ], 404);
    }

    // Instructor ke courses ki IDs nikalo
    $courseIds = \App\Models\CourseInstructor::where('instructor_id', $instructor->id)
        ->pluck('course_id');

    $quizzes = Quiz::with(['course', 'batch', 'mcqs'])
        ->whereIn('course_id', $courseIds)
        ->orderBy('created_at', 'desc')
        ->get();

    return response()->json([
        'success' => true,
        'data'    => $quizzes,
    ]);
}
    // List all quizzes
    public function index(Request $request)
    {
        $query = Quiz::with(['course', 'batch', 'mcqs']);

        if ($request->has('course_id') && $request->course_id) {
            $query->where('course_id', $request->course_id);
        }

        $quizzes = $query->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data'    => $quizzes,
        ]);
    }

    // Show single quiz
    public function show($id)
    {
        $quiz = Quiz::with(['course', 'batch', 'mcqs'])->find($id);

        if (!$quiz) {
            return response()->json([
                'success' => false,
                'message' => 'Quiz not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $quiz,
        ]);
    }

    // Store quiz
    public function store(Request $request)
    {

        $request->validate([
            'name'      => 'required|string',
            'marks'     => 'required',
            'duration'  => 'required|integer',
            'status'    => 'required|in:active,inactive,draft',
            'course_id' => 'required|exists:courses,id',
            'batch_id'  => 'required|exists:batches,id',
            'due_date'  => 'required|date',
            'mcq_ids'   => 'required|array|min:1',
            'mcq_ids.*' => 'exists:mcqs,id', // ✅ FIXED
        ]);

        $quiz = Quiz::create([
            'name'      => $request->name,
            'marks'     => $request->marks,
            'duration'  => $request->duration,
            'status'    => $request->status,
            'course_id' => $request->course_id,
            'batch_id'  => $request->batch_id,
            'due_date'  => $request->due_date,
        ]);

        foreach($request->mcq_ids as $mcq_id)
        {
             QuizMcq::create([
                'quiz_id' => $quiz->id,
                'mcq_id'  => $mcq_id,
            ]);
        }

        // Attach MCQs
        // $quiz->mcqs()->attach($request->mcq_ids);

        return response()->json([
            'success' => true,
            'message' => 'Quiz created successfully.',
            'data'    => $quiz->load(['course', 'batch', 'mcqs']),
        ], 201);
    }

    // Update quiz
    public function update(Request $request, $id)
    {
        $quiz = Quiz::find($id);

        if (!$quiz) {
            return response()->json([
                'success' => false,
                'message' => 'Quiz not found.',
            ], 404);
        }

        $request->validate([
            'name'      => 'required|string',
            'marks'     => 'required',
            'duration'  => 'required|integer',
            'status'    => 'required|in:active,inactive,draft',
            'course_id' => 'required|exists:courses,id',
            'batch_id'  => 'required|exists:batches,id',
            'due_date'  => 'required|date',
            'mcq_ids'   => 'required|array|min:1',
            'mcq_ids.*' => 'exists:mcqs,id', // ✅ FIXED
        ]);

        $quiz->update([
            'name'      => $request->name,
            'marks'     => $request->marks,
            'duration'  => $request->duration,
            'status'    => $request->status,
            'course_id' => $request->course_id,
            'batch_id'  => $request->batch_id,
            'due_date'  => $request->due_date,
        ]);

        // Sync MCQs
        $quiz->mcqs()->sync($request->mcq_ids);

        return response()->json([
            'success' => true,
            'message' => 'Quiz updated successfully.',
            'data'    => $quiz->load(['course', 'batch', 'mcqs']),
        ]);
    }

    // Delete quiz
    public function destroy($id)
    {
        $quiz = Quiz::find($id);

        if (!$quiz) {
            return response()->json([
                'success' => false,
                'message' => 'Quiz not found.',
            ], 404);
        }

        $quiz->mcqs()->detach();
        $quiz->delete();

        return response()->json([
            'success' => true,
            'message' => 'Quiz deleted successfully.',
        ]);
    }

    // Get MCQs by course
   public function getMcqsByCourse($courseId)
{
    $mcqs = Mcq::where('course_id', $courseId)
        ->where('status', 'active')
        ->select('id', 'question', 'answer', 'issingle', 'marks')
        ->get();

    return response()->json([
        'success' => true,
        'data'    => $mcqs,
    ]);
}
public function batchStudentStatus(Request $request)
{
    $request->validate([
        'course_id' => 'required|exists:courses,id',
        'batch_id'  => 'required|exists:batches,id',
    ]);

    $courseId = $request->course_id;
    $batchId  = $request->batch_id;

    $enrolledStudents = DB::table('courses_by_students')
        ->where('course_id', $courseId)
        ->where('batch_id', $batchId)
        ->pluck('student_id');

    $students = Student::whereIn('id', $enrolledStudents)->get();

    $quizzes = Quiz::where('course_id', $courseId)
        ->where('batch_id', $batchId)
        ->get();

    $result = $students->map(function($student) use ($quizzes) {
        $studentQuizzes = $quizzes->map(function($quiz) use ($student) {

            $attempt = QuizAttempt::where('student_id', $student->id)
                ->where('quiz_id', $quiz->id)
                ->first();

            $status = 'not_attempted';

            if ($attempt) {
                if ($attempt->status === 'pending') {
                    $status = 'in_progress';
                } elseif ($attempt->status === 'time_up') {
                    $status = 'time_up';
                } elseif ($attempt->is_overdue) {
                    $status = 'overdue_submitted';
                } else {
                    $status = 'submitted';
                }
            } else {
                // ✅ 1 week check
                if ($quiz->due_date) {
                    $oneWeekAfter = \Carbon\Carbon::parse($quiz->due_date)->addWeek();

                    if (now()->gt($oneWeekAfter)) {
                        $status = 'expired';

                        // ✅ Auto insert 0 marks agar attempt nahi hua
                        QuizAttempt::firstOrCreate(
                            [
                                'student_id' => $student->id,
                                'quiz_id'    => $quiz->id,
                            ],
                            [
                                'status'         => 'expired',
                                'obtained_marks' => 0,
                                'remarks'        => 'Not attempted — auto marked 0',
                                'is_checked'     => true,
                            ]
                        );

                        // Reload attempt
                        $attempt = QuizAttempt::where('student_id', $student->id)
                            ->where('quiz_id', $quiz->id)
                            ->first();
                    }
                }
            }

            return [
                'quiz_id'   => $quiz->id,
                'quiz_name' => $quiz->name,
                'due_date'  => $quiz->due_date,
                'marks'     => $quiz->marks,
                'status'    => $status,
               'attempt'   => $attempt ? [
        'id'             => $attempt->id,
        'status'         => $attempt->status,
        'obtained_marks' => $attempt->obtained_marks,
        'is_checked'     => $attempt->is_checked,
        'is_overdue'     => $attempt->is_overdue,
        'is_reattempt'   => $attempt->is_reattempt ?? false,  // ✅
        'remarks'        => $attempt->remarks,
    ] : null,
            ];
        });

        return [
            'student_id' => $student->id,
            'first_name' => $student->first_name,
            'last_name'  => $student->last_name,
            'email'      => $student->email,
            'quizzes'    => $studentQuizzes,
        ];
    });

    return response()->json([
        'success' => true,
        'data'    => [
            'students' => $result,
            'quizzes'  => $quizzes,
        ],
    ]);
}
}
