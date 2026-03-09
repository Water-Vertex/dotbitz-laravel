<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\AnnouncementMail;
use App\Models\Announcement;
use App\Models\Guardian;
use App\Models\Instructor;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AnnouncementController extends Controller
{
    // GET all announcements
    public function index()
    {
        $announcements = Announcement::orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data'    => $announcements,
        ]);
    }

    // GET single announcement
    public function show($id)
    {
        $announcement = Announcement::find($id);

        if (!$announcement) {
            return response()->json([
                'success' => false,
                'message' => 'Announcement not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $announcement,
        ]);
    }

    // CREATE announcement
    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'message'      => 'required|string',
            'status'       => 'required|in:draft,sent,scheduled',
            'priority'     => 'required|in:low,normal,high',
            'scheduled_at' => 'nullable|date',
        ]);

        $admin = Auth::user();

        $announcement = Announcement::create([
            'title'          => $request->title,
            'message'        => $request->message,
            'announced_by'   => 'admin',
            'announced_by_id'=> $admin->id,
            'status'         => $request->status,
            'priority'       => $request->priority,
            'scheduled_at'   => $request->scheduled_at,
        ]);

        // Send emails if status is 'sent'
        if ($request->status === 'sent') {
            $this->sendAnnouncementEmails($announcement, $admin->name ?? 'Admin');
            $announcement->update(['sent_at' => now()]);
        }

        return response()->json([
            'success' => true,
            'message' => $request->status === 'sent'
                ? 'Announcement created and emails sent successfully.'
                : 'Announcement saved as ' . $request->status . '.',
            'data'    => $announcement,
        ], 201);
    }

    // UPDATE announcement
    public function update(Request $request, $id)
    {
        $announcement = Announcement::find($id);

        if (!$announcement) {
            return response()->json([
                'success' => false,
                'message' => 'Announcement not found.',
            ], 404);
        }

        $request->validate([
            'title'        => 'sometimes|required|string|max:255',
            'message'      => 'sometimes|required|string',
            'status'       => 'sometimes|required|in:draft,sent,scheduled',
            'priority'     => 'sometimes|required|in:low,normal,high',
            'scheduled_at' => 'nullable|date',
        ]);

        $wasDraft = $announcement->status !== 'sent';
        $nowSending = $request->status === 'sent';

        $announcement->update($request->only([
            'title', 'message', 'status', 'priority', 'scheduled_at'
        ]));

        // Send emails if status changed to 'sent' for first time
        if ($wasDraft && $nowSending && !$announcement->sent_at) {
            $admin = Auth::user();
            $this->sendAnnouncementEmails($announcement, $admin->name ?? 'Admin');
            $announcement->update(['sent_at' => now()]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Announcement updated successfully.',
            'data'    => $announcement,
        ]);
    }

    // DELETE announcement
    public function destroy($id)
    {
        $announcement = Announcement::find($id);

        if (!$announcement) {
            return response()->json([
                'success' => false,
                'message' => 'Announcement not found.',
            ], 404);
        }

        $announcement->delete();

        return response()->json([
            'success' => true,
            'message' => 'Announcement deleted successfully.',
        ]);
    }

    // SEND emails to all students, guardians, instructors
    private function sendAnnouncementEmails(Announcement $announcement, string $senderName): void
    {
        $students    = Student::select('first_name', 'last_name', 'email')->get();
        $guardians   = Guardian::select('first_name', 'last_name', 'email')->get();
        $instructors = Instructor::select('first_name', 'last_name', 'email')->get();

        $recipients = collect()
            ->merge($students)
            ->merge($guardians)
            ->merge($instructors);

        foreach ($recipients as $recipient) {
            $name = trim(($recipient->first_name ?? '') . ' ' . ($recipient->last_name ?? ''));
            if (empty($name)) $name = 'User';

            try {
                Mail::to($recipient->email)->send(new AnnouncementMail(
                    recipientName:       $name,
                    announcementTitle:   $announcement->title,
                    announcementMessage: $announcement->message,
                    priority:            $announcement->priority,
                    announcedBy:         $announcement->announced_by,
                    announcedByName:     $senderName,
                ));
            } catch (\Exception $e) {
                // Log failed email but don't stop the loop
                Log::error("Failed to send announcement email to {$recipient->email}: " . $e->getMessage());
            }
        }
    }
}