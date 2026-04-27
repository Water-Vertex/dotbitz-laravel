<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignAssessment;
use App\Models\AssessmentQuery;
use App\Models\Assessment;
use App\Models\AssessmentQuestion;
use App\Models\Student;
use App\Models\AssessmentAttempt;
use App\Mail\AssignAssessmentMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Exception;
use Carbon\Carbon;

class AssignAssessmentController extends Controller
{
    public function index()
    {
        $assignments = AssignAssessment::with(['assessment_query.course', 'assessment'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['success' => true, 'data' => $assignments], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'appointment_id'   => 'required|exists:assessment_queries,id',
            'assessment_id'    => 'required|exists:assessments,id',
            'time_to_complete' => 'required|integer',
            'total_marks'      => 'required|integer',
            'due_date'         => 'required|date', // Sirf date lega
        ]);

       
        $dueDateOnly = Carbon::parse($request->due_date)->format('Y-m-d') . ' 00:00:00';

        $assignedAssessment = AssignAssessment::create([
            'appointment_id'   => $request->appointment_id,
            'assessment_id'    => $request->assessment_id,
            'time_to_complete' => $request->time_to_complete,
            'total_marks'      => $request->total_marks,
            'due_date'         => $dueDateOnly, // Database mein sirf date save
            'status'           => 'pending',
        ]);

        $assessment_query = AssessmentQuery::with('course')->find($request->appointment_id);
        $assessment       = Assessment::find($request->assessment_id);
        $studentExists    = Student::where('email', $assessment_query->email)->exists();

        Mail::to($assessment_query->email)->send(new AssignAssessmentMail(
            $assessment_query->full_name, 
            $assessment_query->course->course_name,
            $assessment->assessment_title,
            $request->time_to_complete,
            $request->total_marks,
            false, 
            !$studentExists, 
            $assignedAssessment->id, 
            $assessment_query->email,
            $dueDateOnly 
        ));
        
        return response()->json(['success' => true, 'assignment' => $assignedAssessment], 201);
    }

    // ================= GUEST ASSESSMENTS =================
    public function getGuestAssessments(Request $request)
    {
        try {
            $email = $request->header('X-Guest-Email');

            if (!$email) {
                return response()->json(['success' => false, 'message' => 'Guest email is required'], 400);
            }

            $assessments = AssignAssessment::with(['assessment_query.course', 'assessment'])
                ->whereHas('assessment_query', function ($query) use ($email) {
                    $query->where('email', $email);
                })
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($item) use ($email) {
                    $item->attempt = AssessmentAttempt::where('assign_assessment_id', $item->id)
                        ->where('guest_id', $email) 
                        ->first();
                   
                    if ($item->due_date) {
                        $item->due_date = Carbon::parse($item->due_date)->format('Y-m-d');
                    }
                    return $item;
                });

            return response()->json([
                'success' => true, 
                'count'   => $assessments->count(),
                'data'    => $assessments
            ], 200);

        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    // ================= STUDENT ASSESSMENTS =================
    public function getStudentAssessments(Request $request)
    {
        $student = $request->user();
        if (!$student) return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);

        $assessments = AssignAssessment::with(['assessment_query.course', 'assessment'])
            ->whereHas('assessment_query', function ($query) use ($student) {
                $query->where('email', $student->email);
            })
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($item) use ($student) {
                $item->attempt = AssessmentAttempt::where('assign_assessment_id', $item->id)
                    ->where('student_id', $student->id)
                    ->first();
                // ✅ Sirf date part return karo
                if ($item->due_date) {
                    $item->due_date = Carbon::parse($item->due_date)->format('Y-m-d');
                }
                return $item;
            });

        return response()->json(['success' => true, 'data' => $assessments], 200);
    }

    // ================= GUARDIAN ASSESSMENTS =================
    public function getGuardianAssessments()
    {
        $guardian = Auth::guard('guardian')->user();
        if (!$guardian) return response()->json(['message' => 'Unauthorized'], 401);

        $student = Student::find($guardian->student_id);
        if (!$student) return response()->json(['message' => 'Student not found'], 404);

        $assessments = AssignAssessment::with(['assessment_query.course', 'assessment'])
            ->whereHas('assessment_query', function ($query) use ($student) {
                $query->where('email', $student->email);
            })->get()
            ->map(function ($item) {
                if ($item->due_date) {
                    $item->due_date = Carbon::parse($item->due_date)->format('Y-m-d');
                }
                return $item;
            });

        return response()->json([
            'student_name' => $student->first_name . ' ' . $student->last_name,
            'assessments'  => $assessments
        ]);
    }

    public function show($id)
    {
        $assignment = AssignAssessment::with(['assessment_query.course', 'assessment.questions'])->find($id);
        if (!$assignment) return response()->json(['success' => false, 'message' => 'Not found'], 404);
        
        if ($assignment->due_date) {
            $assignment->due_date = Carbon::parse($assignment->due_date)->format('Y-m-d');
        }
        
        return response()->json(['success' => true, 'data' => $assignment], 200);
    }

    public function update(Request $request, $id)
    {
        $assignment = AssignAssessment::findOrFail($id);
        $assignment->update($request->only(['obtain_marks', 'remarks', 'status']));
        return response()->json(['success' => true, 'data' => $assignment], 200);
    }

    public function destroy($id)
    {
        AssignAssessment::destroy($id);
        return response()->json(['success' => true, 'message' => 'Deleted successfully'], 200);
    }
}