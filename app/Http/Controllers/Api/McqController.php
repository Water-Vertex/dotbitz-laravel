<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mcq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class McqController extends Controller
{
public function instructorIndex()
{
    $user = Auth::user();

    $instructor = \App\Models\Instructor::where('email', $user->email)->first();

    if (!$instructor) {
        return response()->json([
            'success' => false,
            'message' => 'Instructor not found.',
        ], 404);
    }

    $courseIds = \App\Models\CourseInstructor::where('instructor_id', $instructor->id)
        ->pluck('course_id');

    $mcqs = \App\Models\Mcq::whereIn('course_id', $courseIds)
        ->orderBy('created_at', 'desc')
        ->get();

    return response()->json([
        'success' => true,
        'data'    => $mcqs,
    ]);
}
    /**
     * Get all MCQs with course relation
     * ✅ Optimized with select() to avoid loading unnecessary data
     */
    public function index()
    {
        try {
            $mcqs = Mcq::with(['course' => function($query) {
                // ✅ Only select needed columns from course
                $query->select('id', 'course_name', 'course_code', 'status');
            }])
            ->select('id', 'question', 'answer', 'options', 'course_id', 'status', 'issingle', 'created_at')
            ->get();

            Log::info('MCQs fetched successfully', ['count' => $mcqs->count()]);

            return response()->json($mcqs);

        } catch (\Exception $e) {
            Log::error('Error fetching MCQs: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to fetch MCQs',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get single MCQ by ID
     */
    public function show($id)
    {
        try {
            $mcq = Mcq::with(['course' => function($query) {
                $query->select('id', 'course_name', 'course_code', 'status');
            }])
            ->find($id);

            if (!$mcq) {
                return response()->json(['message' => 'MCQ not found'], 404);
            }

            return response()->json($mcq);

        } catch (\Exception $e) {
            Log::error('Error fetching MCQ: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to fetch MCQ',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create new MCQ
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'question' => 'required|string|min:10',
                'answer' => 'required|string',
                'options' => 'required|array|min:2|max:10',
                'options.*' => 'required|string',
                'course_id' => 'required|exists:courses,id',
                'status' => 'sometimes|in:active,inactive',
                'issingle' => 'required|boolean',
                'marks' => 'required'

            ]);

            $mcq = Mcq::create($validated);

            // Load course relation
            $mcq->load(['course' => function($query) {
                $query->select('id', 'course_name', 'course_code');
            }]);

            Log::info('MCQ created successfully', ['id' => $mcq->msq_id]);

            return response()->json($mcq, 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            Log::error('Error creating MCQ: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to create MCQ',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update MCQ
     */
    public function update(Request $request, $id)
    {
        try {
            $mcq = Mcq::find($id);

            if (!$mcq) {
                return response()->json(['message' => 'MCQ not found'], 404);
            }

            $validated = $request->validate([
                'question' => 'sometimes|string|min:10',
                'answer' => 'sometimes|string',
                'options' => 'sometimes|array|min:2|max:10',
                'options.*' => 'sometimes|string',
                'course_id' => 'sometimes|exists:courses,id',
                'status' => 'sometimes|in:active,inactive',
                'issingle' => 'sometimes|boolean',
                'marks' => 'required'
            ]);

            $mcq->update($validated);

            // Load course relation
            $mcq->load(['course' => function($query) {
                $query->select('id', 'course_name', 'course_code');
            }]);

            Log::info('MCQ updated successfully', ['id' => $mcq->msq_id]);

            return response()->json($mcq);

        } catch (\Exception $e) {
            Log::error('Error updating MCQ: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to update MCQ',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete MCQ
     */
    public function destroy($id)
    {
        try {
            $mcq = Mcq::find($id);

            if (!$mcq) {
                return response()->json(['message' => 'MCQ not found'], 404);
            }

            $mcq->delete();

            Log::info('MCQ deleted successfully', ['id' => $id]);

            return response()->json(['message' => 'MCQ deleted successfully']);

        } catch (\Exception $e) {
            Log::error('Error deleting MCQ: ' . $e->getMessage());
            return response()->json([
                'message' => 'Failed to delete MCQ',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
