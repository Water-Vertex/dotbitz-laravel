<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClassSchedule;
use Illuminate\Http\Request;

class ClassScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $schedules = ClassSchedule::all();
        return response()->json([
            'message' => 'Class schedules retrieved successfully',
            'data' => $schedules
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $schedule = ClassSchedule::create(
            $request->only([
                'course_id',
                'instructor_id',
                'start_time',
                'end_time',
                'meeting_link',
                'duration',
                'status',
            ])
        );
        return response()->json([
            'message' => 'Class schedule created successfully',
            'data' => $schedule
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $schedule = ClassSchedule::findOrFail($id);
        return response()->json([
            'message' => 'Class schedule retrieved successfully',
            'data' => $schedule
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $schedule = ClassSchedule::findOrFail($id);
        $schedule->update(
            $request->only([
                'course_id',
                'instructor_id',
                'start_time',
                'end_time',
                'meeting_link',
                'duration',
                'status',
            ])
        );
        return response()->json([
            'message' => 'Class schedule updated successfully',
            'data' => $schedule
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $schedule = ClassSchedule::findOrFail($id);
        $schedule->delete();
        return response()->json([
            'message' => 'Class schedule deleted successfully'
        ]);
    }
}
