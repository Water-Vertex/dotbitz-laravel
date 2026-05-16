<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\QuizAttemptAnswer;
use App\Models\Mcq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class QuizAttemptController extends Controller
{
    // Student ka attempt check karo
    // public function checkAttempt($quizId)
    // {
    //     $student = Auth::user();
    //     $attempt = QuizAttempt::where('student_id', $student->id)
    //         ->where('quiz_id', $quizId)
    //         ->first();

    //     return response()->json([
    //         'success'   => true,
    //         'attempted' => $attempt ? true : false,
    //         'attempt'   => $attempt,
    //     ]);
    // }


// public function startQuiz($quizId)
// {
//     $student = Auth::user();

//     $existing = QuizAttempt::where('student_id', $student->id)
//         ->where('quiz_id', $quizId)
//         ->first();

//     if ($existing) {
//         // ✅ Agar pending hai to resume data return karo
//         if ($existing->status === 'pending') {
//             $quiz = Quiz::with(['mcqs'])->find($quizId);
//             return response()->json([
//                 'success'    => true,
//                 'is_resume'  => true,
//                 'message'    => 'Resuming quiz.',
//                 'data'       => [
//                     'attempt' => $existing,
//                     'quiz'    => $quiz,
//                 ],
//             ]);
//         }

//         return response()->json([
//             'success' => false,
//             'message' => 'You have already attempted this quiz.',
//             'attempt' => $existing,
//         ], 409);
//     }

//     $quiz = Quiz::with(['mcqs'])->find($quizId);

//     if (!$quiz) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Quiz not found.',
//         ], 404);
//     }

//     // ✅ 1 week overdue check — sirf 1 week tak allow
//     if ($quiz->due_date) {
//         $dueDate = \Carbon\Carbon::parse($quiz->due_date);

//         // ✅ Agar sirf date hai
//         if (strlen($quiz->due_date) <= 10) {
//             $dueDate = $dueDate->endOfDay();
//         }

//         // ✅ Overdue check
//         $oneWeekAfter = $dueDate->copy()->addWeek();

//         if (now()->gt($oneWeekAfter)) {
//             return response()->json([
//                 'success' => false,
//                 'message' => 'Quiz deadline has passed.',
//             ], 403);
//         }
//     }

//     $isOverdue = $quiz->due_date && now()->gt(
//         strlen($quiz->due_date) <= 10
//             ? \Carbon\Carbon::parse($quiz->due_date)->endOfDay()
//             : \Carbon\Carbon::parse($quiz->due_date)
//     );

//     $attempt = QuizAttempt::create([
//         'student_id' => $student->id,
//         'quiz_id'    => $quizId,
//         'status'     => 'pending',
//         'is_overdue' => $isOverdue,
//     ]);

//     return response()->json([
//         'success'    => true,
//         'is_resume'  => false,
//         'message'    => $isOverdue
//             ? 'Quiz started (Overdue — 5% penalty will be applied).'
//             : 'Quiz started.',
//         'data'       => [
//             'attempt' => $attempt,
//             'quiz'    => $quiz,
//         ],
//     ], 201);
// }
public function startQuiz(Request $request, $quizId)
{
    $user    = Auth::user();
    $student = \App\Models\Student::where('email', $user->email)->first();
    if (!$student) {
        return response()->json(['success' => false, 'message' => 'Student not found.'], 404);
    }

    $quiz = \App\Models\Quiz::with('mcqs')->find($quizId);
    if (!$quiz) {
        return response()->json(['success' => false, 'message' => 'Quiz not found.'], 404);
    }

    // Existing attempt check
    $attempt = QuizAttempt::where('student_id', $student->id)
        ->where('quiz_id', $quizId)
        ->latest()
        ->first();

    if ($attempt) {
        // Completed ya time_up — reattempt nahi to block karo
        if (in_array($attempt->status, ['completed', 'time_up']) && !$attempt->is_reattempt) {
            return response()->json([
                'success' => false,
                'message' => 'You have already completed this quiz.',
            ], 409);
        }

        // ✅ Reattempt pending — fresh duration return karo
        return response()->json([
            'success'    => true,
            'message'    => 'Resume quiz.',
            'attempt_id' => $attempt->id,
            'is_reattempt' => $attempt->is_reattempt,  
            'duration'   => $quiz->duration,            
            'data'       => [
                'attempt'  => $attempt,
                'quiz'     => $quiz,
                'duration' => $quiz->duration,         
            ],
        ]);
    }

    // New attempt
    $newAttempt = QuizAttempt::create([
        'student_id' => $student->id,
        'quiz_id'    => $quizId,
        'status'     => 'pending',
    ]);

    return response()->json([
        'success'    => true,
        'message'    => 'Quiz started.',
        'attempt_id' => $newAttempt->id,
        'duration'   => $quiz->duration,
        'data'       => [
            'attempt'  => $newAttempt,
            'quiz'     => $quiz,
            'duration' => $quiz->duration,
        ],
    ]);
}
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
            // ✅ Only save if not already saved (resume case)
            $existing = QuizAttemptAnswer::where('quiz_attempt_id', $attempt->id)
                ->where('mcq_id', $answerData['mcq_id'])
                ->first();

            if (!$existing) {
                QuizAttemptAnswer::create([
                    'quiz_attempt_id' => $attempt->id,
                    'mcq_id'          => $answerData['mcq_id'],
                    'student_answer'  => $answerData['student_answer'] ?? null,
                    'status'          => 'pending',
                ]);
            } else {
                // Update existing answer
                $existing->update([
                    'student_answer' => $answerData['student_answer'] ?? null,
                ]);
            }
        }

        $attempt->update([
            'status'  => $request->status,
            'remarks' => $request->status === 'time_up'
                ? 'Time up — auto submitted'
                : 'Submitted by student',
        ]);

        DB::commit();

        return response()->json([
            'success'    => true,
            'message'    => 'Quiz submitted.',
            'status'     => $request->status,
            'is_overdue' => $attempt->is_overdue ?? false,
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['success' => false, 'message' => 'Failed: ' . $e->getMessage()], 500);
    }
}

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

    if ($request->has('batch_id') && $request->batch_id) {
        $query->whereHas('quiz', function ($q) use ($request) {
            $q->where('batch_id', $request->batch_id);
        });
    }

    $attempts = $query->get();

    return response()->json(['success' => true, 'data' => $attempts]);
}


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

    DB::beginTransaction();

    try {
        foreach ($request->answers as $answerData) {
            QuizAttemptAnswer::where('id', $answerData['answer_id'])
                ->update(['status' => $answerData['status']]);
        }

        $obtainedMarks = $request->obtained_marks;

        // ✅ 5% penalty agar overdue attempt hai
        if ($attempt->is_overdue) {
            $penalty       = ($attempt->quiz->marks * 5) / 100;
            $obtainedMarks = max(0, $obtainedMarks - $penalty);
            $obtainedMarks = round($obtainedMarks, 2);
        }

        $attempt->update([
            'obtained_marks' => $obtainedMarks,
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
        return response()->json(['success' => false, 'message' => 'Failed: ' . $e->getMessage()], 500);
    }
}
public function getResumeData($quizId)
{
    $student = Auth::user();

    $attempt = QuizAttempt::where('student_id', $student->id)
        ->where('quiz_id', $quizId)
        ->where('status', 'pending')
        ->with('answers')
        ->first();

    if (!$attempt) {
        return response()->json(['success' => false, 'message' => 'No pending attempt found.'], 404);
    }

    $quiz = Quiz::with(['mcqs'])->find($quizId);

    // Already saved answers
    $savedAnswers = $attempt->answers->mapWithKeys(function($ans) {
        return [$ans->mcq_id => $ans->student_answer];
    });

    return response()->json([
        'success' => true,
        'data'    => [
            'attempt'      => $attempt,
            'quiz'         => $quiz,
            'savedAnswers' => $savedAnswers,
        ],
    ]);
}
public function saveProgress(Request $request, $attemptId)
{
    $attempt = QuizAttempt::find($attemptId);

    if (!$attempt || $attempt->status !== 'pending') {
        return response()->json(['success' => false], 404);
    }

    DB::beginTransaction();
    try {
        foreach ($request->answers as $answerData) {
            if (empty($answerData['student_answer'])) continue;

            QuizAttemptAnswer::updateOrCreate(
                [
                    'quiz_attempt_id' => $attempt->id,
                    'mcq_id'          => $answerData['mcq_id'],
                ],
                [
                    'student_answer' => $answerData['student_answer'],
                    'status'         => 'pending',
                ]
            );
        }
        DB::commit();
    } catch (\Exception $e) {
        DB::rollBack();
    }

    return response()->json(['success' => true]);
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

    public function instructorAttemptedList(Request $request)
{
    $user = Auth::user();
    $instructor = \App\Models\Instructor::where('email', $user->email)->first();

    if (!$instructor) {
        return response()->json(['success' => false, 'message' => 'Instructor not found.'], 404);
    }

    $courseIds = \App\Models\CourseInstructor::where('instructor_id', $instructor->id)
        ->pluck('course_id');

    $query = QuizAttempt::with(['student', 'quiz'])
        ->whereIn('status', ['completed', 'time_up'])
        ->whereHas('quiz', function($q) use ($courseIds) {
            $q->whereIn('course_id', $courseIds);
        })
        ->orderBy('created_at', 'desc');

    if ($request->has('quiz_id') && $request->quiz_id) {
        $query->where('quiz_id', $request->quiz_id);
    }

    if ($request->has('course_id') && $request->course_id) {
        $query->whereHas('quiz', function($q) use ($request) {
            $q->where('course_id', $request->course_id);
        });
    }

    return response()->json(['success' => true, 'data' => $query->get()]);
}

public function batchStudentStatus(Request $request)
{
    $request->validate([
        'course_id' => 'required|exists:courses,id',
        'batch_id'  => 'required|exists:batches,id',
    ]);

    $courseId = $request->course_id;
    $batchId  = $request->batch_id;

    // Batch k enrolled students
    $enrolledStudents = DB::table('courses_by_students')
        ->where('course_id', $courseId)
        ->where('batch_id', $batchId)
        ->pluck('student_id');

    $students = Student::whereIn('id', $enrolledStudents)->get();

    // Is batch k quizzes
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
                if ($attempt->status === 'pending') $status = 'in_progress';
                elseif ($attempt->status === 'time_up') $status = 'time_up';
                elseif ($attempt->is_overdue) $status = 'overdue_submitted';
                else $status = 'submitted';
            } else {
                // 1 week check
                if ($quiz->due_date) {
                    $oneWeekAfter = \Carbon\Carbon::parse($quiz->due_date)->addWeek();
                    if (now()->gt($oneWeekAfter)) {
                        $status = 'expired';
                    }
                }
            }

            return [
                'quiz_id'    => $quiz->id,
                'quiz_name'  => $quiz->name,
                'due_date'   => $quiz->due_date,
                'marks'      => $quiz->marks,
                'status'     => $status,
                'attempt'    => $attempt,
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

public function studentResult($attemptId)
{
    $user      = Auth::user();
    $student   = \App\Models\Student::where('email', $user->email)->first();
    $studentId = $student ? $student->id : $user->id;

    $attempt = QuizAttempt::with([
        'quiz',
        'answers' => function($q) {
            $q->with(['mcq' => function($q2) {
                $q2->select('id', 'question', 'answer', 'options', 'marks');
            }]);
        },
    ])
    ->where('id', $attemptId)
    ->where('student_id', $studentId)
    ->where('is_checked', true)
    ->first();

    if (!$attempt) {
        return response()->json([
            'success' => false,
            'message' => 'Result not found.',
        ], 404);
    }

    return response()->json([
        'success' => true,
        'data'    => $attempt,
    ]);
}


public function reattempt(Request $request, $quizId)
{
    $user    = Auth::user();
    $student = \App\Models\Student::where('email', $user->email)->first();
    if (!$student) {
        return response()->json(['success' => false, 'message' => 'Student not found.'], 404);
    }

    $quiz = \App\Models\Quiz::with('mcqs')->find($quizId);
    if (!$quiz) {
        return response()->json(['success' => false, 'message' => 'Quiz not found.'], 404);
    }

    // Purana attempt find karo
    $oldAttempt = QuizAttempt::where('student_id', $student->id)
        ->where('quiz_id', $quizId)
        ->latest()
        ->first();

    if (!$oldAttempt) {
        return response()->json(['success' => false, 'message' => 'No previous attempt found.'], 404);
    }

    // Grade check — sirf C ya usse neeche
    $totalMarks    = (float)($quiz->marks ?? 0);
    $obtainedMarks = (float)($oldAttempt->obtained_marks ?? 0);
    $percent       = $totalMarks > 0 ? ($obtainedMarks / $totalMarks) * 100 : 0;

    if ($percent > 79) {
        return response()->json([
            'success' => false,
            'message' => 'Reattempt not available. Your grade is above C.',
        ], 403);
    }

    // ✅ Purani answers delete karo
    \App\Models\QuizAttemptAnswer::where('quiz_attempt_id', $oldAttempt->id)->delete();

    // ✅ Attempt completely reset karo — timer bhi
    $oldAttempt->update([
        'status'         => 'pending',
        'obtained_marks' => null,
        'remarks'        => null,
        'is_checked'     => false,
        'is_reattempt'   => true,
        'is_overdue'     => false,
        'updated_at'     => now(),  // ✅ fresh timestamp
    ]);

    // ✅ Quiz duration fresh return karo
    return response()->json([
        'success' => true,
        'message' => 'Reattempt started.',
        'data'    => [
            'attempt_id' => $oldAttempt->id,
            'quiz_id'    => $quiz->id,
            'duration'   => $quiz->duration,  // ✅ fresh duration
            'quiz'       => $quiz,
        ],
    ]);
}

public function checkAttempt($quizId)
{
    $user    = Auth::user();
    $student = \App\Models\Student::where('email', $user->email)->first();
    if (!$student) {
        return response()->json(['success' => false, 'attempted' => false]);
    }

    $attempt = QuizAttempt::where('student_id', $student->id)
        ->where('quiz_id', $quizId)
        ->latest()
        ->first();

    if (!$attempt) {
        return response()->json(['success' => true, 'attempted' => false]);
    }

    return response()->json([
        'success'   => true,
        'attempted' => true,
        'attempt'   => [
            'id'           => $attempt->id,
            'status'       => $attempt->status,
            'is_reattempt' => $attempt->is_reattempt,
            'obtained_marks'=> $attempt->obtained_marks,
            'is_checked'   => $attempt->is_checked,
        ],
    ]);
}
}
