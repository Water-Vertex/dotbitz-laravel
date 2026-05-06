<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\AssessmentAttempt;
use App\Models\AssessmentQuery;
use App\Models\AssignAssessment;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseInstructor;
use App\Models\CoursesByStudent;
use App\Models\Student;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
            'thumbnail_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'benefits'         => 'nullable|string',
            'short_description' => 'nullable|string',
            'meta_title'       => 'nullable|string|max:255',
'meta_description' => 'nullable|string',
'meta_keyword'     => 'nullable|string|max:255',
'meta_tags'        => 'nullable|string|max:255',
'focus_keyword'    => 'nullable|string|max:255',
'page_schema'      => 'nullable|string',

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
    // public function show($id)
    // {
    //     Log::info("Fetching course with ID: {$id}");

    //     $course = Course::with('instructor')->find($id);
    //     Log::info("Course Record: " . json_encode($course));
    //     if (!$course) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Course not found'
    //         ], 404);
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'data' => $course
    //     ]);
    // }


      // new update
 public function show($id)
    {
        Log::info("Fetching course with ID: {$id}");
        $course = Course::with(['instructor', 'curriculums','batches'])->find($id);

        Log::info("Course Record: " . json_encode($course));

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'Course not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $course,
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
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'benefits'         => 'nullable|string',
            'short_description' => 'nullable|string',

            'meta_title'       => 'nullable|string|max:255',
'meta_description' => 'nullable|string',
'meta_keyword'     => 'nullable|string|max:255',
'meta_tags'        => 'nullable|string|max:255',
'focus_keyword'    => 'nullable|string|max:255',
'page_schema'      => 'nullable|string',
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

     public function InstructorIndex()
{
    $instructor = Auth::guard('sanctum')->user();

    if (!$instructor) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    $courseIds = CourseInstructor::where('instructor_id', $instructor->id)
        ->pluck('course_id');

    $courses = Course::whereIn('id', $courseIds)
        ->where('status', 'active')
        ->get();

    return response()->json([
        'success' => true,
        'data' => $courses,
    ]);
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

     // Check if student has completed any assessment
    public function checkAssessmentCompletion($studentId, $courseId)
    {
        $student = Student::find($studentId);
         $alreadyEnrolled = CoursesByStudent::where('student_id', $studentId)
            ->where('course_id', $courseId)
            ->exists();

        if ($alreadyEnrolled) {
            return response()->json([
                'success' => false,
                'message' => 'You are already enrolled in this course'
            ], 409);
        }
        $query = AssessmentQuery::where('email', $student->email)
            ->where('course_id', $courseId)
            ->first();

          if(!$query) {
    return response()->json([
        'success' => true,
        'completed' => false,
    ]);
}
        $assessmentIds = Assessment::where('course_id', $courseId)->get();
        $assigned_assessmentIds = AssignAssessment::whereIn('assessment_id', $assessmentIds->pluck('id'))
            ->where('appointment_id', $query->id)
            ->get();

        // Simply check if student has any completed assessment attempt
        $assessmentCompleted = AssessmentAttempt::where('student_id', $studentId)
            ->where('status', 'completed')
            ->where('assign_assessment_id', $assigned_assessmentIds->pluck('id'))
            ->exists();

        return response()->json([
            'success' => true,
            'completed' => $assessmentCompleted,
        ]);
    }

    // Enroll student in course
    public function enrollStudent(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id'
        ]);

        $studentId = $request->user()->id;
        $courseId = $request->course_id;

        // Get student details
        $student = Student::find($studentId);

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found'
            ], 404);
        }

        // Check if already enrolled
        $alreadyEnrolled = CoursesByStudent::where('student_id', $studentId)
            ->where('course_id', $courseId)
            ->exists();

        if ($alreadyEnrolled) {
            return response()->json([
                'success' => false,
                'message' => 'You are already enrolled in this course'
            ], 409);
        }

        // Check age eligibility (18 or above)
        $age = Carbon::parse($student->date_of_birth)->age;

        if ($age < 18) {
            return response()->json([
                'success' => false,
                'message' => 'You must be 18 or older to enroll directly. Please ask your parent/guardian.'
            ], 403);
        }

        $assessment = AssessmentQuery::where('email', Student::find($studentId)->email)
            ->where('course_id', $courseId)
            ->first();
            if(!$assessment) {
                return response()->json([
                    'success' => false,
                    'message' => 'No assessment found for this course'
                ], 404);
            }

        // Simply check if student has any completed assessment attempt
        $assessmentCompleted = AssessmentAttempt::where('student_id', $studentId)
            ->where('status', 'completed')
            ->where('assign_assessment_id', $assessment->id)
            ->exists();

        // Check if assessment is completed (for age 18+)


        if (!$assessmentCompleted) {
            return response()->json([
                'success' => false,
                'message' => 'Please complete the assessment before enrolling.'
            ], 403);
        }

        return response()->json([
            'success' => true,
            'completed' => $assessmentCompleted
        ]);

        // Enroll the student
        // $enrollment = CoursesByStudent::create([
        //     'student_id' => $studentId,
        //     'course_id' => $courseId,
        //     'batch_id' => null,
        //     'status' => 'in-progress',
        //     'enrolled_at' => Carbon::now()
        // ]);

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Successfully enrolled in the course',
        //     'data' => $enrollment
        // ]);
    }
}
