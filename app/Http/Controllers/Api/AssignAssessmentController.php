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
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class AssignAssessmentController extends Controller
{
    public function index()
    {
        $assignments = AssignAssessment::with(['assessment_query.course', 'assessment'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $assignments
        ], 200);
    }

    public function store(Request $request)
    {

        $request->validate([
            'appointment_id'   => 'required|exists:assessment_queries,id',
            'assessment_id'    => 'required|exists:assessments,id',
            'time_to_complete' => 'required|integer',
            'total_marks'      => 'required|integer',
            'obtain_marks'     => 'nullable|integer',
            'remarks'          => 'nullable|string',
        ]);

        $exists = AssignAssessment::where('appointment_id', $request->appointment_id)
            ->where('assessment_id', $request->assessment_id)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Assessment already assigned to this appointment'
            ], 409);
        }

        $assignment = AssignAssessment::create([
            'appointment_id'   => $request->appointment_id,
            'assessment_id'    => $request->assessment_id,
            'time_to_complete' => $request->time_to_complete,
            'total_marks'      => $request->total_marks,
            'obtain_marks'     => $request->obtain_marks,
            'remarks'          => $request->remarks,
            'status'           => 'pending',
        ]);

        $assessment_query = AssessmentQuery::with('course')->find($request->appointment_id);
        $assessment  = Assessment::find($request->assessment_id);
        $questions   = AssessmentQuestion::where('assessment_id', $request->assessment_id)->get();

        $studentExists = Student::where('email', $assessment_query->email)->exists();

        if ($studentExists) {
            Mail::to($assessment_query->email)->send(new AssignAssessmentMail(
                $assessment_query->name,
                $assessment_query->course->course_name,
                $assessment->assessment_title,
                $request->time_to_complete,
                $request->total_marks,
                false,
                null
            ));
        } else {
            if (!file_exists(public_path('assets/assessment-pdf'))) {
                mkdir(public_path('assets/assessment-pdf'), 0755, true);
            }

            $pdfPath = public_path('assets/assessment-pdf/temp_assessment_' . $assessment->id . '.pdf');

            $pdf = Pdf::loadView('emails.assessment-pdf', [
                'assessmentTitle' => $assessment->assessment_title,
                'courseName'      => $assessment_query->course->course_name,
                'timeToComplete'  => $request->time_to_complete,
                'totalMarks'      => $request->total_marks,
                'questions'       => $questions,
            ]);

            $pdf->save($pdfPath);

            Mail::to($assessment_query->email)->send(new AssignAssessmentMail(
                $assessment_query->name,
                $assessment_query->course->course_name,
                $assessment->assessment_title,
                $request->time_to_complete,
                $request->total_marks,
                false,
                $pdfPath
            ));

            if (file_exists($pdfPath)) {
                unlink($pdfPath);
            }
        }

        Mail::to('info@dotbitz.com')->send(new AssignAssessmentMail(
            $assessment_query->name,
            $assessment_query->course->course_name,
            $assessment->assessment_title,
            $request->time_to_complete,
            $request->total_marks,
            true,
            null
        ));

        return response()->json([
            'success'    => true,
            'message'    => 'Assessment assigned successfully',
            'assignment' => $assignment,
            'questions'  => $questions
        ], 201);
    }

    public function show($id)
    {
        $assignment = AssignAssessment::with(['assessment_queries.course', 'assessment.questions','assessments'])->find($id);

        if (!$assignment) {
            return response()->json(['success' => false, 'message' => 'Assignment not found'], 404);
        }

        return response()->json(['success' => true, 'data' => $assignment], 200);
    }

    public function update(Request $request, $id)
    {
        $assignment = AssignAssessment::findOrFail($id);

        $request->validate([
            'obtain_marks'     => 'nullable|integer',
            'remarks'          => 'nullable|string',
            'time_to_complete' => 'sometimes|integer',
            'status'           => 'sometimes|in:pending,marked',
        ]);

        $assignment->update($request->only(['obtain_marks', 'remarks', 'time_to_complete', 'status']));

        return response()->json([
            'success' => true,
            'message' => 'Assignment updated successfully',
            'data'    => $assignment
        ], 200);
    }

    public function destroy($id)
    {
        $assignment = AssignAssessment::find($id);

        if (!$assignment) {
            return response()->json(['success' => false, 'message' => 'Assignment not found'], 404);
        }

        $assignment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Assignment deleted successfully'
        ], 200);
    }



//     public function getStudentAssessments(Request $request)
// {
//     // 1. Get the authenticated student
//     $student = $request->user();

//     if (!$student) {
//         return response()->json([
//             'success' => false,
//             'message' => 'Unauthorized'
//         ], 401);
//     }

//     // 2. Fetch assessments where the Appointment email matches the Student email
//     $assessments = AssignAssessment::with(['assessment_query.course', 'assessment'])
//         ->whereHas('assessment_query', function($query) use ($student) {
//             $query->where('email', $student->email);
//         })
//         ->orderBy('created_at', 'desc')
//         ->get();

//     return response()->json([
//         'success' => true,
//         'data' => $assessments
//     ], 200);
// }

public function getStudentAssessments(Request $request)
{
    $student = $request->user();

    if (!$student) {
        return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
    }

    $assessments = AssignAssessment::with(['assessment_query.course', 'assessment'])
        ->whereHas('assessment_query', function ($query) use ($student) {
            $query->where('email', $student->email);
        })
        ->orderBy('created_at', 'desc')
        ->get()
        ->map(function ($item) use ($student) {
            // Sirf is student ka attempt attach karo
            $item->attempt =AssessmentAttempt::where('assign_assessment_id', $item->id)
                ->where('student_id', $student->id)
                ->first();
            return $item;
        });

    return response()->json(['success' => true, 'data' => $assessments], 200);
}



public function getGuardianAssessments()
{
    // 1. Logged-in guardian
    $guardian = Auth::guard('guardian')->user();
     if (!$guardian) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }
    $student = Student::find($guardian->student_id);
     if (!$student) {
        return response()->json(['message' => 'Student not found'], 404);}

    // 3. Assessments fetch
    $assessments = AssignAssessment::with(['appointment.course', 'assessment'])
        ->whereHas('appointment', function ($query) use ($student) {
            $query->where('email', $student->email);
        }) ->get();
      return response()->json([
        'guardian_id'  => $guardian->id,
        'student_id'   => $student->id,
        'student_name' => $student->first_name . ' ' . $student->last_name,
        'assessments'  => $assessments
    ]);
}
}
