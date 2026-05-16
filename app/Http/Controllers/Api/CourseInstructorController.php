<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\CourseInstructor;
use Illuminate\Http\Request;

class CourseInstructorController extends Controller
{
    public function show($id)
{
    $assignment = CourseInstructor::with(['course', 'instructor'])->find($id);

    if (!$assignment) {
        return response()->json([
            'success' => false,
            'message' => 'Assignment not found.',
        ], 404);
    }

    return response()->json([
        'success' => true,
        'data'    => $assignment,
    ]);
}
    // List all assignments
    public function index(Request $request)
    {
        $query = CourseInstructor::with(['course', 'instructor']);

        if ($request->has('course_id') && $request->course_id) {
            $query->where('course_id', $request->course_id);
        }

        if ($request->has('instructor_id') && $request->instructor_id) {
            $query->where('instructor_id', $request->instructor_id);
        }

        $assignments = $query->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data'    => $assignments,
        ]);
    }

    // Assign instructor to course
    public function store(Request $request)
    {
        $request->validate([
            'course_id'     => 'required|exists:courses,id',
            'instructor_id' => 'required|exists:instructors,id',
        ]);

        // Duplicate check
        $exists = CourseInstructor::where('course_id', $request->course_id)
            ->where('instructor_id', $request->instructor_id)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'This instructor is already assigned to this course.',
            ], 409);
        }

        $assignment = CourseInstructor::create([
            'course_id'     => $request->course_id,
            'instructor_id' => $request->instructor_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Instructor assigned successfully.',
            'data'    => $assignment->load(['course', 'instructor']),
        ], 201);
    }

    // Update assignment
    public function update(Request $request, $id)
    {
        $assignment = CourseInstructor::find($id);

        if (!$assignment) {
            return response()->json([
                'success' => false,
                'message' => 'Assignment not found.',
            ], 404);
        }

        $request->validate([
            'course_id'     => 'required|exists:courses,id',
            'instructor_id' => 'required|exists:instructors,id',
        ]);

        // Duplicate check — excluding current record
        $exists = CourseInstructor::where('course_id', $request->course_id)
            ->where('instructor_id', $request->instructor_id)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'This instructor is already assigned to this course.',
            ], 409);
        }

        $assignment->update([
            'course_id'     => $request->course_id,
            'instructor_id' => $request->instructor_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Assignment updated successfully.',
            'data'    => $assignment->load(['course', 'instructor']),
        ]);
    }

    // Delete assignment
    public function destroy($id)
    {
        $assignment = CourseInstructor::find($id);

        if (!$assignment) {
            return response()->json([
                'success' => false,
                'message' => 'Assignment not found.',
            ], 404);
        }

        $assignment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Assignment removed successfully.',
        ]);
    }
}
