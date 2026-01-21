<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    /**
     * List all courses
     */
    public function index(Request $request)
    {
        $query = Course::with('instructor');

        // Optional search by course_name or course_code
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('course_name', 'like', "%{$search}%")
                  ->orWhere('course_code', 'like', "%{$search}%");
            });
        }

        $courses = $query->orderBy('id', 'desc')->paginate(10);

        return response()->json($courses);
    }

    /**
     * Store a new course
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_name' => 'required|string|max:255',
            'course_code' => 'required|string|max:255|unique:courses,course_code',
            'course_description' => 'nullable|string',
            'course_duration' => 'nullable|integer',
            'course_fee' => 'nullable|numeric',
            'course_level' => 'nullable|string|max:100',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'nullable',
            'is_featured' => 'boolean',
            'instructor_id' => 'required|exists:instructors,id',
            'thumbnail_image' => 'nullable|string|max:255',
        ]);

        // Generate slug automatically
        $validated['slug'] = Str::slug($validated['course_name']);

        $course = Course::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Course created successfully',
            'data' => $course
        ]);
    }

    /**
     * Show single course
     */
    public function show($id)
    {
        $course = Course::with('instructor')->find($id);

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'Course not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $course
        ]);
    }

    /**
     * Update a course
     */
    public function update(Request $request, $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'Course not found'
            ], 404);
        }

        $validated = $request->validate([
            'course_name' => 'required|string|max:255',
            'course_code' => ['required','string','max:255', Rule::unique('courses','course_code')->ignore($course->id)],
            'course_description' => 'nullable|string',
            'course_duration' => 'nullable|integer',
            'course_fee' => 'nullable|numeric',
            'course_level' => 'nullable|string|max:100',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'nullable',
            'is_featured' => 'boolean',
            'instructor_id' => 'required|exists:instructors,id',
            'thumbnail_image' => 'nullable|string|max:255',
        ]);

        // Update slug if course_name changes
        $validated['slug'] = Str::slug($validated['course_name']);

        $course->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Course updated successfully',
            'data' => $course
        ]);
    }

    /**
     * Delete a course
     */
    public function destroy($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'Course not found'
            ], 404);
        }

        $course->delete();

        return response()->json([
            'success' => true,
            'message' => 'Course deleted successfully'
        ]);
    }
}
