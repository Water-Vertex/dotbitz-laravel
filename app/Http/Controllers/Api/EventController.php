<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // ===== ADMIN CRUD =====

    public function index()
    {
        $events = Event::orderBy('date', 'desc')->get()->map(fn($e) => $this->format($e));
        return response()->json(['success' => true, 'data' => $events]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'date'       => 'required|date',
            'start_time' => 'required',
            'status'     => 'required|in:active,inactive,cancelled',
        ]);

        if (!file_exists(public_path('assets/events'))) {
            mkdir(public_path('assets/events'), 0755, true);
        }

        $data = $request->only([
            'name', 'description', 'location',
            'start_time', 'end_time', 'date', 'status',
        ]);

        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $filename = 'event_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/events'), $filename);
            $data['image'] = $filename;
        }

        $event = Event::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Event created successfully.',
            'data'    => $this->format($event),
        ], 201);
    }

    public function show($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json(['success' => false, 'message' => 'Event not found.'], 404);
        }
        return response()->json(['success' => true, 'data' => $this->format($event)]);
    }

    public function update(Request $request, $id)
{
    $event = Event::find($id);
    if (!$event) {
        return response()->json(['success' => false, 'message' => 'Event not found.'], 404);
    }

    // Convert datetime-local format to proper datetime
    $startTime = $request->start_time;
    $endTime = $request->end_time;
    
    if ($startTime) {
        $startTime = date('Y-m-d H:i:s', strtotime(str_replace('T', ' ', $startTime)));
    }
    if ($endTime) {
        $endTime = date('Y-m-d H:i:s', strtotime(str_replace('T', ' ', $endTime)));
    }

    $request->merge([
        'start_time' => $startTime,
        'end_time' => $endTime,
    ]);

    $request->validate([
        'name'       => 'required|string|max:255',
        'date'       => 'required|date',
        'start_time' => 'required|date_format:Y-m-d H:i:s',
        'status'     => 'required|in:active,inactive,cancelled',
    ]);

    $data = $request->only([
        'name', 'description', 'location',
        'start_time', 'end_time', 'date', 'status',
    ]);

    if ($request->hasFile('image')) {
        // Delete old image
        if ($event->image && file_exists(public_path('assets/events/' . $event->image))) {
            unlink(public_path('assets/events/' . $event->image));
        }
        $file     = $request->file('image');
        $filename = 'event_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/events'), $filename);
        $data['image'] = $filename;
    }

    $event->update($data);

    return response()->json([
        'success' => true,
        'message' => 'Event updated successfully.',
        'data'    => $this->format($event->fresh()),
    ]);
}

    public function destroy($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json(['success' => false, 'message' => 'Event not found.'], 404);
        }

        if ($event->image && file_exists(public_path('assets/events/' . $event->image))) {
            unlink(public_path('assets/events/' . $event->image));
        }

        $event->delete();

        return response()->json(['success' => true, 'message' => 'Event deleted successfully.']);
    }

    // ===== STUDENT / INSTRUCTOR / GUARDIAN — active events only =====

    public function publicIndex()
    {
        $events = Event::where('status', 'active')
            ->orderBy('date', 'asc')
            ->get()
            ->map(fn($e) => $this->format($e));

        return response()->json(['success' => true, 'data' => $events]);
    }

    // ===== HELPER =====

    private function format(Event $event): array
    {
        $baseUrl = app()->environment('local')
            ? 'http://localhost:8000'
            : 'https://dotbitz.com/public';

        return [
            'id'          => $event->id,
            'name'        => $event->name,
            'description' => $event->description,
            'location'    => $event->location,
            'date'        => $event->date?->format('Y-m-d'),
            'start_time'  => $event->start_time
                ? \Carbon\Carbon::parse($event->start_time)->format('Y-m-d\TH:i')
                : null,
            'end_time'    => $event->end_time
                ? \Carbon\Carbon::parse($event->end_time)->format('Y-m-d\TH:i')
                : null,
            'start_time_display' => $event->start_time
                ? \Carbon\Carbon::parse($event->start_time)->format('h:i A')
                : null,
            'end_time_display' => $event->end_time
                ? \Carbon\Carbon::parse($event->end_time)->format('h:i A')
                : null,
            'date_display' => $event->date?->format('M d, Y'),
            'image'       => $event->image
                ? $baseUrl . '/assets/events/' . $event->image
                : null,
            'status'      => $event->status,
            'created_at'  => $event->created_at?->format('M d, Y'),
        ];
    }
}