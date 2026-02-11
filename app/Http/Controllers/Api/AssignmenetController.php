<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
            'assignment_file' => 'nullable|file',
            'due_date'        => 'nullable|date',
            'total_marks'     => 'nullable|integer',
        ]);

        $data = $request->only([
            'course_id',
            'title',
            'due_date',
            'total_marks',
        ]);

        // --- Handle file upload ---
        if ($request->hasFile('assignment_file')) {
            $file = $request->file('assignment_file');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/assignments'), $filename);

            $data['assignment_file'] = $filename;
            $data['uploaded_at'] = now(); // uploaded timestamp
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
            'assignment_file' => 'nullable|file',
            'due_date'        => 'nullable|date',
            'total_marks'     => 'nullable|integer',
        ]);

        $data = $request->only([
            'course_id',
            'title',
            'due_date',
            'total_marks',
        ]);

        // --- Handle file upload ---
        if ($request->hasFile('assignment_file')) {
            $file = $request->file('assignment_file');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/assignments'), $filename);

            // Delete old file if exists
            if ($assignment->assignment_file && file_exists(public_path('assets/assignments/' . $assignment->assignment_file))) {
                unlink(public_path('assets/assignments/' . $assignment->assignment_file));
            }

            $data['assignment_file'] = $filename;
            $data['uploaded_at'] = now(); // update uploaded timestamp
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
}
