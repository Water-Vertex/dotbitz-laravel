<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use App\Models\TicketReply;
use App\Models\Student;
use App\Models\Guardian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportTicketController extends Controller
{
    // ===== SHARED HELPER =====

    // private function getUser(string $userType): array
    // {
    //     $user = Auth::user();

    //     if ($userType === 'student') {
    //         $model = Student::where('email', $user->email)->first();
    //     } else {
    //         $model = Guardian::where('email', $user->email)->first();
    //     }

    //     return [
    //         'user'  => $user,
    //         'model' => $model,
    //     ];
    // }

    // private function formatTicket(SupportTicket $ticket): array
    // {
    //     return [
    //         'id'            => $ticket->id,
    //         'ticket_number' => $ticket->ticket_number,
    //         'name'          => $ticket->name,
    //         'email'         => $ticket->email,
    //         'phone'         => $ticket->phone,
    //         'issue'         => $ticket->issue,
    //         'message'       => $ticket->message,
    //         'status'        => $ticket->status,
    //         'user_type'     => $ticket->user_type,
    //         'created_at'    => $ticket->created_at?->format('M d, Y'),
    //         'updated_at'    => $ticket->updated_at?->format('M d, Y'),
    //     ];
    // }

    // ===== STUDENT =====

    // public function studentIndex()
    // {
    //     ['user' => $user, 'model' => $student] = $this->getUser('student');

    //     $tickets = SupportTicket::where('user_type', 'student')
    //         ->where('user_id', $student?->id ?? $user->id)
    //         ->orderBy('created_at', 'desc')
    //         ->get()
    //         ->map(fn($t) => $this->formatTicket($t));

    //     return response()->json(['success' => true, 'data' => $tickets]);
    // }

    // public function studentStore(Request $request)
    // {
    //     ['user' => $user, 'model' => $student] = $this->getUser('student');

    //     $request->validate([
    //         'phone'   => 'required|string|max:20',
    //         'issue'   => 'required|string',
    //         'message' => 'required|string|max:1000',
    //     ]);

    //     $ticket = SupportTicket::create([
    //         'ticket_number' => SupportTicket::generateTicketNumber(),
    //         'name'          => $student?->first_name . ' ' . $student?->last_name,
    //         'email'         => $user->email,
    //         'phone'         => $request->phone,
    //         'issue'         => $request->issue,
    //         'message'       => $request->message,
    //         'user_type'     => 'student',
    //         'user_id'       => $student?->id ?? $user->id,
    //         'status'        => 'pending',
    //     ]);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Ticket submitted successfully.',
    //         'data'    => $this->formatTicket($ticket),
    //     ], 201);
    // }

    // public function studentShow($id)
    // {
    //     ['user' => $user, 'model' => $student] = $this->getUser('student');

    //     $ticket = SupportTicket::where('id', $id)
    //         ->where('user_type', 'student')
    //         ->where('user_id', $student?->id ?? $user->id)
    //         ->first();

    //     if (!$ticket) {
    //         return response()->json(['success' => false, 'message' => 'Ticket not found.'], 404);
    //     }

    //     return response()->json(['success' => true, 'data' => $this->formatTicket($ticket)]);
    // }

    // public function studentUpdate(Request $request, $id)
    // {
    //     ['user' => $user, 'model' => $student] = $this->getUser('student');

    //     $ticket = SupportTicket::where('id', $id)
    //         ->where('user_type', 'student')
    //         ->where('user_id', $student?->id ?? $user->id)
    //         ->first();

    //     if (!$ticket) {
    //         return response()->json(['success' => false, 'message' => 'Ticket not found.'], 404);
    //     }

    //     // Closed tickets edit nahi ho sakte
    //     if ($ticket->status === 'resolved' || $ticket->status === 'closed') {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Cannot edit a resolved or closed ticket.',
    //         ], 403);
    //     }

    //     $request->validate([
    //         'phone'   => 'required|string|max:20',
    //         'issue'   => 'required|string',
    //         'message' => 'required|string|max:1000',
    //     ]);

    //     $ticket->update([
    //         'phone'   => $request->phone,
    //         'issue'   => $request->issue,
    //         'message' => $request->message,
    //     ]);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Ticket updated successfully.',
    //         'data'    => $this->formatTicket($ticket->fresh()),
    //     ]);
    // }

    // public function studentDestroy($id)
    // {
    //     ['user' => $user, 'model' => $student] = $this->getUser('student');

    //     $ticket = SupportTicket::where('id', $id)
    //         ->where('user_type', 'student')
    //         ->where('user_id', $student?->id ?? $user->id)
    //         ->first();

    //     if (!$ticket) {
    //         return response()->json(['success' => false, 'message' => 'Ticket not found.'], 404);
    //     }

    //     $ticket->delete();

    //     return response()->json(['success' => true, 'message' => 'Ticket deleted successfully.']);
    // }

    // ===== GUARDIAN =====

    // public function guardianIndex()
    // {
    //     ['user' => $user, 'model' => $guardian] = $this->getUser('guardian');

    //     $tickets = SupportTicket::where('user_type', 'guardian')
    //         ->where('user_id', $guardian?->id ?? $user->id)
    //         ->orderBy('created_at', 'desc')
    //         ->get()
    //         ->map(fn($t) => $this->formatTicket($t));

    //     return response()->json(['success' => true, 'data' => $tickets]);
    // }

    // public function guardianStore(Request $request)
    // {
    //     ['user' => $user, 'model' => $guardian] = $this->getUser('guardian');

    //     $request->validate([
    //         'phone'   => 'required|string|max:20',
    //         'issue'   => 'required|string',
    //         'message' => 'required|string|max:1000',
    //     ]);

    //     $ticket = SupportTicket::create([
    //         'ticket_number' => SupportTicket::generateTicketNumber(),
    //         'name'          => $guardian?->first_name . ' ' . $guardian?->last_name,
    //         'email'         => $user->email,
    //         'phone'         => $request->phone,
    //         'issue'         => $request->issue,
    //         'message'       => $request->message,
    //         'user_type'     => 'guardian',
    //         'user_id'       => $guardian?->id ?? $user->id,
    //         'status'        => 'pending',
    //     ]);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Ticket submitted successfully.',
    //         'data'    => $this->formatTicket($ticket),
    //     ], 201);
    // }

    // public function guardianShow($id)
    // {
    //     ['user' => $user, 'model' => $guardian] = $this->getUser('guardian');

    //     $ticket = SupportTicket::where('id', $id)
    //         ->where('user_type', 'guardian')
    //         ->where('user_id', $guardian?->id ?? $user->id)
    //         ->first();

    //     if (!$ticket) {
    //         return response()->json(['success' => false, 'message' => 'Ticket not found.'], 404);
    //     }

    //     return response()->json(['success' => true, 'data' => $this->formatTicket($ticket)]);
    // }

    // public function guardianUpdate(Request $request, $id)
    // {
    //     ['user' => $user, 'model' => $guardian] = $this->getUser('guardian');

    //     $ticket = SupportTicket::where('id', $id)
    //         ->where('user_type', 'guardian')
    //         ->where('user_id', $guardian?->id ?? $user->id)
    //         ->first();

    //     if (!$ticket) {
    //         return response()->json(['success' => false, 'message' => 'Ticket not found.'], 404);
    //     }

    //     if ($ticket->status === 'resolved' || $ticket->status === 'closed') {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Cannot edit a resolved or closed ticket.',
    //         ], 403);
    //     }

    //     $request->validate([
    //         'phone'   => 'required|string|max:20',
    //         'issue'   => 'required|string',
    //         'message' => 'required|string|max:1000',
    //     ]);

    //     $ticket->update([
    //         'phone'   => $request->phone,
    //         'issue'   => $request->issue,
    //         'message' => $request->message,
    //     ]);

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Ticket updated successfully.',
    //         'data'    => $this->formatTicket($ticket->fresh()),
    //     ]);
    // }

    // public function guardianDestroy($id)
    // {
    //     ['user' => $user, 'model' => $guardian] = $this->getUser('guardian');

    //     $ticket = SupportTicket::where('id', $id)
    //         ->where('user_type', 'guardian')
    //         ->where('user_id', $guardian?->id ?? $user->id)
    //         ->first();

    //     if (!$ticket) {
    //         return response()->json(['success' => false, 'message' => 'Ticket not found.'], 404);
    //     }

    //     $ticket->delete();

    //     return response()->json(['success' => true, 'message' => 'Ticket deleted successfully.']);
    // }

      // ===== ADMIN =====

    public function adminIndex(Request $request)
    {
        $query = SupportTicket::with(['replies'])
            ->orderBy('created_at', 'desc');

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        if ($request->has('search') && $request->search) {
            $s = $request->search;
            $query->where(function($q) use ($s) {
                $q->where('name', 'like', "%$s%")
                  ->orWhere('email', 'like', "%$s%")
                  ->orWhere('ticket_number', 'like', "%$s%")
                  ->orWhere('issue', 'like', "%$s%");
            });
        }

        $tickets = $query->get()->map(fn($t) => $this->formatAdminTicket($t));

        return response()->json(['success' => true, 'data' => $tickets]);
    }

    public function adminReply(Request $request, $ticketId)
    {
        $ticket = SupportTicket::find($ticketId);
        if (!$ticket) {
            return response()->json(['success' => false, 'message' => 'Ticket not found.'], 404);
        }

        $request->validate([
            'reply' => 'required|string|max:2000',
        ]);

        $admin = Auth::user();

        // Reply save karo
        $reply = TicketReply::create([
            'ticket_id' => $ticket->id,
            'admin_id'  => $admin->id,
            'reply'     => $request->reply,
        ]);

        // Status update karo
        $ticket->update(['status' => 'responded']);

        return response()->json([
            'success' => true,
            'message' => 'Reply sent successfully.',
            'data'    => $this->formatAdminTicket($ticket->fresh(['replies'])),
        ]);
    }

    public function adminUpdateStatus(Request $request, $ticketId)
    {
        $ticket = SupportTicket::find($ticketId);
        if (!$ticket) {
            return response()->json(['success' => false, 'message' => 'Ticket not found.'], 404);
        }

        $request->validate([
            'status' => 'required|in:pending,in_review,responded,resolved,closed',
        ]);

        $ticket->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Status updated.',
            'data'    => $this->formatAdminTicket($ticket->fresh(['replies'])),
        ]);
    }

    private function formatAdminTicket(SupportTicket $ticket): array
    {
        $latestReply = $ticket->replies->last();

        return [
            'id'            => $ticket->id,
            'ticket_number' => $ticket->ticket_number,
            'name'          => $ticket->name,
            'email'         => $ticket->email,
            'phone'         => $ticket->phone,
            'issue'         => $ticket->issue,
            'message'       => $ticket->message,
            'status'        => $ticket->status,
            'user_type'     => $ticket->user_type,
            'has_reply'     => $ticket->replies->count() > 0,
            'reply_count'   => $ticket->replies->count(),
            'latest_reply'  => $latestReply ? [
                'id'         => $latestReply->id,
                'reply'      => $latestReply->reply,
                'created_at' => $latestReply->created_at?->format('M d, Y h:i A'),
            ] : null,
            'created_at'    => $ticket->created_at?->format('M d, Y h:i A'),
        ];
    }

    // ===== STUDENT / GUARDIAN — reply view =====

    private function getUser(string $userType): array
    {
        $user = Auth::user();
        if ($userType === 'student') {
            $model = Student::where('email', $user->email)->first();
        } else {
            $model = Guardian::where('email', $user->email)->first();
        }
        return ['user' => $user, 'model' => $model];
    }

    private function formatTicket(SupportTicket $ticket): array
    {
        $latestReply = $ticket->replies->last();

        return [
            'id'            => $ticket->id,
            'ticket_number' => $ticket->ticket_number,
            'name'          => $ticket->name,
            'email'         => $ticket->email,
            'phone'         => $ticket->phone,
            'issue'         => $ticket->issue,
            'message'       => $ticket->message,
            'status'        => $ticket->status,
            'user_type'     => $ticket->user_type,
            'has_reply'     => $ticket->replies->count() > 0,
            'latest_reply'  => $latestReply ? [
                'id'         => $latestReply->id,
                'reply'      => $latestReply->reply,
                'created_at' => $latestReply->created_at?->format('M d, Y h:i A'),
            ] : null,
            'created_at'    => $ticket->created_at?->format('M d, Y'),
            'updated_at'    => $ticket->updated_at?->format('M d, Y'),
        ];
    }

    // ===== STUDENT CRUD =====

    public function studentIndex()
    {
        ['user' => $user, 'model' => $student] = $this->getUser('student');
        $tickets = SupportTicket::with(['replies'])
            ->where('user_type', 'student')
            ->where('user_id', $student?->id ?? $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(fn($t) => $this->formatTicket($t));
        return response()->json(['success' => true, 'data' => $tickets]);
    }

    public function studentStore(Request $request)
    {
        ['user' => $user, 'model' => $student] = $this->getUser('student');
        $request->validate([
            'phone'   => 'required|string|max:20',
            'issue'   => 'required|string',
            'message' => 'required|string|max:1000',
        ]);
        $ticket = SupportTicket::create([
            'ticket_number' => SupportTicket::generateTicketNumber(),
            'name'          => trim(($student?->first_name ?? '') . ' ' . ($student?->last_name ?? '')),
            'email'         => $user->email,
            'phone'         => $request->phone,
            'issue'         => $request->issue,
            'message'       => $request->message,
            'user_type'     => 'student',
            'user_id'       => $student?->id ?? $user->id,
            'status'        => 'pending',
        ]);
        return response()->json(['success' => true, 'message' => 'Ticket submitted.', 'data' => $this->formatTicket($ticket->load('replies'))], 201);
    }

    public function studentShow($id)
    {
        ['user' => $user, 'model' => $student] = $this->getUser('student');
        $ticket = SupportTicket::with('replies')->where('id', $id)->where('user_type', 'student')->where('user_id', $student?->id ?? $user->id)->first();
        if (!$ticket) return response()->json(['success' => false, 'message' => 'Not found.'], 404);

        // ✅ Student ne dekha — agar responded tha to resolved karo
        if ($ticket->status === 'responded') {
            $ticket->update(['status' => 'resolved']);
        }

        return response()->json(['success' => true, 'data' => $this->formatTicket($ticket->fresh('replies'))]);
    }

    public function studentUpdate(Request $request, $id)
    {
        ['user' => $user, 'model' => $student] = $this->getUser('student');
        $ticket = SupportTicket::where('id', $id)->where('user_type', 'student')->where('user_id', $student?->id ?? $user->id)->first();
        if (!$ticket) return response()->json(['success' => false, 'message' => 'Not found.'], 404);
        if (in_array($ticket->status, ['resolved', 'closed'])) {
            return response()->json(['success' => false, 'message' => 'Cannot edit resolved/closed ticket.'], 403);
        }
        $request->validate(['phone' => 'required|string|max:20', 'issue' => 'required|string', 'message' => 'required|string|max:1000']);
        $ticket->update(['phone' => $request->phone, 'issue' => $request->issue, 'message' => $request->message]);
        return response()->json(['success' => true, 'message' => 'Updated.', 'data' => $this->formatTicket($ticket->fresh('replies'))]);
    }

    public function studentDestroy($id)
    {
        ['user' => $user, 'model' => $student] = $this->getUser('student');
        $ticket = SupportTicket::where('id', $id)->where('user_type', 'student')->where('user_id', $student?->id ?? $user->id)->first();
        if (!$ticket) return response()->json(['success' => false, 'message' => 'Not found.'], 404);
        $ticket->delete();
        return response()->json(['success' => true, 'message' => 'Deleted.']);
    }

    // ===== GUARDIAN CRUD =====

    public function guardianIndex()
    {
        ['user' => $user, 'model' => $guardian] = $this->getUser('guardian');
        $tickets = SupportTicket::with(['replies'])
            ->where('user_type', 'guardian')
            ->where('user_id', $guardian?->id ?? $user->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(fn($t) => $this->formatTicket($t));
        return response()->json(['success' => true, 'data' => $tickets]);
    }

    public function guardianStore(Request $request)
    {
        ['user' => $user, 'model' => $guardian] = $this->getUser('guardian');
        $request->validate(['phone' => 'required|string|max:20', 'issue' => 'required|string', 'message' => 'required|string|max:1000']);
        $ticket = SupportTicket::create([
            'ticket_number' => SupportTicket::generateTicketNumber(),
            'name'          => trim(($guardian?->first_name ?? '') . ' ' . ($guardian?->last_name ?? '')),
            'email'         => $user->email,
            'phone'         => $request->phone,
            'issue'         => $request->issue,
            'message'       => $request->message,
            'user_type'     => 'guardian',
            'user_id'       => $guardian?->id ?? $user->id,
            'status'        => 'pending',
        ]);
        return response()->json(['success' => true, 'message' => 'Ticket submitted.', 'data' => $this->formatTicket($ticket->load('replies'))], 201);
    }

    public function guardianShow($id)
    {
        ['user' => $user, 'model' => $guardian] = $this->getUser('guardian');
        $ticket = SupportTicket::with('replies')->where('id', $id)->where('user_type', 'guardian')->where('user_id', $guardian?->id ?? $user->id)->first();
        if (!$ticket) return response()->json(['success' => false, 'message' => 'Not found.'], 404);
        if ($ticket->status === 'responded') {
            $ticket->update(['status' => 'resolved']);
        }
        return response()->json(['success' => true, 'data' => $this->formatTicket($ticket->fresh('replies'))]);
    }

    public function guardianUpdate(Request $request, $id)
    {
        ['user' => $user, 'model' => $guardian] = $this->getUser('guardian');
        $ticket = SupportTicket::where('id', $id)->where('user_type', 'guardian')->where('user_id', $guardian?->id ?? $user->id)->first();
        if (!$ticket) return response()->json(['success' => false, 'message' => 'Not found.'], 404);
        if (in_array($ticket->status, ['resolved', 'closed'])) {
            return response()->json(['success' => false, 'message' => 'Cannot edit resolved/closed ticket.'], 403);
        }
        $request->validate(['phone' => 'required|string|max:20', 'issue' => 'required|string', 'message' => 'required|string|max:1000']);
        $ticket->update(['phone' => $request->phone, 'issue' => $request->issue, 'message' => $request->message]);
        return response()->json(['success' => true, 'message' => 'Updated.', 'data' => $this->formatTicket($ticket->fresh('replies'))]);
    }

    public function guardianDestroy($id)
    {
        ['user' => $user, 'model' => $guardian] = $this->getUser('guardian');
        $ticket = SupportTicket::where('id', $id)->where('user_type', 'guardian')->where('user_id', $guardian?->id ?? $user->id)->first();
        if (!$ticket) return response()->json(['success' => false, 'message' => 'Not found.'], 404);
        $ticket->delete();
        return response()->json(['success' => true, 'message' => 'Deleted.']);
    }
}