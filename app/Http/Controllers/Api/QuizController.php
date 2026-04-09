<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizMcq;
use App\Models\Mcq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
     public function getByBatch($batchId)
{
    $quizzes = Quiz::with(['mcqs'])
        ->where('batch_id', $batchId)
        ->where('status', 'active')
        ->orderBy('created_at', 'desc')
        ->get();

    return response()->json([
        'success' => true,
        'data'    => $quizzes,
    ]);
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
}
