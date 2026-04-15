<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\AssessmentQuestion;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => [
                'assessments' => Assessment::with(['course', 'questions'])->get(),
                'courses' => \App\Models\Course::select('id', 'course_name')
                    ->where('status', 'active')
                    ->get()
            ]
        ]);
    }

    public function store(Request $request)
    {
        $totalMarks = collect($request->questions)->sum('marks');
        $assessment = Assessment::create([
            'course_id' => $request->course_id,
            'assessment_title' => $request->assessment_title,
            'total_marks' => $totalMarks,
            'due_date' => $request->due_date,
        ]);

        foreach ($request->questions as $q) {
            AssessmentQuestion::create([
                'assessment_id' => $assessment->id,
                'question' => $q['question'],
                'answer' => $q['answer'],
                'marks' => $q['marks'] ?? 0,
                'options' => $q['options'] ?? [],
                'assessment_type' => $q['assessment_type'],
                'is_single' => $q['is_single'],
                'status' => $q['status'] ?? 'active',
            ]);
        }

        return response()->json(['message' => 'Assessments created successfully'], 201);
    }

    public function show(string $id)
    {
        $assessment = Assessment::with('questions')->find($id);

        if (!$assessment) {
            return response()->json([
                'success' => false,
                'message' => 'Assessment not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $assessment,
            'message' => 'Assessment retrieved successfully'
        ]);
    }

    public function update(Request $request, string $id)
    {
        $assessment = Assessment::find($id);

        if (!$assessment) {
            return response()->json([
                'message' => 'Assessment not found'
            ], 404);
        }

        $assessment->update([
            'course_id' => $request->course_id,
            'assessment_title' => $request->assessment_title,
            'total_marks' => collect($request->questions)->sum('marks'),
            'due_date' => $request->due_date,
        ]);

        AssessmentQuestion::where('assessment_id', $assessment->id)->delete();

        foreach ($request->questions as $q) {
            AssessmentQuestion::create([
                'assessment_id' => $assessment->id,
                'question' => $q['question'],
                'answer' => $q['answer'],
                'marks' => $q['marks'] ?? 0,
                'options' => $q['options'] ?? [],
                'assessment_type' => $q['assessment_type'],
                'is_single' => $q['is_single'],
                'status' => $q['status'] ?? 'active',
            ]);
        }

        return response()->json($assessment);
    }

    public function destroy(string $id)
    {
        $assessment = Assessment::find($id);

        if (!$assessment) {
            return response()->json([
                'message' => 'Assessment not found'
            ], 404);
        }

        AssessmentQuestion::where('assessment_id', $id)->delete();
        $assessment->delete();

        return response()->json([
            'message' => 'Assessment deleted successfully'
        ]);
    }

    public function getByCourse($course_id)
    {
        $assessments = Assessment::with('questions')
            ->where('course_id', $course_id)
            ->get();

        return response()->json($assessments);
    }
}
