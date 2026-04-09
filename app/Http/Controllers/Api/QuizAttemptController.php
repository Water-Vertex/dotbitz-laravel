<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\QuizAttemptAnswer;
use App\Models\Mcq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuizAttemptController extends Controller
{
    // Student ka attempt check karo
    public function checkAttempt($quizId)
    {
        $student = Auth::user();
        $attempt = QuizAttempt::where('student_id', $student->id)
            ->where('quiz_id', $quizId)
            ->first();

        return response()->json([
            'success'   => true,
            'attempted' => $attempt ? true : false,
            'attempt'   => $attempt,
        ]);
    }

    // Quiz start karo
    public function startQuiz($quizId)
    {
        $student = Auth::user();

        $existing = QuizAttempt::where('student_id', $student->id)
            ->where('quiz_id', $quizId)
            ->first();

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'You have already attempted this quiz.',
                'attempt' => $existing,
            ], 409);
        }

        $quiz = Quiz::with(['mcqs'])->find($quizId);

        if (!$quiz) {
            return response()->json([
                'success' => false,
                'message' => 'Quiz not found.',
            ], 404);
        }

        if ($quiz->due_date && now()->gt($quiz->due_date)) {
            return response()->json([
                'success' => false,
                'message' => 'Due date has passed.',
            ], 403);
        }

        $attempt = QuizAttempt::create([
            'student_id' => $student->id,
            'quiz_id'    => $quizId,
            'status'     => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Quiz started.',
            'data'    => [
                'attempt' => $attempt,
                'quiz'    => $quiz,
            ],
        ], 201);
    }

    // Quiz submit karo
    public function submitQuiz(Request $request, $attemptId)
    {
        $request->validate([
            'answers'                  => 'required|array',
            'answers.*.mcq_id'         => 'required',
            'answers.*.student_answer' => 'nullable|string',
            'status'                   => 'required|in:completed,time_up',
        ]);

        $attempt = QuizAttempt::with('quiz.mcqs')->find($attemptId);

        if (!$attempt) {
            return response()->json(['success' => false, 'message' => 'Attempt not found.'], 404);
        }

        if ($attempt->status !== 'pending') {
            return response()->json(['success' => false, 'message' => 'Already submitted.'], 409);
        }

        DB::beginTransaction();

        try {
            foreach ($request->answers as $answerData) {
                QuizAttemptAnswer::create([
                    'quiz_attempt_id' => $attempt->id,
                    'mcq_id'          => $answerData['mcq_id'],
                    'student_answer'  => $answerData['student_answer'] ?? null,
                    'status'          => 'pending',
                ]);
            }

            $attempt->update([
                'status'  => $request->status,
                'remarks' => $request->status === 'time_up'
                    ? 'Time up — auto submitted'
                    : 'Submitted by student',
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Quiz submitted.',
                'status'  => $request->status,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed: ' . $e->getMessage(),
            ], 500);
        }
    }

    // ✅ Admin/Instructor — Attempted quizzes list
    public function attemptedList(Request $request)
    {
        $query = QuizAttempt::with(['student', 'quiz'])
            ->whereIn('status', ['completed', 'time_up'])
            ->orderBy('created_at', 'desc');

        if ($request->has('quiz_id') && $request->quiz_id) {
            $query->where('quiz_id', $request->quiz_id);
        }

        if ($request->has('course_id') && $request->course_id) {
            $query->whereHas('quiz', function ($q) use ($request) {
                $q->where('course_id', $request->course_id);
            });
        }

        $attempts = $query->get();

        return response()->json([
            'success' => true,
            'data'    => $attempts,
        ]);
    }

    // ✅ Admin/Instructor — Single attempt detail with answers
    // public function attemptDetail($attemptId)
    // {
    //     $attempt = QuizAttempt::with([
    //         'student',
    //         'quiz',
    //         'answers.mcq',
    //     ])->find($attemptId);

    //     if (!$attempt) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Attempt not found.',
    //         ], 404);
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'data'    => $attempt,
    //     ]);
    // }
    public function attemptDetail($attemptId)
{
    $attempt = QuizAttempt::with([
        'student',
        'quiz',
        'answers' => function($q) {
            $q->with(['mcq' => function($q2) {
                $q2->select('id', 'question', 'answer', 'marks'); 
            }]);
        },
    ])->find($attemptId);

    if (!$attempt) {
        return response()->json([
            'success' => false,
            'message' => 'Attempt not found.',
        ], 404);
    }

    return response()->json([
        'success' => true,
        'data'    => $attempt,
    ]);
}

    // ✅ Admin/Instructor — Check quiz (mark correct/wrong + obtained marks + remarks)
    // public function checkQuiz(Request $request, $attemptId)
    // {
    //     $request->validate([
    //         'answers'              => 'required|array',
    //         'answers.*.answer_id'  => 'required|exists:quiz_attempt_answers,id',
    //         'answers.*.status'     => 'required|in:correct,wrong',
    //         'obtained_marks'       => 'required|integer|min:0',
    //         'remarks'              => 'nullable|string',
    //     ]);

    //     $attempt = QuizAttempt::find($attemptId);

    //     if (!$attempt) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Attempt not found.',
    //         ], 404);
    //     }

    //     DB::beginTransaction();

    //     try {
    //         // Har answer ka status update karo
    //         foreach ($request->answers as $answerData) {
    //             QuizAttemptAnswer::where('id', $answerData['answer_id'])
    //                 ->update(['status' => $answerData['status']]);
    //         }

    //         // Attempt update karo
    //         $attempt->update([
    //             'obtained_marks' => $request->obtained_marks,
    //             'remarks'        => $request->remarks,
    //         ]);

    //         DB::commit();

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Quiz checked successfully.',
    //         ]);

    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Failed: ' . $e->getMessage(),
    //         ], 500);
    //     }
    // }

