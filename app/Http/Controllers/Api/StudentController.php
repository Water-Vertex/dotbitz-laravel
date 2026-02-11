<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\StudentEnrollmentMail;
use App\Mail\StudentEnrollmentToAdminMail;
use App\Mail\StudentEnrollmentToGuardianMail;
use App\Models\Guardian;
use App\Models\Student;
use App\Models\StudentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with(['studentDetails', 'guardian'])->get();

        return response()->json([
            'success' => true,
            'data' => $students
        ]);
    }

    public function adminRegister(Request $request)
    {
        $request->merge(['student.status' => 1]);
        return $this->register($request);
    }


    public function update(Request $request, $id)
{
    $student = Student::find($id);
    if (!$student) {
        return response()->json([
            'success' => false,
            'message' => 'Student not found'
        ], 404);
    }

    $studentData = $request->input('student');
    if(isset($studentData['password'])){
        $studentData['password'] = Hash::make($studentData['password']);
    }

    $student->update($studentData);

    // Update student details if provided
    if($request->has('student_details')){
        foreach($request->input('student_details') as $detail){
            StudentDetail::updateOrCreate(
                ['student_id' => $student->id, 'id' => $detail['id'] ?? null],
                [
                    'institution' => $detail['institution'],
                    'degree' => $detail['degree'],
                    'field_of_study' => $detail['field_of_study'] ?? null,
                    'start_date' => $detail['start_date'],
                    'end_date' => $detail['is_current'] ? null : ($detail['end_date'] ?? null),
                    'is_current' => $detail['is_current'] ?? false,
                    'description' => $detail['description'] ?? null,
                ]
            );
        }
    }

    // Update guardian if provided
    if($request->has('guardian')){
        $guardianData = $request->input('guardian');
        Guardian::updateOrCreate(
            ['student_id' => $student->id],
            $guardianData
        );
    }

    return response()->json([
        'success' => true,
        'message' => 'Student updated successfully',
        'data' => $student->fresh(['studentDetails','guardian'])
    ]);
}

public function destroy($id)
{
    $student = Student::find($id);
    if(!$student){
        return response()->json([
            'success' => false,
            'message' => 'Student not found'
        ], 404);
    }

    $student->delete();

    return response()->json([
        'success' => true,
        'message' => 'Student deleted successfully'
    ]);
}

    // Register a new student
    public function register(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'student.first_name' => 'required|string|max:100',
            'student.last_name' => 'required|string|max:100',
            'student.user_name' => 'required|string|max:100|unique:students,user_name',
            'student.email' => 'required|email|max:50|unique:students,email',
            'student.phone' => 'required|string|max:20|unique:students,phone',
            'student.date_of_birth' => 'required|date',
            'student.gender' => 'required|in:male,female,other',
            'student.address' => 'nullable|string|max:255',
            'student.state' => 'nullable|string|max:255',
            'student.city' => 'nullable|string|max:255',
            'student.zipcode' => 'nullable|string|max:255',
            'student.password' => 'required|string|min:6|max:255',

            'student_details' => 'required|array|min:1',
            'student_details.*.institution' => 'required|string|max:255',
            'student_details.*.degree' => 'required|string|max:255',
            'student_details.*.field_of_study' => 'nullable|string|max:255',
            'student_details.*.start_date' => 'required|date',
            'student_details.*.end_date' => 'nullable|date|after_or_equal:student_details.*.start_date',
            'student_details.*.is_current' => 'boolean',
            'student_details.*.description' => 'nullable|string',

            'guardian' => 'sometimes|required_if:student.date_of_birth,<,18|array',
            'guardian.first_name' => 'required_if:guardian,exists|string|max:100',
            'guardian.last_name' => 'required_if:guardian,exists|string|max:100',
            'guardian.email' => 'required_if:guardian,exists|email|max:50',
            'guardian.phone' => 'required_if:guardian,exists|string|max:20',
            'guardian.relationship' => 'required_if:guardian,exists|in:parent,legal_guardian,sibling,other',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Calculate age from date of birth
        $dateOfBirth = $request->input('student.date_of_birth');
        $age = \Carbon\Carbon::parse($dateOfBirth)->age;

        // Check if guardian is required but not provided
        if ($age < 18 && !$request->has('guardian')) {
            return response()->json([
                'success' => false,
                'message' => 'Guardian information is required for students under 18 years old'
            ], 422);
        }

        try {
            // Start database transaction
            DB::beginTransaction();

            // Create student
            $studentData = $request->input('student');
            $studentData['password'] = Hash::make($studentData['password']);
            $studentData['student_uid'] = 'STD'.uniqid();
            $studentData['status'] = 0;

            $student = Student::create($studentData);
            Mail::to('enrollments@dotbitz.com')->send(new StudentEnrollmentToAdminMail($student));
            Mail::to($student->email)->send(new StudentEnrollmentMail($student));

            // Create student details
            foreach ($request->input('student_details') as $detail) {
                StudentDetail::create([
                    'student_id' => $student->id,
                    'institution' => $detail['institution'],
                    'degree' => $detail['degree'],
                    'field_of_study' => $detail['field_of_study'] ?? null,
                    'start_date' => $detail['start_date'],
                    'end_date' => $detail['is_current'] ? null : ($detail['end_date'] ?? null),
                    'is_current' => $detail['is_current'] ?? false,
                    'description' => $detail['description'] ?? null,
                ]);
            }

            // Create guardian if provided
            if ($request->has('guardian') && $age < 18) {
                $guardianData = $request->input('guardian');
                $guardianData['student_id'] = $student->id;
                $pwd = 'PWD'.mt_rand(9999,99999);
                $guardianData['password'] = Hash::make($pwd);
                $guardian = Guardian::create($guardianData);
                Mail::to($guardian->email)->send(new StudentEnrollmentToGuardianMail($student,$guardian,$pwd));
            }

            // Commit transaction
            DB::commit();

            // Generate token for immediate login (optional)
            $token = $student->createToken('student-auth-token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Student registered successfully',
                'data' => [
                    'student' => $student,
                    'token' => $token
                ]
            ], 201);

        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Registration failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // Check if email exists
    public function checkEmailExists($email)
    {
        $exists = Student::where('email', $email)->exists();

        return response()->json([
            'exists' => $exists
        ]);
    }

    // Check if username exists
    public function checkUsernameExists($username)
    {
        $exists = Student::where('user_name', $username)->exists();

        return response()->json([
            'exists' => $exists
        ]);
    }

    // Get student details
    public function show($id)
    {
        $student = Student::with(['studentDetails', 'guardian'])->find($id);

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $student
        ]);
    }

    // Get student's student details
    public function getStudentDetails($studentId)
    {
        $studentDetails = StudentDetail::where('student_id', $studentId)->get();

        return response()->json([
            'success' => true,
            'data' => $studentDetails
        ]);
    }

    // Get student's guardian
    public function getGuardian($studentId)
    {
        $guardian = Guardian::where('student_id', $studentId)->first();

        if (!$guardian) {
            return response()->json([
                'success' => false,
                'message' => 'Guardian not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $guardian
        ]);
    }
}
