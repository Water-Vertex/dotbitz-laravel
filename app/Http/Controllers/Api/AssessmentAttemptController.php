<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AssessmentAttempt;
use App\Models\AssessmentAttemptAnswer;
use App\Models\AssignAssessment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AssessmentAttemptController extends Controller
{
    // ===========================
    //  Student-Side Methods
    // ===========================

    /**
     * Check if the student has already submitted an attempt for a specific assessment.
     */
    public function checkAttempt($assignAssessmentId)
    {
        $student = Auth::user();

        $attempt = AssessmentAttempt::where('student_id', $student->id)
            ->where('assign_assessment_id', $assignAssessmentId)
            ->first();

        return response()->json([
            'success'   => true,
            'attempted' => $attempt ? true : false,
            'attempt'   => $attempt,
        ]);
    }

    /**
     * Create a new assessment attempt record and set initial status to pending.
     */
    public function startAssessment($assignAssessmentId)
    {
        $student = Auth::user();

        $existing = AssessmentAttempt::where('student_id', $student->id)
            ->where('assign_assessment_id', $assignAssessmentId)
            ->first();

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'You have already attempted this assessment.',
                'attempt' => $existing,
            ], 409);
        }

        $assignAssessment = AssignAssessment::with('assessment.questions')->find($assignAssessmentId);

        if (!$assignAssessment) {
            return response()->json([
                'success' => false,
                'message' => 'Assessment not found.',
            ], 404);
        }

        $attempt = AssessmentAttempt::create([
            'student_id'           => $student->id,
            'assign_assessment_id' => $assignAssessmentId,
            'status'               => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Assessment started successfully.',
            'data'    => [
                'attempt'           => $attempt,
                'assign_assessment' => $assignAssessment,
                'assessment'        => $assignAssessment->assessment,
            ],
        ], 201);
    }

    /**
     * Save student answers and finalize the assessment submission status.
     */
    public function submitAssessment(Request $request, $attemptId)
    {
        $request->validate([
            'answers'                  => 'required|array',
            'answers.*.question_id'    => 'required|exists:assessment_questions,id',
            'answers.*.student_answer' => 'nullable|string',
            'status'                   => 'required|in:completed,time_up',
        ]);

        $attempt = AssessmentAttempt::where('id', $attemptId)
            ->where('student_id', Auth::id())
            ->where('status', 'pending')
            ->firstOrFail();

        DB::beginTransaction();
        try {
            foreach ($request->answers as $ansData) {
                AssessmentAttemptAnswer::create([
                    'assessment_attempt_id' => $attempt->id,
                    'question_id'           => $ansData['question_id'],
                    'student_answer'        => $ansData['student_answer'],
                    'is_correct'            => false,
                ]);
            }

            $attempt->update([
                'status'         => $request->status,
                'obtained_marks' => 0,
                'remarks'        => $request->status === 'time_up' ? 'Auto-submitted' : 'Submitted by student',
            ]);

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Submitted successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Get all assessment attempts belonging to the logged-in student.
     */
    public function myAttempts()
    {
        $student = Auth::user();

        $attempts = AssessmentAttempt::with('assignAssessment.assessment')
            ->where('student_id', $student->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $attempts,
        ]);
    }

    // ===========================
    //  Admin-Side Methods
    // ===========================

    /**
     * List all student attempts with associated student, course, and assessment details.
     */
    public function index()
    {
        $attempts = AssessmentAttempt::with([
            'student:id,first_name,last_name',
            'assignAssessment.assessment.course'
        ])->get();

        $data = $attempts->map(function($a) {
            $assign = $a->assignAssessment;
            $assessment = $assign ? $assign->assessment : null;
            $course = $assessment ? $assessment->course : null;

            return [
                'id'               => $a->id,
                'student_name'     => $a->student
                                        ? trim($a->student->first_name . ' ' . $a->student->last_name)
                                        : 'Unknown Student',
                'course_name'      => $course->course_name ?? 'N/A',
                'assessment_title' => $assessment->assessment_title ?? 'N/A',
                'assign_status'    => $assign->status ?? 'pending',
            ];
        });

        return response()->json($data);
    }

    /**
     * Show comprehensive details of a specific attempt for review and grading.
     */
    // public function show($id)
    // {
    //     $attempt = AssessmentAttempt::with([
    //         'answers.question:id,question,answer,marks,assessment_type',
    //         'student:id,first_name,last_name,email,student_uid',
    //         'assignAssessment.assessment.course'
    //     ])->findOrFail($id);

    //     $assign = $attempt->assignAssessment;
    //     $assessment = $assign ? $assign->assessment : null;

    //     $data = [
    //         'id'               => $attempt->id,
    //         'student_id'       => $attempt->student->student_uid ?? $attempt->student->id,
    //         'student_name'     => trim($attempt->student->first_name . ' ' . $attempt->student->last_name),
    //         'course_name'      => $assessment->course->course_name ?? 'N/A',
    //         'assessment_title' => $assessment->assessment_title ?? 'N/A',
    //         'total_marks'      => $assign->total_marks ?? 0,
    //         'obtain_marks'     => $assign->obtain_marks ?? 0,
    //         'remarks'          => $assign->remarks,
    //         'answers'          => $attempt->answers->map(function($ans) {
    //             return [
    //                 'question_id'     => $ans->question_id,
    //                 'question'        => $ans->question->question ?? 'Question Deleted',
    //                 'student_answer'  => $ans->student_answer,
    //                 'correct_answer'  => $ans->question->answer ?? 'N/A',
    //                 'is_correct'      => $ans->is_correct,
    //                 'assessment_type' => $ans->question->assessment_type ?? 'mcq',
    //                 'marks'           => $ans->question->marks ?? 0,
    //             ];
    //         })
    //     ];

    //     return response()->json($data);
    // }

    /**
 * Show comprehensive details of a specific attempt for review and grading.
 */
public function show($id)
{
    $attempt = AssessmentAttempt::with([
        'answers.question:id,question,answer,marks,assessment_type',
        'student:id,first_name,last_name,email,student_uid',
        'assignAssessment.assessment.course'
    ])->findOrFail($id);

    $assign = $attempt->assignAssessment;
    $assessment = $assign ? $assign->assessment : null;

    $data = [
        'id'               => $attempt->id,
        'student_id'       => $attempt->student->student_uid ?? $attempt->student->id,
        'student_name'     => trim($attempt->student->first_name . ' ' . $attempt->student->last_name),
        'course_name'      => $assessment->course->course_name ?? 'N/A',
        'assessment_title' => $assessment->assessment_title ?? 'N/A',
        'total_marks'      => $assign->total_marks ?? 0,
        'obtain_marks'     => $assign->obtain_marks ?? 0,
        'remarks'          => $assign->remarks,
        'answers'          => $attempt->answers->map(function($ans) {
            return [
                'question_id'     => $ans->question_id,
                'question'        => $ans->question->question ?? 'Question Deleted',
                'student_answer'  => $ans->student_answer,
                'answer'          => $ans->question->answer ?? 'N/A',  // Changed from 'correct_answer' to 'answer'
                'is_correct'      => $ans->is_correct,
                'assessment_type' => $ans->question->assessment_type ?? 'qna', // Default to 'qna' if null
                'marks'           => $ans->question->marks ?? 0,
                'options'         => $ans->question->options ?? [], // Add options for MCQ
            ];
        })
    ];

    return response()->json($data);
}

    /**
     * Update the grading status and marks for a student's assessment attempt.
     */
    // public function grade(Request $request, $id)
    // {
    //     $request->validate([
    //         'obtain_marks'          => 'required|numeric',
    //         'remarks'               => 'nullable|string',
    //         'answers'               => 'required|array',
    //         'answers.*.question_id' => 'required|exists:assessment_questions,id',
    //         'answers.*.is_correct'  => 'required|boolean',
    //     ]);

    //     $attempt = AssessmentAttempt::findOrFail($id);

    //     DB::beginTransaction();
    //     try {
    //         foreach ($request->answers as $a) {
    //             AssessmentAttemptAnswer::where('assessment_attempt_id', $id)
    //                 ->where('question_id', $a['question_id'])
    //                 ->update(['is_correct' => $a['is_correct']]);
    //         }

    //         $attempt->update([
    //             'obtained_marks' => $request->obtain_marks,
    //         ]);

    //         $assignAssessment = AssignAssessment::find($attempt->assign_assessment_id);

    //         if ($assignAssessment) {
    //             $assignAssessment->update([
    //                 'obtain_marks' => $request->obtain_marks,
    //                 'remarks'      => $request->remarks,
    //                 'status'       => 'marked',
    //             ]);
    //         }

    //         DB::commit();
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Grading saved. Both tables updated successfully.'
    //         ]);

    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Update failed: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }

   public function grade(Request $request, $id)
{
    $request->validate([
        'obtain_marks'          => 'required|numeric',
        'remarks'               => 'nullable|string',
        'answers'               => 'required|array',
        'answers.*.question_id' => 'required|exists:assessment_questions,id',
        'answers.*.is_correct'  => 'required', // Can be boolean OR numeric (marks)
    ]);

    $attempt = AssessmentAttempt::findOrFail($id);

    // Load attempt answers with question details
    $attemptAnswers = AssessmentAttemptAnswer::where('assessment_attempt_id', $id)
        ->with('question')
        ->get()
        ->keyBy('question_id');

    DB::beginTransaction();
    try {
        foreach ($request->answers as $a) {
            $attemptAnswer = $attemptAnswers->get($a['question_id']);

            // For MCQ questions (assessment_type = 'mcqs')
            if ($attemptAnswer && $attemptAnswer->question->assessment_type === 'mcqs') {
                // Auto-calculate if student answer matches correct answer
                $studentAnswer = trim($attemptAnswer->student_answer ?? '');
                $correctAnswer = trim($attemptAnswer->question->answer ?? '');
                $isActuallyCorrect = ($studentAnswer === $correctAnswer);

                // Use the auto-calculated result, ignore manual override
                $isCorrectValue = $isActuallyCorrect ? 1 : 0;
            }
            // For Q&A questions (assessment_type = 'q-a')
            else {
                // is_correct contains the marks obtained (can be 0 to max marks)
                $isCorrectValue = $a['is_correct'];
            }

            AssessmentAttemptAnswer::where('assessment_attempt_id', $id)
                ->where('question_id', $a['question_id'])
                ->update(['is_correct' => $isCorrectValue]);
        }

        // Recalculate total obtained marks based on all answers
        $totalObtainedMarks = AssessmentAttemptAnswer::where('assessment_attempt_id', $id)
            ->join('assessment_questions', 'assessment_attempt_answers.question_id', '=', 'assessment_questions.id')
            ->selectRaw('SUM(
                CASE
                    WHEN assessment_questions.assessment_type = "mcqs" AND assessment_attempt_answers.is_correct = 1 THEN assessment_questions.marks
                    WHEN assessment_questions.assessment_type = "q-a" THEN assessment_attempt_answers.is_correct
                    ELSE 0
                END
            ) as total')
            ->value('total');

        $attempt->update([
            'obtained_marks' => $totalObtainedMarks,
        ]);

        $assignAssessment = AssignAssessment::find($attempt->assign_assessment_id);

        if ($assignAssessment) {
            $assignAssessment->update([
                'obtain_marks' => $totalObtainedMarks,
                'remarks'      => $request->remarks,
                'status'       => 'marked',
            ]);
        }

        DB::commit();
        return response()->json([
            'success' => true,
            'message' => 'Grading saved successfully. MCQ auto-marked, Q&A manually marked.',
            'obtained_marks' => $totalObtainedMarks
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'success' => false,
            'message' => 'Update failed: ' . $e->getMessage()
        ], 500);
    }
}
}
