<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
        'success' => true,
        'data' => [
            'assessments' => Assessment::with('course')->get(),
            'courses' => \App\Models\Course::select('id', 'name')->where('status', 'active')->get()
        ]
    ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $assessment = Assessment::create(
            $request->only([
                'question',
                'answer',
                'options',
                'course_id',
                'assessment_type',
                'status',
                'is_single',
            ])
        );

        return response()->json($assessment, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $assessment = Assessment::find($id);

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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $assessment = Assessment::find($id);

        if (!$assessment) {
            return response()->json([
                'message' => 'Assessment not found'
            ], 404);
        }

        $assessment->update(
            $request->only([
                'question',
                'answer',
                'options',
                'course_id',
                'assessment_type',
                'status',
                'is_single',
            ])
        );

        return response()->json($assessment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $assessment = Assessment::find($id);

        if (!$assessment) {
            return response()->json([
                'message' => 'Assessment not found'
            ], 404);
        }

        $assessment->delete();

        return response()->json([
            'message' => 'Assessment deleted successfully'
        ]);
    }
}
