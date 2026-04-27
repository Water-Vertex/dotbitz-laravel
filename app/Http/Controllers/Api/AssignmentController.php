<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class AssignmentController extends Controller
{
    // GET all assignments (optional filter by course_id)
    public function index(Request $request)
    {
        $query = Assignment::with('course');

        if ($request->has('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        $assignments = $query->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $assignments
        ]);
    }

    // STORE assignment
    public function store(Request $request)
    {
        $request->validate([
            'course_id'       => 'required|exists:courses,id',
            'title'           => 'required|string|max:255',
            'description'     => 'nullable|string',
            'assignment_file' => 'nullable|file',
            'due_date'        => 'nullable|date',
            'start_date'      => 'nullable|date',
            'active_status'   => 'nullable|string|in:active,inactive',
            'total_marks'     => 'nullable|integer',
            'batch_id'        => 'nullable|exists:batches,id',

        ]);

        $data = $request->only([
            'course_id',
            'title',
            'description',
            'due_date',
            'start_date',
            'total_marks',
            'batch_id',
        ]);

        // Convert active_status string to integer
        $data['active_status'] = ($request->input('active_status', 'active') === 'active') ? 1 : 0;

        // Handle file upload
        if ($request->hasFile('assignment_file')) {
            $file = $request->file('assignment_file');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/assignments'), $filename);

            $data['assignment_file'] = $filename;
            $data['uploaded_at'] = now();
        }

        $assignment = Assignment::create($data);

        return response()->json([
            'success' => true,
            'data'    => $assignment->load('course'),
            'message' => 'Assignment created successfully'
        ], 201);
    }

    // SHOW single assignment
    public function show(string $id)
    {
        $assignment = Assignment::with('course')->find($id);

        if (!$assignment) {
            return response()->json([
                'success' => false,
                'message' => 'Assignment not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $assignment
        ]);
    }

    // UPDATE assignment
    public function update(Request $request, string $id)
    {
        $assignment = Assignment::find($id);

        if (!$assignment) {
            return response()->json([
                'success' => false,
                'message' => 'Assignment not found'
            ], 404);
        }

        $request->validate([
            'course_id'       => 'sometimes|required|exists:courses,id',
            'title'           => 'sometimes|required|string|max:255',
            'description'     => 'nullable|string',
            'assignment_file' => 'nullable|file',
            'due_date'        => 'nullable|date',
            'start_date'      => 'nullable|date',
            'active_status'   => 'nullable|string|in:active,inactive',
            'total_marks'     => 'nullable|integer',
            'batch_id' => 'nullable|exists:batches,id',

        ]);

        $data = $request->only([
            'course_id',
            'title',
            'description',
            'due_date',
            'start_date',
            'total_marks',
            'batch_id',

        ]);

        // Convert active_status string to integer
        if ($request->has('active_status')) {
            $data['active_status'] = ($request->input('active_status') === 'active') ? 1 : 0;
        }

        // Handle file upload
        if ($request->hasFile('assignment_file')) {
            $file = $request->file('assignment_file');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/assignments'), $filename);

            // Delete old file if exists
            if ($assignment->assignment_file && file_exists(public_path('assets/assignments/' . $assignment->assignment_file))) {
                unlink(public_path('assets/assignments/' . $assignment->assignment_file));
            }

            $data['assignment_file'] = $filename;
            $data['uploaded_at'] = now();
        }

        $assignment->update($data);

        return response()->json([
            'success' => true,
            'data'    => $assignment->load('course'),
            'message' => 'Assignment updated successfully'
        ]);
    }

    // DELETE assignment
    public function destroy(string $id)
    {
        $assignment = Assignment::find($id);

        if (!$assignment) {
            return response()->json([
                'success' => false,
                'message' => 'Assignment not found'
            ], 404);
        }

        // Delete file if exists
        if ($assignment->assignment_file && file_exists(public_path('assets/assignments/' . $assignment->assignment_file))) {
            unlink(public_path('assets/assignments/' . $assignment->assignment_file));
        }

        $assignment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Assignment deleted successfully'
        ]);
    }

    // Get assignments by course
    public function getAssignmentsByCourseId($courseId)
    {
        $assignments = Assignment::where('course_id', $courseId)
            ->orderBy('due_date', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'total'   => $assignments->count(),
            'data'    => $assignments,
        ]);
    }

   public function getAssignmentsByCourse($batchId)
{
    $now = now();

    $assignments = Assignment::where('batch_id', $batchId)
        ->where('active_status', 1)
        ->where(function($q) use ($now) {
            $q->whereNull('start_date')
              ->orWhere('start_date', '<=', $now);
        })
        ->get()
        ->map(function($a) {
            $a->total_marks = (int) $a->total_marks;
            return $a;
        });

    return response()->json([
        'success' => true,
        'data'    => $assignments,
    ]);
}
public function instructorIndex()
{
    $user = Auth::user();
    $instructor = \App\Models\Instructor::where('email', $user->email)->first();

    if (!$instructor) {
        return response()->json(['success' => false, 'message' => 'Instructor not found.'], 404);
    }

    $courseIds = \App\Models\CourseInstructor::where('instructor_id', $instructor->id)
        ->pluck('course_id');

    $assignments = Assignment::whereIn('course_id', $courseIds)
        ->with(['course', 'batch'])
        ->orderBy('created_at', 'desc')
        ->get();

    return response()->json(['success' => true, 'data' => $assignments]);
}
}
