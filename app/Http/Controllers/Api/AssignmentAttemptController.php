<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\AssignmentAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Student;

class AssignmentAttemptController extends Controller
{
        // ============ STUDENT METHODS ============


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
        if ($assignment->due_date) {
            $dueDate = \Carbon\Carbon::parse($assignment->due_date);

            if (strlen($assignment->due_date) <= 10) {
                $dueDate = $dueDate->endOfDay();
            }
        }
        $isLate = now()->gt($dueDate);

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






    // ============ ADMIN/INSTRUCTOR METHODS ============

    /**
     * Batch k saary students aur unka assignment status
     */
    public function batchStudentStatus(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'batch_id'  => 'required|exists:batches,id',
        ]);

        $courseId = $request->course_id;
        $batchId  = $request->batch_id;

        // Batch k enrolled students
        $enrolledStudents = DB::table('courses_by_students')
            ->where('course_id', $courseId)
            ->where('batch_id', $batchId)
            ->pluck('student_id');

        $students = Student::whereIn('id', $enrolledStudents)->get();

        // Is course k assignments
        $assignments = Assignment::where('course_id', $courseId)
            ->where('batch_id', $batchId)
            ->get();

        // Har student ka status
        $result = $students->map(function($student) use ($assignments) {
            $studentAssignments = $assignments->map(function($assignment) use ($student) {
                $attempt = AssignmentAttempt::where('student_id', $student->id)
                    ->where('assignment_id', $assignment->id)
                    ->first();

                $status = 'not_attempted';
                if ($attempt) {
                    $status = $attempt->is_late ? 'late' : 'submitted';
                }

                return [
                    'assignment_id'    => $assignment->id,
                    'assignment_title' => $assignment->title,
                    'due_date'         => $assignment->due_date,
                    'total_marks'      => $assignment->total_marks,
                    'status'           => $status,
                    'attempt'          => $attempt,
                ];
            });

            return [
                'student_id'  => $student->id,
                'first_name'  => $student->first_name,
                'last_name'   => $student->last_name,
                'email'       => $student->email,
                'assignments' => $studentAssignments,
            ];
        });

        return response()->json([
            'success' => true,
            'data'    => [
                'students'    => $result,
                'assignments' => $assignments,
            ],
        ]);
    }

    /**
     * Single assignment attempt detail — grading ke liye
     */
    public function attemptDetailForGrading($attemptId)
    {
        $attempt = AssignmentAttempt::with(['assignment', 'student'])
            ->find($attemptId);

        if (!$attempt) {
            return response()->json(['success' => false, 'message' => 'Attempt not found.'], 404);
        }

        return response()->json(['success' => true, 'data' => $attempt]);
    }

    /**
     * Assignment grade karo
     */
    public function gradeAttempt(Request $request, $attemptId)
    {
        $request->validate([
            'marks'   => 'required|numeric|min:0',
            'remarks' => 'nullable|string',
        ]);

        $attempt = AssignmentAttempt::with('assignment')->find($attemptId);

        if (!$attempt) {
            return response()->json(['success' => false, 'message' => 'Attempt not found.'], 404);
        }


            // ✅ Validate marks against total
        $totalMarks = (float)($attempt->assignment->total_marks ?? 0);

        $request->validate([
            'marks'   => "required|numeric|min:0|max:{$totalMarks}",
            'remarks' => 'nullable|string',
        ]);

        $attempt->update([
            'marks'   => $request->marks,
            'remarks' => $request->remarks,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Assignment graded successfully.',
            'data'    => $attempt,
        ]);
    }


    /**
     * Mark as not attempted — zero marks
     */
    public function markNotAttempted(Request $request)
    {
        // Yeh auto handle hoga — jo attempt nahi kiya uske marks 0 shown honge
        return response()->json(['success' => true]);
    }

}
