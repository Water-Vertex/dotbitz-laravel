<?php

namespace App\Mail;

use App\Models\Guardian;
use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StudentEnrollmentToGuardianMail extends Mailable
{
    use Queueable, SerializesModels;

     public $student;
     public $guardian;
     public $pwd;

    /**
     * Create a new message instance.
     */
    public function __construct(Student $student , Guardian $guardian, $pwd)
    {
        //
        $this->student = $student;
        $this->guardian = $guardian;
        $this->pwd = $pwd;

    }
    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->subject('Student Enrollment Confirmation')
                    ->view('emails.student-enrollment-to-guardian');
    }
}
