<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\AnnouncementMail;
use App\Models\Announcement;
use App\Models\Batch;
use App\Models\CoursesByStudent;
use App\Models\Guardian;
use App\Models\Instructor;
use App\Models\Student;
use App\Models\ClassSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class AnnouncementController extends Controller
{
    // =========================================================================
    // ADMIN METHODS
    // =========================================================================

    public function index()
    {
        $announcements = Announcement::orderBy('created_at', 'desc')->get();
        return response()->json(['success' => true, 'data' => $announcements]);
    }

    public function show($id)
    {
        $announcement = Announcement::find($id);
        if (!$announcement) {
            return response()->json(['success' => false, 'message' => 'Announcement not found.'], 404);
        }
        return response()->json(['success' => true, 'data' => $announcement]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'                 => 'required|string|max:255',
            'message'               => 'required|string',
            'status'                => 'required|in:draft,sent,scheduled',
            'priority'              => 'required|in:low,normal,high',
            'target_type'           => 'nullable|in:overall,course_batch,instructor',
            'course_id'             => 'nullable|exists:courses,id',
            'batch_id'              => 'nullable|exists:batches,id',
            'target_instructor_ids' => 'nullable|array',
            'scheduled_at'          => 'nullable|date',
        ]);

        $admin = Auth::user();

        $announcement = Announcement::create([
            'title'                 => $request->title,
            'message'               => $request->message,
            'announced_by'          => 'admin',
            'announced_by_id'       => $admin->id,
            'status'                => $request->status,
            'priority'              => $request->priority,
            'target_type'           => $request->target_type ?? 'overall',
            'course_id'             => $request->course_id,
            'batch_id'              => $request->batch_id,
            'target_instructor_ids' => $request->target_instructor_ids,
            'scheduled_at'          => $request->scheduled_at,
        ]);

        // scheduled ho to kuch mat karo — scheduler handle karega
        if ($request->status === 'sent') {
            $this->dispatchEmails($announcement, 'DotBitz Team');
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

    public function update(Request $request, $id)
    {
        $announcement = Announcement::find($id);
        if (!$announcement) {
            return response()->json(['success' => false, 'message' => 'Announcement not found.'], 404);
        }

        $request->validate([
            'title'                 => 'sometimes|required|string|max:255',
            'message'               => 'sometimes|required|string',
            'status'                => 'sometimes|required|in:draft,sent,scheduled',
            'priority'              => 'sometimes|required|in:low,normal,high',
            'target_type'           => 'nullable|in:overall,course_batch,instructor',
            'course_id'             => 'nullable|exists:courses,id',
            'batch_id'              => 'nullable|exists:batches,id',
            'target_instructor_ids' => 'nullable|array',
            'scheduled_at'          => 'nullable|date',
        ]);

        $wasDraft   = $announcement->status !== 'sent';
        $nowSending = $request->status === 'sent';

        $announcement->update($request->only([
            'title', 'message', 'status', 'priority',
            'target_type', 'course_id', 'batch_id',
            'target_instructor_ids', 'scheduled_at'
        ]));

        if ($wasDraft && $nowSending && !$announcement->sent_at) {
            $this->dispatchEmails($announcement, 'DotBitz Team');
            $announcement->update(['sent_at' => now()]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Announcement updated successfully.',
            'data'    => $announcement,
        ]);
    }

    public function destroy($id)
    {
        $announcement = Announcement::find($id);
        if (!$announcement) {
            return response()->json(['success' => false, 'message' => 'Announcement not found.'], 404);
        }

        $announcement->delete();
        return response()->json(['success' => true, 'message' => 'Announcement deleted successfully.']);
    }

    // =========================================================================
    // ADMIN HELPER ROUTES
    // =========================================================================

    public function getInstructors()
    {
        $instructors = Instructor::select('id', 'first_name', 'last_name', 'email')->get();
        return response()->json(['success' => true, 'data' => $instructors]);
    }

    public function getCourses()
    {
        $courses = \App\Models\Course::select('id', 'course_name', 'course_code')->get();
        return response()->json(['success' => true, 'data' => $courses]);
    }

    public function getBatches($courseId)
    {
        $batches = Batch::where('course_id', $courseId)
            ->select('id', 'name')
            ->get();
        return response()->json(['success' => true, 'data' => $batches]);
    }

    // =========================================================================
    // SCHEDULED ANNOUNCEMENTS — scheduler har minute call karta hai
    // =========================================================================

    public function sendScheduledAnnouncements(): void
    {
        $announcements = Announcement::where('status', 'scheduled')
            ->whereNotNull('scheduled_at')
            ->where('scheduled_at', '<=', now())
            ->whereNull('sent_at')
            ->get();

        if ($announcements->isEmpty()) {
            return;
        }

        foreach ($announcements as $announcement) {
            try {
                if ($announcement->announced_by === 'admin') {
                    $this->dispatchEmails($announcement, 'DotBitz Team');
                } else {
                    $this->announcementByInstructor($announcement, $announcement->announced_by);
                }
                $announcement->update(['status' => 'sent', 'sent_at' => now()]);
                Log::info("Scheduled announcement sent: {$announcement->title}");
            } catch (\Exception $e) {
                Log::error("Scheduled announcement failed [{$announcement->id}]: " . $e->getMessage());
            }
        }
    }

    // =========================================================================
    // INSTRUCTOR METHODS
    // =========================================================================

    public function instructorIndex()
    {
        $announcements = Announcement::where('announced_by_id', Auth::id())
            ->where('announced_by', '!=', 'admin')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['success' => true, 'data' => $announcements]);
    }

    public function instructorShow($id)
    {
        $announcement = Announcement::with(['course', 'batch'])
            ->where('id', $id)
            ->where('announced_by_id', Auth::id())
            ->first();

        if (!$announcement) {
            return response()->json([
                'success' => false,
                'message' => 'Announcement not found or you do not have permission.'
            ], 404);
        }

        return response()->json(['success' => true, 'data' => $announcement]);
    }

    public function instructorCourses()
    {
        $instructorId = Auth::id();
        $courses = ClassSchedule::where('class_schedules.instructor_id', $instructorId)
            ->join('courses', 'class_schedules.course_id', '=', 'courses.id')
            ->select('courses.id', 'courses.course_name', 'courses.course_code')
            ->distinct()
            ->get();

        return response()->json(['success' => true, 'data' => $courses]);
    }

    public function getBatchesByCourse($courseId)
    {
        $instructorId = Auth::id();

        $batches = Batch::where('course_id', $courseId)
            ->where('instructor_id', $instructorId)
            ->get();

        return response()->json(['success' => true, 'data' => $batches]);
    }

    public function getCourseStudentsCount(Request $request, $courseId)
    {
        $batchId = $request->query('batchId');

        $batch = Batch::where('id', $batchId)
            ->where('course_id', $courseId)
            ->first();

        if (!$batch) {
            return response()->json(['success' => false, 'total_students' => 0]);
        }

        $rawStudents = $batch->students;
        $count = 0;

        if (empty($rawStudents)) {
            $count = 0;
        } elseif (is_array($rawStudents)) {
            $count = count($rawStudents);
        } elseif (is_string($rawStudents)) {
            $decoded = json_decode($rawStudents, true);
            if (is_array($decoded)) {
                $count = count($decoded);
            } else {
                $count = count(explode(',', $rawStudents));
            }
        }

        return response()->json(['success' => true, 'total_students' => $count]);
    }

    public function instructorStore(Request $request)
    {
        try {
            $request->validate([
                'title'        => 'required|string|max:255',
                'message'      => 'required|string',
                'status'       => 'required|in:draft,sent,scheduled',
                'priority'     => 'required|in:low,normal,high',
                'scheduled_at' => 'nullable|date',
                'course_id'    => 'required|exists:courses,id',
                'batch_id'     => 'required|exists:batches,id',
            ]);

            $instructor = Instructor::find(Auth::id());
            $instructorName = trim(($instructor->first_name ?? '') . ' ' . ($instructor->last_name ?? '')) ?: 'Instructor';

            $announcement = Announcement::create([
                'title'           => $request->title,
                'message'         => $request->message,
                'announced_by'    => $instructorName,
                'announced_by_id' => Auth::id(),
                'status'          => $request->status,
                'priority'        => $request->priority,
                'scheduled_at'    => $request->scheduled_at,
                'course_id'       => $request->course_id,
                'batch_id'        => $request->batch_id,
            ]);

            // scheduled ho to kuch mat karo — scheduler handle karega
            if ($request->status === 'sent') {
                $this->announcementByInstructor($announcement, $instructorName);
                $announcement->update(['sent_at' => now()]);
            }

            return response()->json([
                'success' => true,
                'message' => $request->status === 'sent'
                    ? 'Announcement sent successfully.'
                    : 'Announcement saved as ' . $request->status . '.',
                'data'    => $announcement,
            ], 201);

        } catch (\Exception $e) {
            Log::error("Instructor Store Error: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function instructorUpdate(Request $request, $id)
    {
        $announcement = Announcement::find($id);
        if (!$announcement) {
            return response()->json(['success' => false, 'message' => 'Not found.'], 404);
        }

        $request->validate([
            'title'        => 'sometimes|required|string|max:255',
            'message'      => 'sometimes|required|string',
            'status'       => 'sometimes|required|in:draft,sent,scheduled',
            'priority'     => 'sometimes|required|in:low,normal,high',
            'scheduled_at' => 'nullable|date',
            'course_id'    => 'sometimes|required|exists:courses,id',
            'batch_id'     => 'sometimes|required|exists:batches,id',
        ]);

        $wasDraft   = $announcement->status === 'draft';
        $nowSending = $request->status === 'sent'; // scheduled nahi — sirf sent

        $announcement->update($request->only([
            'title', 'message', 'status', 'priority', 'scheduled_at', 'course_id', 'batch_id'
        ]));

        if ($wasDraft && $nowSending && !$announcement->sent_at) {
            $instructor     = Instructor::find(Auth::id());
            $instructorName = trim(($instructor->first_name ?? '') . ' ' . ($instructor->last_name ?? '')) ?: 'Instructor';
            $this->announcementByInstructor($announcement, $instructorName);
            $announcement->update(['sent_at' => now()]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Announcement updated successfully.',
            'data'    => $announcement,
        ]);
    }

    // =========================================================================
    // PRIVATE EMAIL HELPERS
    // =========================================================================

    private function dispatchEmails(Announcement $announcement, string $senderName): void
    {
        switch ($announcement->target_type) {
            case 'overall':
                $this->sendAnnouncementEmails($announcement, $senderName);
                break;

            case 'course_batch':
                $this->announcementByInstructor($announcement, $senderName);
                break;

            case 'instructor':
                $ids = $announcement->target_instructor_ids ?? [];
                $instructors = empty($ids)
                    ? Instructor::select('first_name', 'last_name', 'email')->get()
                    : Instructor::whereIn('id', $ids)->select('first_name', 'last_name', 'email')->get();

                foreach ($instructors as $instructor) {
                    try {
                        Mail::to($instructor->email)->send(new AnnouncementMail(
                            recipientName:       trim($instructor->first_name . ' ' . $instructor->last_name) ?: 'Instructor',
                            announcementTitle:   $announcement->title,
                            announcementMessage: $announcement->message,
                            priority:            $announcement->priority,
                            announcedBy:         $announcement->announced_by,
                            announcedByName:     $senderName,
                        ));
                    } catch (\Exception $e) {
                        Log::error("Email failed to {$instructor->email}: " . $e->getMessage());
                    }
                }
                break;

            default:
                $this->sendAnnouncementEmails($announcement, $senderName);
                break;
        }
    }

    private function sendAnnouncementEmails(Announcement $announcement, string $senderName): void
    {
        $recipients = collect()
            ->merge(Student::select('first_name', 'last_name', 'email')->get())
            ->merge(Guardian::select('first_name', 'last_name', 'email')->get())
            ->merge(Instructor::select('first_name', 'last_name', 'email')->get());

        foreach ($recipients as $recipient) {
            try {
                Mail::to($recipient->email)->send(new AnnouncementMail(
                    recipientName:       trim($recipient->first_name . ' ' . $recipient->last_name) ?: 'User',
                    announcementTitle:   $announcement->title,
                    announcementMessage: $announcement->message,
                    priority:            $announcement->priority,
                    announcedBy:         $announcement->announced_by,
                    announcedByName:     $senderName,
                ));
            } catch (\Exception $e) {
                Log::error("Email failed: " . $e->getMessage());
            }
        }
    }

    private function announcementByInstructor(Announcement $announcement, string $instructorName): void
    {
        $batch = Batch::find($announcement->batch_id);

        if (!$batch || empty($batch->students)) {
            Log::warning("No students found in Batch ID: " . $announcement->batch_id);
            return;
        }

        $rawStudents = $batch->students;
        $studentIds  = [];

        if (is_array($rawStudents)) {
            $studentIds = $rawStudents;
        } elseif (is_string($rawStudents)) {
            $decoded    = json_decode($rawStudents, true);
            $studentIds = is_array($decoded) ? $decoded : explode(',', $rawStudents);
        } else {
            $studentIds = [$rawStudents];
        }

        $studentIds = array_filter(array_map('intval', $studentIds));

        if (empty($studentIds)) {
            return;
        }

        $students = Student::whereIn('id', $studentIds)->get();

        foreach ($students as $student) {
            try {
                Mail::to($student->email)->send(new AnnouncementMail(
                    recipientName:       trim($student->first_name . ' ' . $student->last_name) ?: 'Student',
                    announcementTitle:   $announcement->title,
                    announcementMessage: $announcement->message,
                    priority:            $announcement->priority,
                    announcedBy:         $announcement->announced_by,
                    announcedByName:     $instructorName,
                ));
            } catch (\Exception $e) {
                Log::error("Mail failed for {$student->email}: " . $e->getMessage());
            }
        }
    }
}