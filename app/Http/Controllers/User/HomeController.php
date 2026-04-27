<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\AdminAppointmentConfirmationMail;
use App\Mail\AdminContactMail;
use App\Mail\CustomerAppointmentConfirmationMail;
use App\Models\Appointment;
use App\Models\Assessment;
use App\Models\AssessmentQuery;
use App\Models\Contact;
use App\Models\Course;
use App\Models\Policy;
use App\Models\CoursesByStudent;
use App\Models\Faq;
use App\Models\PreRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    //
    public function index()
    {
        $courses = Course::where('status', 'active')->get();
        $faqs = Faq::all();
        return view('user.pages.index', get_defined_vars());
    }

    public function About()
    {
        return view('user.pages.about');
    }

    public function Contact()
    {
        return view('user.pages.contact');
    }

    public function storeContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:50',
            'phone' => 'required|string|max:20',
            'subject' => 'nullable|string|max:150',
            'message' => 'required|string|max:500',
        ]);

        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

         // ✅ Send email to admin
        Mail::to('info@dotbitz.com')->send(new AdminContactMail($contact));
        flash()->success('Your message has been sent successfully!');
        return redirect()->route('user.contact-thankyou');
    }
    public function Faq()
    {
        $faqs = Faq::all();
        return view('user.pages.faq',get_defined_vars());
    }


    public function Courses()
    {
        $courses = Course::where('status', 'active')->get(); // fetch all courses
        return view('user.pages.courses', get_defined_vars()); // pass to view
    }

    public function CourseDetails($slug)
    {
         $course = Course::where('slug', $slug)
        ->with('instructor','curriculums')
        ->firstOrFail();

        // dd($course);

        $student_count = CoursesByStudent::where('course_id',$course->id)->count();

    // Get related courses (same level or category)
    $relatedCourses = Course::where('id', '!=', $course->id)
        ->where('status', 'active')
        ->inRandomOrder()
        ->limit(3)
        ->get();

    return view('user.pages.course-details', get_defined_vars());
}

public function Assessmentindex()
{
    // dd(1);
    $assessment_queries = AssessmentQuery::with('course')
        ->withExists('assigned as already_assigned')
        ->get();
    //   dd($assessment_queries);
    return response()->json($assessment_queries);
}

    public function storeAppointment(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',

            'email' => [
                'required',
                'email',
                'max:50',
                Rule::unique('appointments')->where(function ($q) use ($request) {
                    return $q->where('course_id', $request->course_id);
                }),

            ],

            'phone' => [
                'required',
                'string',
                'max:20',
                Rule::unique('appointments')->where(function ($q) use ($request) {
                    return $q->where('course_id', $request->course_id);
                }),

            ],

            'message' => 'nullable|string|max:255',
            'appointment_date' => 'required',
            'appointment_time' => 'required',
            'course_id' => 'required|integer',
        ], [
            'email.unique' => 'This email is already booked for this course.',
            'phone.unique' => 'This phone number is already booked for this course.',
        ]);



        $appointment = Appointment::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'course_id' => $request->course_id,
        ]);
        // ✅ Send email to user
        Mail::to($appointment->email)->send(new CustomerAppointmentConfirmationMail($appointment));


        // ✅ Send email to admin
        Mail::to('info@dotbitz.com')->send(new AdminAppointmentConfirmationMail($appointment));

        return redirect()->route('user.appointment-thankyou')->with('success', 'Appointment booked successfully!');
    }

     public function Policy($slug)
    {
        $policy = Policy::where('slug',$slug)->first();
        return view('user.pages.policy',get_defined_vars());
    }

   public function storeAssessmentQuery(Request $request)
{
    $request->validate([
        'full_name' => 'required|string|max:100',
        'email' => 'required|email|max:50',
        'phone' => 'required|string|max:20',
        'course_id' => 'required',
    ]);

    // Check duplicate registration
    // $exists = AssessmentQuery::where('email', $request->email)
    //     ->where('course_id', $request->course_id)
    //     ->exists();

    // if ($exists) {
    //     return back()->with('error' , 'You have already booked this course.');
    // }

    // Save the assessment
    AssessmentQuery::create([
        'full_name' => $request->full_name,
        'email' => $request->email,
        'phone' => $request->phone,
        'course_id' => $request->course_id,
        'message' => $request->message,
    ]);

    return redirect()->route('user.assessment-thankyou')->with('success', 'You have successfully registered for this course.');
}

 public function getAssessmentsForAppointment($id)
{
    $assessment_query = AssessmentQuery::find($id);

    if (!$assessment_query) {
        return response()->json(['message' => 'Assessment Query not found'], 404);
    }

    if (!$assessment_query->course_id) {
        return response()->json(['message' => 'Course not found for this assessment'], 404);
    }

    $assessments = Assessment::with('questions')
        ->where('course_id', $assessment_query->course_id)
        ->get()
        ->map(function ($a) {
            return [
               'id' => $a->id,
                'assessment_title' => $a->assessment_title,
                'total_marks' => $a->total_marks,
                'questions' => $a->questions->map(function ($q) {
                    return [
                        'id' => $q->id,
                        'question' => $q->question,
                        'marks' => $q->marks,
                    ];
                }),
            ];
        });

    return response()->json([
        'success' => true,
        'data' => $assessments
    ]);
}
    public function BookAssessment($id)
    {
        $course = Course::find($id);
        return view('user.pages.book-assessment', get_defined_vars());
    }

    public function BookFreeAppointment()
    {
        $courses = Course::where('status','active')->get();
        return view('user.pages.book-free-appointment', get_defined_vars());
    }

    public function AssessmentThankyou()
    {
        return view('user.pages.assessment-thankyou');
    }

    public function AppointmentThankyou()
    {
        return view('user.pages.appointment-thankyou');
    }

    public function ContactThankyou()
    {
        return view('user.pages.contact-thankyou');
    }

    public function PreRegisThankyou()
    {
        return view('user.pages.pre-regis-thankyou');
    }

    public function PreRegistration()
    {
        return view('user.pages.pre-registration');
    }

    public function StorePreRegister(Request $request)
    {
        $preregister = new PreRegistration;
        $preregister->name = $request->name;
        $preregister->phone = $request->phone;
        $preregister->email = $request->email;
        $preregister->message = $request->message;
        if($preregister->save())
        {
            return redirect()->route('user.pre-regis-thankyou')->with('success', 'Your Pre Registeration form Submitted successfully!');
        }
        else{
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }



}
