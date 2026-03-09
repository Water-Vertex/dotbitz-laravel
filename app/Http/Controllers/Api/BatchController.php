<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $batches = Batch::all();
        return response()->json($batches);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Handle students - convert to array if it's a string
    $students = $request->students;

    // If it's a string, convert to array first
    if (is_string($students)) {
        // If it's an empty string, make it empty array
        if (empty($students)) {
            $students = [];
        } else {
            // Split by comma and trim each value
            $students = array_map('trim', explode(',', $students));
        }
    }

    // Ensure it's an array and filter out empty values
    $studentsArray = is_array($students) ? $students : [];
    $studentsArray = array_filter($studentsArray, function($value) {
        return $value !== '' && $value !== null;
    });

    $batch = Batch::create([
        'name' => $request->name,
        'slug' => Str::slug($request->name),
        'course_id' => $request->course_id,
        'instructor_id' => $request->instructor_id,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'description' => $request->description,
        'students' => implode(',', $studentsArray),
        'status' => $request->status,
    ]);

    return response()->json($batch, 201);
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $batch = Batch::findOrFail($id);
        return response()->json($batch);
    }

    /**
     * Update the specified resource in storage.
     */


public function update(Request $request, string $id)
{
    // Handle students - convert to array if it's a string
    $students = $request->students;

    // If it's a string, convert to array first
    if (is_string($students)) {
        // If it's an empty string, make it empty array
        if (empty($students)) {
            $students = [];
        } else {
            // Split by comma and trim each value
            $students = array_map('trim', explode(',', $students));
        }
    }

    // Ensure it's an array and filter out empty values
    $studentsArray = is_array($students) ? $students : [];
    $studentsArray = array_filter($studentsArray, function($value) {
        return $value !== '' && $value !== null;
    });

    $batch = Batch::findOrFail($id);
    $batch->update([
        'name' => $request->name,
        'slug' => Str::slug($request->name),
        'course_id' => $request->course_id,
        'instructor_id' => $request->instructor_id,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'description' => $request->description,
        'students' => implode(',', $studentsArray),
        'status' => $request->status,
    ]);

    return response()->json($batch);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $batch = Batch::findOrFail($id);
        $batch->delete();
        return response()->json(null, 204);
    }

    public function getBatchesByCourse($courseId)
    {
        $batches = Batch::where('course_id', $courseId)->get();
        return response()->json($batches);
    }
}