//     public function checkQuiz(Request $request, $attemptId)
// {
//     $request->validate([
//         'answers'             => 'required|array',
//         'answers.*.answer_id' => 'required|exists:quiz_attempt_answers,id',
//         'answers.*.status'    => 'required|in:correct,wrong',
//         'obtained_marks'      => 'required|integer|min:0',
//         'remarks'             => 'nullable|string',
//     ]);

//     $attempt = QuizAttempt::find($attemptId);

//     if (!$attempt) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Attempt not found.',
//         ], 404);
//     }

//     DB::beginTransaction();

//     try {
//         foreach ($request->answers as $answerData) {
//             QuizAttemptAnswer::where('id', $answerData['answer_id'])
//                 ->update(['status' => $answerData['status']]);
//         }

//         $attempt->update([
//             'obtained_marks' => $request->obtained_marks,
//             'remarks'        => $request->remarks,
//             'is_checked'     => true,  // ✅ checked mark karo
//         ]);

//         DB::commit();

//         return response()->json([
//             'success' => true,
//             'message' => 'Quiz checked successfully.',
//         ]);

//     } catch (\Exception $e) {
//         DB::rollBack();
//         return response()->json([
//             'success' => false,
//             'message' => 'Failed: ' . $e->getMessage(),
//         ], 500);
//     }
// }
public function checkQuiz(Request $request, $attemptId)
{
    $request->validate([
        'answers'             => 'required|array',
        'answers.*.answer_id' => 'required|exists:quiz_attempt_answers,id',
        'answers.*.status'    => 'required|in:correct,wrong',
        'obtained_marks'      => 'required|integer|min:0',
        'remarks'             => 'nullable|string',
    ]);

    $attempt = QuizAttempt::with('quiz')->find($attemptId);

    if (!$attempt) {
        return response()->json([
            'success' => false,
            'message' => 'Attempt not found.',
        ], 404);
    }

    DB::beginTransaction();

    try {
        foreach ($request->answers as $answerData) {
            QuizAttemptAnswer::where('id', $answerData['answer_id'])
                ->update(['status' => $answerData['status']]);
        }

        $attempt->update([
            'obtained_marks' => $request->obtained_marks,
            'remarks'        => $request->remarks,
            'is_checked'     => true,
        ]);

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => 'Quiz checked successfully.',
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'success' => false,
            'message' => 'Failed: ' . $e->getMessage(),
        ], 500);
    }
}

    // Student attempts list
    public function myAttempts()
    {
        $student = Auth::user();

        $attempts = QuizAttempt::with('quiz')
            ->where('student_id', $student->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $attempts,
        ]);
    }
}