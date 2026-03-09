<?php

namespace App\Http\Controllers\Api;

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

    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('course_name', 'like', "%{$search}%")
              ->orWhere('course_code', 'like', "%{$search}%");
        });
    }

    $courses = $query->orderBy('id', 'desc');

    if ($request->wantsJson()) { // Angular/API call
        return response()->json($courses->paginate(10));
    } else { // Blade view
        return view('user.pages.course', ['courses' => $courses->get()]);
    }
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
            'age_limit' => 'nullable|string|max:100',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'nullable',
            'is_featured' => 'boolean',
            'instructor_id' => 'required|exists:instructors,id',
            'thumbnail_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'benefits'         => 'nullable|string',
            'short_description' => 'nullable|string'
        ]);

        // Generate slug automatically
        $validated['slug'] = Str::slug($validated['course_name']);
        if($request->hasFile('thumbnail_image')){

    		$featuredfile = $request->file('thumbnail_image');
	    	$thumbnail_image = uniqid().'.'.$featuredfile->guessExtension();
	    	$image_path = $featuredfile->move(public_path().'/assets/images/courses/',$thumbnail_image);
	    	$validated['thumbnail_image'] = $thumbnail_image;

        }

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
            'age_limit' => 'nullable|string|max:100',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'nullable',
            'is_featured' => 'boolean',
            'instructor_id' => 'required|exists:instructors,id',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'benefits'         => 'nullable|string',
            'short_description' => 'nullable|string'
        ]);

        // Update slug if course_name changes
        $validated['slug'] = Str::slug($validated['course_name']);
        if($request->hasFile('thumbnail_image')){

    		$featuredfile = $request->file('thumbnail_image');
	    	$thumbnail_image = uniqid().'.'.$featuredfile->guessExtension();
	    	$image_path = $featuredfile->move(public_path().'/assets/images/courses/',$thumbnail_image);
	    	$validated['thumbnail_image'] = $thumbnail_image;

        }

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

    public function guardianIndex(Request $request)
    {
        try {
            $query = Course::with('instructor');

            // Apply search if provided
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('course_name', 'like', "%{$search}%")
                    ->orWhere('course_code', 'like', "%{$search}%");
                });
            }

            // Get per_page from request (e.g., 50) or default to 10
            $perPage = $request->query('per_page', 10);

            // Return paginated results specifically for the API
            return response()->json($query->orderBy('id', 'desc')->paginate($perPage));

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function studentIndex(Request $request)
    {


        try {
            $query = Course::with('instructor');

            // Apply search if provided
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('course_name', 'like', "%{$search}%")
                    ->orWhere('course_code', 'like', "%{$search}%");
                });
            }

            // Get per_page from request (e.g., 50) or default to 10
            $perPage = $request->query('per_page', 10);

            // Return paginated results specifically for the API
            return response()->json($query->orderBy('id', 'desc')->paginate($perPage));

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function InstructorIndex(Request $request)
    {

        try {
            $user = $request->user(); // Get authenticated instructor
            $query = Course::with('instructor')->where('instructor_id', $user->id);

            // Apply search if provided
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('course_name', 'like', "%{$search}%")
                    ->orWhere('course_code', 'like', "%{$search}%");
                });
            }

            // Get per_page from request (e.g., 50) or default to 10
            $perPage = $request->query('per_page', 10);

            // Return paginated results specifically for the API
            return response()->json($query->orderBy('id', 'desc')->paginate($perPage));

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function CoursesByInstructor(Request $request)
    {

        try {
            $query = Course::with('instructor')->where('instructor_id', $request->id);

            // Apply search if provided
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('course_name', 'like', "%{$search}%")
                    ->orWhere('course_code', 'like', "%{$search}%");
                });
            }

            // Get per_page from request (e.g., 50) or default to 10
            $perPage = $request->query('per_page', 10);

            // Return paginated results specifically for the API
            return response()->json($query->orderBy('id', 'desc')->paginate($perPage));

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }
}
