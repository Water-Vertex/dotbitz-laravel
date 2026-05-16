<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AssessmentAttempt;
use App\Models\AssessmentAttemptAnswer;
use App\Models\AssignAssessment;
use App\Models\Student;
use App\Mail\AssessmentResultMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class AssessmentAttemptController extends Controller
{
    // ==========================================
    // 1. ADMIN SIDE METHODS
    // ==========================================

    /** List all assessment attempts */
    public function index()
    {
        $attempts = AssessmentAttempt::with([
            'student:id,first_name,last_name',
            'guest:email,full_name',
            'assignAssessment.assessment.course'
        ])->get();

        $data = $attempts->map(function ($attempt) {
            $assign = $attempt->assignAssessment;
            $assessment = $assign ? $assign->assessment : null;
            $course = $assessment ? $assessment->course : null;

            if ($attempt->student) {
                $name = trim($attempt->student->first_name . ' ' . $attempt->student->last_name);
            } elseif ($attempt->guest) {
                $name = $attempt->guest->full_name;
            } else {
                $name = $attempt->guest_id ?? 'Guest User';
            }

            return [
                'id'               => $attempt->id,
                'student_name'     => $name,
                'course_name'      => $course->course_name ?? 'N/A',
                'assessment_title' => $assessment->assessment_title ?? 'N/A',
                'assign_status'    => $assign->status ?? 'pending',
            ];
        });

        return response()->json($data);
    }

    /** Show detailed information for a specific attempt */
    public function show($id)
    {
        $attempt = AssessmentAttempt::with([
            'answers.question',
            'student:id,first_name,last_name,email,student_uid',
            'guest:email,full_name',
            'assignAssessment.assessment.course'
        ])->findOrFail($id);

        $assign = $attempt->assignAssessment;
        $assessment = $assign ? $assign->assessment : null;

        $studentName = 'Guest User';
        $studentId = 'N/A';

        if ($attempt->student) {
            $studentId = $attempt->student->student_uid ?? $attempt->student->id;
            $studentName = trim($attempt->student->first_name . ' ' . $attempt->student->last_name);
        } elseif ($attempt->guest) {
            $studentName = $attempt->guest->full_name;
        }

        $uniqueAnswers = $attempt->answers->unique('question_id');

        return response()->json([
            'id'               => $attempt->id,
            'student_id'       => $studentId,
            'student_name'     => $studentName,
            'course_name'      => $assessment->course->course_name ?? 'N/A',
            'assessment_title' => $assessment->assessment_title ?? 'N/A',
            'total_marks'      => $assign->total_marks ?? 0,
            'obtain_marks'     => $assign->obtain_marks ?? 0,
            'remarks'          => $assign->remarks,
            'answers'          => $uniqueAnswers->map(fn($ans) => [
                'question_id'     => $ans->question_id,
                'question'        => $ans->question->question ?? 'Question Deleted',
                'student_answer'  => $ans->student_answer,
                'correct_answer'  => $ans->question->answer ?? 'N/A',
                'is_correct'      => $ans->is_correct,
                'assessment_type' => $ans->question->assessment_type ?? 'mcq',
                'marks'           => $ans->question->marks ?? 0,
            ])->values()
        ]);
    }

    /** Grade an attempt and send result email */
    public function grade(Request $request, $id)
{
    $request->validate([
        'obtain_marks'          => 'required|numeric',
        'remarks'               => 'nullable|string',
        'answers'               => 'required|array',
        'answers.*.question_id' => 'required|exists:assessment_questions,id',
        'answers.*.is_correct'  => 'required|boolean', // Added boolean validation
    ]);

    $attempt = AssessmentAttempt::with([
        'guest',
        'student',
        'assignAssessment.assessment.course',
        'assignAssessment.assessment'
    ])->findOrFail($id);

    DB::beginTransaction();
    try {
        // Update answers
        foreach ($request->answers as $ans) {
            AssessmentAttemptAnswer::where('assessment_attempt_id', $id)
                ->where('question_id', $ans['question_id'])
                ->update(['is_correct' => $ans['is_correct']]);
        }

        // Update attempt marks
        $attempt->update(['obtained_marks' => $request->obtain_marks]);

        // Update assign assessment
        $assignAssessment = AssignAssessment::find($attempt->assign_assessment_id);
        if ($assignAssessment) {
            $assignAssessment->update([
                'obtain_marks' => $request->obtain_marks,
                'remarks'      => $request->remarks,
                'status'       => 'marked',
            ]);
        }

        // Prepare email data
        $emailData = [
            'course' => $attempt->assignAssessment->assessment->course->course_name ?? 'Course',
            'title'  => $assignAssessment->assessment->assessment_title ?? 'Assessment',
            'total'  => $assignAssessment->total_marks ?? 0,
        ];

        // ========== EMAIL LOGIC (from first version) ==========
        $email = null;
        $name = 'User';

        if ($attempt->student_id && $attempt->student) {
            $email = $attempt->student->email;
            $name = trim($attempt->student->first_name . ' ' . $attempt->student->last_name);
            if (empty($name)) {
                $name = 'Student';
            }
        } elseif ($attempt->guest_id) {
            if ($attempt->guest && $attempt->guest->email) {
                $email = $attempt->guest->email;
                $name = $attempt->guest->full_name ?? 'Guest User';
            } else {
                // Guest might be using email as identifier
                $email = $attempt->guest_id;
                $name = 'Guest User';
            }
        }

        // Send email only if valid email exists
        if ($email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            try {
                Mail::to($email)->send(new AssessmentResultMail(
                    $name,
                    $emailData['course'],
                    $emailData['title'],
                    $request->obtain_marks,
                    $emailData['total'],
                    $request->remarks,
                    $email
                ));
            } catch (\Exception $mailError) {
                Log::error('Email sending failed: ' . $mailError->getMessage());
                // Continue execution - grading is still successful
            }
        } else {
            Log::warning('No valid email found for attempt ID: ' . $id . ', Email: ' . ($email ?? 'null'));
        }
        // =======================================================

        DB::commit();

        return response()->json([
            'success' => true,
            'message' => "Grading completed successfully." . ($email ? " Result email sent." : "")
        ]);

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Grading failed for attempt ID ' . $id . ': ' . $e->getMessage());

        return response()->json([
            'success' => false,
            'message' => 'Failed to grade assessment: ' . $e->getMessage()
        ], 500);
    }
}

    // ==========================================
    // 2. STUDENT SIDE METHODS
    // ==========================================

    public function checkAttempt($assignAssessmentId)
    {
        $attempt = AssessmentAttempt::where('student_id', Auth::id())
            ->where('assign_assessment_id', $assignAssessmentId)
            ->first();

        return response()->json([
            'success'   => true,
            'attempted' => (bool)$attempt,
            'attempt'   => $attempt,
        ]);
    }

    public function startAssessment($assignAssessmentId)
    {
        $student = Auth::user();
        $assignAssessment = AssignAssessment::with('assessment.questions')->find($assignAssessmentId);

        if (!$assignAssessment) return response()->json(['success' => false, 'message' => 'Assessment not found.'], 404);

        if ($assignAssessment->due_date && Carbon::now()->startOfDay()->gt(Carbon::parse($assignAssessment->due_date)->startOfDay())) {
            return response()->json(['success' => false, 'message' => 'This assessment is overdue.'], 403);
        }

        $existing = AssessmentAttempt::where('student_id', $student->id)
            ->where('assign_assessment_id', $assignAssessmentId)
            ->first();

        if ($existing && in_array($existing->status, ['completed', 'time_up'])) {
            return response()->json(['success' => false, 'message' => 'Already attempted.', 'attempt' => $existing], 409);
        }

        if ($existing && $existing->status === 'pending') {
            return response()->json([
                'success'   => true,
                'is_resume' => true,
                'data'      => [
                    'attempt'           => $existing,
                    'assign_assessment' => $assignAssessment,
                    'assessment'        => $assignAssessment->assessment,
                    'saved_answers'     => $existing->answers->pluck('student_answer', 'question_id'),
                ],
            ]);
        }

        $attempt = AssessmentAttempt::create([
            'student_id'           => $student->id,
            'assign_assessment_id' => $assignAssessmentId,
            'status'               => 'pending',
        ]);

        return response()->json([
            'success'   => true,
            'is_resume' => false,
            'data'      => [
                'attempt'           => $attempt,
                'assign_assessment' => $assignAssessment,
                'assessment'        => $assignAssessment->assessment,
                'saved_answers'     => [],
            ],
        ], 201);
    }

    public function saveProgress(Request $request, $attemptId)
    {
        $attempt = AssessmentAttempt::where('id', $attemptId)->where('student_id', Auth::id())->where('status', 'pending')->firstOrFail();
        DB::beginTransaction();
        try {
            foreach ($request->answers as $ansData) {
                AssessmentAttemptAnswer::updateOrCreate(
                    ['assessment_attempt_id' => $attempt->id, 'question_id' => $ansData['question_id']],
                    ['student_answer' => $ansData['student_answer'] ?? '', 'is_correct' => false]
                );
            }
            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false], 500);
        }
    }

    public function submitAssessment(Request $request, $attemptId)
    {
        $attempt = AssessmentAttempt::where('id', $attemptId)->where('student_id', Auth::id())->where('status', 'pending')->firstOrFail();
        DB::beginTransaction();
        try {
            foreach ($request->answers as $ansData) {
                AssessmentAttemptAnswer::updateOrCreate(
                    ['assessment_attempt_id' => $attempt->id, 'question_id' => $ansData['question_id']],
                    ['student_answer' => $ansData['student_answer'] ?? '', 'is_correct' => false]
                );
            }
            $attempt->update([
                'status'  => $request->status,
                'remarks' => $request->status === 'time_up' ? 'Auto-submitted' : 'Submitted by student',
            ]);
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Submitted successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

  public function myResults()
    {
        $attempts = AssessmentAttempt::with(['assignAssessment.assessment', 'assignAssessment.assessment_query.course'])
            ->where('student_id', Auth::id())
            ->whereIn('status', ['completed', 'time_up'])
            ->whereHas('assignAssessment', fn($q) => $q->where('status', 'marked'))
            ->orderBy('updated_at', 'desc')
            ->get();

        $data = $attempts->map(fn($attempt) => [
            'attempt_id'           => $attempt->id,
            'assign_assessment_id' => $attempt->assign_assessment_id, // <--- YE LINE ADD KARNI HAI
            'assessment_title'     => $attempt->assignAssessment->assessment->assessment_title ?? 'N/A',
            'course_name'          => $attempt->assignAssessment->assessment_query->course->course_name ?? 'N/A',
            'total_marks'          => $attempt->assignAssessment->total_marks ?? 0,
            'obtain_marks'         => $attempt->assignAssessment->obtain_marks ?? null,
            'remarks'              => $attempt->assignAssessment->remarks ?? null,
            'status'               => $attempt->status,
        ]);

        return response()->json(['success' => true, 'data' => $data]);
    }
  public function studentViewAttempt($assignAssessmentId)
{
    $student = Auth::user();

    $attempt = AssessmentAttempt::with([
        'answers.question:id,question,answer,options,assessment_type,marks',
        'assignAssessment.assessment:id,assessment_title',
        'assignAssessment.assessment_query.course:id,course_name',
    ])
    ->where('student_id', $student->id)
    ->where('assign_assessment_id', $assignAssessmentId)
    ->whereIn('status', ['completed', 'time_up'])
    ->first();

    if (!$attempt) {
        return response()->json(['success' => false, 'message' => 'No completed attempt found.'], 404);
    }

    $assign = $attempt->assignAssessment;

    // Duplicates remove karne ke liye unique use kiya
    $uniqueAnswers = $attempt->answers->unique('question_id');

    return response()->json([
        'success' => true,
        'data'    => [
            'attempt_id'       => $attempt->id,
            'status'           => $attempt->status,
            'obtained_marks'   => $attempt->obtained_marks ?? 0,
            'total_marks'      => $assign->total_marks ?? 0,
            'obtain_marks'     => $assign->obtain_marks ?? null,
            'remarks'          => $assign->remarks ?? null,
            'assessment_title' => $assign->assessment->assessment_title ?? 'N/A',
            'course_name'      => $assign->assessment_query->course->course_name ?? 'N/A',
            'answers'          => $uniqueAnswers->map(function ($ans) {
                return [
                    'question_id'     => $ans->question_id,
                    'question'        => $ans->question->question ?? 'Question Deleted',
                    'assessment_type' => $ans->question->assessment_type ?? 'mcq',
                    'options'         => $ans->question->options ?? [],
                    'correct_answer'  => $ans->question->answer ?? null,
                    'student_answer'  => $ans->student_answer,
                    'is_correct'      => $ans->is_correct,
                    'marks'           => $ans->question->marks ?? 0,
                ];
            })->values(),
        ],
    ]);
}

    // ==========================================
    // 3. GUEST SIDE METHODS
    // ==========================================

    public function checkGuestAttempt(Request $request, $assignAssessmentId)
    {
        $email = $request->header('X-Guest-Email');
        if (!$email) return response()->json(['success' => false, 'message' => 'Email required'], 400);
        $attempt = AssessmentAttempt::where('guest_id', $email)->where('assign_assessment_id', $assignAssessmentId)->first();
        return response()->json(['success' => true, 'attempted' => !!$attempt, 'attempt' => $attempt]);
    }

    public function guestStartAssessment(Request $request, $assignAssessmentId)
    {
        $email = $request->header('X-Guest-Email');
        if (!$email) return response()->json(['success' => false, 'message' => 'Email required'], 400);

        $assignAssessment = AssignAssessment::with('assessment.questions')->findOrFail($assignAssessmentId);
        if ($assignAssessment->due_date && Carbon::now()->startOfDay()->gt(Carbon::parse($assignAssessment->due_date)->startOfDay())) {
            return response()->json(['success' => false, 'message' => 'Deadline passed.'], 403);
        }

        $existing = AssessmentAttempt::where('guest_id', $email)->where('assign_assessment_id', $assignAssessmentId)->first();
        if ($existing && in_array($existing->status, ['completed', 'time_up'])) return response()->json(['success' => false, 'message' => 'Already attempted.'], 409);

        if ($existing && $existing->status === 'pending') {
            return response()->json(['success' => true, 'is_resume' => true, 'data' => [
                'attempt' => $existing, 'assign_assessment' => $assignAssessment,
                'assessment' => $assignAssessment->assessment, 'saved_answers' => $existing->answers->pluck('student_answer', 'question_id')
            ]]);
        }

        $attempt = AssessmentAttempt::create(['guest_id' => $email, 'assign_assessment_id' => $assignAssessmentId, 'status' => 'pending', 'student_id' => null]);
        return response()->json(['success' => true, 'is_resume' => false, 'data' => ['attempt' => $attempt, 'assign_assessment' => $assignAssessment, 'assessment' => $assignAssessment->assessment, 'saved_answers' => []]], 201);
    }

    public function guestSaveProgress(Request $request, $attemptId)
    {
        $email = $request->header('X-Guest-Email');
        $attempt = AssessmentAttempt::where('id', $attemptId)->where('guest_id', $email)->where('status', 'pending')->firstOrFail();
        DB::beginTransaction();
        try {
            foreach ($request->answers as $ansData) {
                AssessmentAttemptAnswer::updateOrCreate(
                    ['assessment_attempt_id' => $attempt->id, 'question_id' => $ansData['question_id']],
                    ['student_answer' => $ansData['student_answer'] ?? '', 'is_correct' => false]
                );
            }
            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false], 500);
        }
    }

    public function guestSubmitAssessment(Request $request, $attemptId)
    {
        $email = $request->header('X-Guest-Email');
        $attempt = AssessmentAttempt::where('id', $attemptId)->where('guest_id', $email)->firstOrFail();
        DB::beginTransaction();
        try {
            foreach ($request->answers as $ansData) {
                AssessmentAttemptAnswer::updateOrCreate(
                    ['assessment_attempt_id' => $attempt->id, 'question_id' => $ansData['question_id']],
                    ['student_answer' => $ansData['student_answer'] ?? '', 'is_correct' => false]
                );
            }
            $attempt->update(['status' => $request->status, 'remarks' => $request->status === 'time_up' ? 'Auto-submitted' : 'Submitted by guest']);
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Submitted successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function guestMyResults(Request $request)
    {
        $email = $request->header('X-Guest-Email');
        if (!$email) return response()->json(['success' => false, 'message' => 'Email required'], 400);

        $attempts = AssessmentAttempt::with(['assignAssessment.assessment', 'assignAssessment.assessment_query.course'])
            ->where('guest_id', $email)
            ->whereIn('status', ['completed', 'time_up'])
            ->whereHas('assignAssessment', fn($q) => $q->where('status', 'marked'))
            ->orderBy('updated_at', 'desc')->get();

        $data = $attempts->map(fn($attempt) => [
            'attempt_id'           => $attempt->id,
            'assign_assessment_id' => $attempt->assign_assessment_id,
            'assessment_title'     => $attempt->assignAssessment->assessment->assessment_title ?? 'N/A',
            'course_name'          => $attempt->assignAssessment->assessment_query->course->course_name ?? 'N/A',
            'total_marks'          => $attempt->assignAssessment->total_marks ?? 0,
            'obtain_marks'         => $attempt->assignAssessment->obtain_marks ?? 0,
            'remarks'              => $attempt->assignAssessment->remarks ?? '',
            'status'               => $attempt->status,
        ]);
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function guestViewAttempt(Request $request, $assignAssessmentId)
    {
        $email = $request->header('X-Guest-Email');
        if (!$email) return response()->json(['success' => false, 'message' => 'Email required'], 400);

        $attempt = AssessmentAttempt::with([
            'answers.question:id,question,answer,options,assessment_type,marks',
            'assignAssessment.assessment:id,assessment_title',
            'assignAssessment.assessment_query.course:id,course_name',
        ])
        ->where('guest_id', $email)
        ->where('assign_assessment_id', $assignAssessmentId)
        ->whereIn('status', ['completed', 'time_up'])->first();

        if (!$attempt) return response()->json(['success' => false, 'message' => 'No completed attempt found.'], 404);

        $assign = $attempt->assignAssessment;
        return response()->json([
            'success' => true,
            'data'    => [
                'attempt_id'       => $attempt->id,
                'status'           => $attempt->status,
                'obtained_marks'   => $attempt->obtained_marks ?? 0,
                'total_marks'      => $assign->total_marks ?? 0,
                'obtain_marks'     => $assign->obtain_marks ?? null,
                'remarks'          => $assign->remarks ?? null,
                'assessment_title' => $assign->assessment->assessment_title ?? 'N/A',
                'course_name'      => $assign->assessment_query->course->course_name ?? 'N/A',
                'answers'          => $attempt->answers->map(fn($ans) => [
                    'question_id'     => $ans->question_id,
                    'question'        => $ans->question->question ?? 'Question Deleted',
                    'assessment_type' => $ans->question->assessment_type ?? 'mcq',
                    'options'         => $ans->question->options ?? [],
                    'correct_answer'  => $ans->question->answer ?? null,
                    'student_answer'  => $ans->student_answer,
                    'is_correct'      => $ans->is_correct,
                    'marks'           => $ans->question->marks ?? 0,
                ]),
            ],
        ]);
    }
}
