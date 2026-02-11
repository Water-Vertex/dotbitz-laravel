<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CourseCurriculum;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseCurriculumController extends Controller
{
    public function index(Request $request)
    {
        $query = CourseCurriculum::with('course');

        if ($request->has('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        $curricula = $query->orderBy('sorting_order')->get();

        return response()->json([
            'success' => true,
            'data' => $curricula
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id'   => 'required|exists:courses,id',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'type'        => 'required|string|max:50',
            'documents'   => 'nullable',
            'duration'    => 'nullable|integer',
            'sorting_order'=> 'nullable|integer',
        ]);

        $data = $request->only([
            'course_id', 'title', 'description', 'type', 'duration', 'sorting_order'
        ]);

        // --- Documents handling ---
        if ($request->type === 'video') {
            $data['documents'] = $request->documents ?? null; // URL
        } elseif ($request->hasFile('documents')) {
            $file = $request->file('documents');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/course_documents'), $filename);
            $data['documents'] = $filename;
        } else {
            $data['documents'] = null;
        }

        $curriculum = CourseCurriculum::create($data);

        return response()->json([
            'success' => true,
            'data'    => $curriculum->load('course'),
            'message' => 'Course curriculum created successfully'
        ], 201);
    }

    public function show(string $id)
    {
        $curriculum = CourseCurriculum::with('course')->find($id);

        if (!$curriculum) {
            return response()->json([
                'success' => false,
                'message' => 'Curriculum not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $curriculum
        ]);
    }

    public function update(Request $request, string $id)
    {
        $curriculum = CourseCurriculum::find($id);

        if (!$curriculum) {
            return response()->json([
                'success' => false,
                'message' => 'Curriculum not found'
            ], 404);
        }

        $request->validate([
            'title'       => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'type'        => 'sometimes|required|string|max:50',
            'documents'   => 'nullable',
            'duration'    => 'nullable|integer',
            'sorting_order'=> 'nullable|integer',
        ]);

        $data = $request->only(['title', 'description', 'type', 'duration', 'sorting_order']);

        // --- Documents handling ---
        if ($request->type === 'video') {
            // Video URL
            $data['documents'] = $request->documents ?? $curriculum->documents;
        } elseif ($request->hasFile('documents')) {
            // Reading / Assignment file
            $file = $request->file('documents');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/course_documents'), $filename);
            $data['documents'] = $filename;

            // Delete old file if exists
            if ($curriculum->documents && file_exists(public_path('assets/course_documents/' . $curriculum->documents))) {
                unlink(public_path('assets/course_documents/' . $curriculum->documents));
            }
        } else {
            // No new file, keep old one
            $data['documents'] = $curriculum->documents;
        }

        $curriculum->update($data);

        return response()->json([
            'success' => true,
            'data'    => $curriculum->load('course'),
            'message' => 'Curriculum updated successfully'
        ]);
    }

    public function destroy(string $id)
    {
        $curriculum = CourseCurriculum::find($id);

        if (!$curriculum) {
            return response()->json([
                'success' => false,
                'message' => 'Curriculum not found'
            ], 404);
        }

        if ($curriculum->documents && file_exists(public_path('assets/course_documents/' . $curriculum->documents))) {
            unlink(public_path('assets/course_documents/' . $curriculum->documents));
        }

        $curriculum->delete();

        return response()->json([
            'success' => true,
            'message' => 'Curriculum deleted successfully'
        ]);
    }
}
