<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ClassSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = ClassSchedule::with(['course', 'batch', 'instructor'])->get();
        return response()->json([
            'message' => 'Class schedules retrieved successfully',
            'data' => $schedules
        ]);
    }

    /**
     * Store multiple schedules (for recurring classes)
     */
    public function store(Request $request)
    {
        $request->validate([
            '*.course_id' => 'required|exists:courses,id',
            '*.batch_id' => 'required|exists:batches,id',
            '*.instructor_id' => 'required|exists:instructors,id',
            '*.start_time' => 'required|date',
            '*.end_time' => 'required|date|after:*.start_time',
            '*.meeting_link' => 'required|url',
            '*.day' => 'required|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            '*.status' => 'required|in:scheduled,ongoing,completed,cancelled',
            '*.note' => 'nullable|string'
        ]);

        DB::beginTransaction();

        try {
            $schedules = [];
            foreach ($request->all() as $scheduleData) {
                $schedules[] = ClassSchedule::create($scheduleData);
            }

            DB::commit();

            return response()->json([
                'message' => count($schedules) . ' class schedule(s) created successfully',
                'data' => $schedules
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to create schedules',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update multiple schedules (for recurring classes)
     */
    public function updateMultiple(Request $request, $id)
    {
        $request->validate([
            '*.id' => 'sometimes|exists:class_schedules,id',
            '*.course_id' => 'required|exists:courses,id',
            '*.batch_id' => 'required|exists:batches,id',
            '*.instructor_id' => 'required|exists:instructors,id',
            '*.start_time' => 'required|date',
            '*.end_time' => 'required|date|after:*.start_time',
            '*.meeting_link' => 'required|url',
            '*.day' => 'required|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
            '*.status' => 'required|in:scheduled,ongoing,completed,cancelled',
            '*.note' => 'nullable|string'
        ]);

        DB::beginTransaction();

        try {
            $updatedSchedules = [];

            foreach ($request->all() as $scheduleData) {
                if (isset($scheduleData['id'])) {
                    // Update existing schedule
                    $schedule = ClassSchedule::findOrFail($scheduleData['id']);
                    $schedule->update($scheduleData);
                    $updatedSchedules[] = $schedule;
                } else {
                    // Create new schedule
                    $updatedSchedules[] = ClassSchedule::create($scheduleData);
                }
            }

            DB::commit();

            return response()->json([
                'message' => count($updatedSchedules) . ' class schedule(s) updated successfully',
                'data' => $updatedSchedules
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message' => 'Failed to update schedules',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get schedules by batch
     */
    public function getByBatch($batchId)
    {
        $schedules = ClassSchedule::where('batch_id', $batchId)
            ->with(['course', 'instructor'])
            ->orderBy('day')
            ->orderBy('start_time')
            ->get();

        return response()->json([
            'message' => 'Schedules retrieved successfully',
            'data' => $schedules
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $schedule = ClassSchedule::with(['course', 'batch', 'instructor'])->findOrFail($id);
        return response()->json([
            'message' => 'Class schedule retrieved successfully',
            'data' => $schedule
        ]);
    }

    /**
     * Delete a specific schedule
     */
    public function destroy(string $id)
    {
        $schedule = ClassSchedule::findOrFail($id);
        $schedule->delete();

        return response()->json([
            'message' => 'Class schedule deleted successfully'
        ]);
    }

    /**
     * Delete multiple schedules
     */
    public function destroyMultiple(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:class_schedules,id'
        ]);

        ClassSchedule::whereIn('id', $request->ids)->delete();

        return response()->json([
            'message' => count($request->ids) . ' class schedule(s) deleted successfully'
        ]);
    }
}
