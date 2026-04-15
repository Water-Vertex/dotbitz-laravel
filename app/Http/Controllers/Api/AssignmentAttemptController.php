<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\AssignmentAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AssignmentAttemptController extends Controller
{
   public function checkAttempt($assignmentId)
    {
        $user = Auth::user();

        // Student model se id nikalo same as quiz pattern
        $student = \App\Models\Student::where('email', $user->email)->first();

        if (!$student) {
            // Agar direct student auth hai
            $studentId = $user->id;
        } else {
            $studentId = $student->id;
        }

        $attempt = AssignmentAttempt::where('student_id', $studentId)
            ->where('assignment_id', $assignmentId)
            ->first();

        return response()->json([
            'success'   => true,
            'attempted' => $attempt ? true : false,
            'attempt'   => $attempt,
        ]);
    }

    public function submit(Request $request, $assignmentId)
    {
        $request->validate([
            'doc_file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
        ]);

        $user = Auth::user();
        $student = \App\Models\Student::where('email', $user->email)->first();

        if (!$student) {
            $studentId = $user->id;
        } else {
            $studentId = $student->id;
        }

        // Already attempted check
        $existing = AssignmentAttempt::where('student_id', $studentId)
            ->where('assignment_id', $assignmentId)
            ->first();

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'You have already submitted this assignment.',
            ], 409);
        }

        $assignment = Assignment::find($assignmentId);

        if (!$assignment) {
            return response()->json([
                'success' => false,
                'message' => 'Assignment not found.',
            ], 404);
        }

        // Late check
        $isLate = false;
        if ($assignment->due_date && now()->gt($assignment->due_date)) {
            $isLate = true;
        }

        // File save
        $file     = $request->file('doc_file');
        $filename = time() . '_' . $studentId . '_' . $file->getClientOriginalName();

        // Directory exist check
        if (!file_exists(public_path('assets/assignment_attempts'))) {
            mkdir(public_path('assets/assignment_attempts'), 0755, true);
        }

        $file->move(public_path('assets/assignment_attempts'), $filename);

        $attempt = AssignmentAttempt::create([
            'assignment_id' => $assignmentId,
            'student_id'    => $studentId,
            'doc_file'      => $filename,
            'submitted_at'  => now(),
            'is_late'       => $isLate,
        ]);

        return response()->json([
            'success' => true,
            'message' => $isLate
                ? 'Assignment submitted successfully (Late submission).'
                : 'Assignment submitted successfully.',
            'data'    => $attempt,
            'is_late' => $isLate,
        ], 201);
    }

    public function myAttempts()
    {
        $user = Auth::user();
        $student = \App\Models\Student::where('email', $user->email)->first();
        $studentId = $student ? $student->id : $user->id;

        $attempts = AssignmentAttempt::with('assignment')
            ->where('student_id', $studentId)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $attempts,
        ]);
    }
}
