<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\AdminAppointmentConfirmationMail;
use App\Mail\AdminContactMail;
use App\Mail\CustomerAppointmentConfirmationMail;
use App\Models\Appointment;
use App\Models\Contact;
use App\Models\Course;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    //
    public function index()
    {
        $courses = Course::where('status', 'active')->get();
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
        return redirect()->back();
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
        ->with('instructor')
        ->firstOrFail();

    // Get related courses (same level or category)
    $relatedCourses = Course::where('id', '!=', $course->id)
        ->where('status', 'active')
        ->inRandomOrder()
        ->limit(3)
        ->get();

    return view('user.pages.course-details', get_defined_vars());
}

    public function storeAppointment(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',

            'email' => [
                'required',
                'email',
                'max:50',

            ],

            'phone' => [
                'required',
                'string',
                'max:20',

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

        return redirect()->back()->with('success', 'Appointment booked successfully!');
    }
}
