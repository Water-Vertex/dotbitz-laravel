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

    /**
     * Create a new message instance.
     */
    public function __construct(Student $student , Guardian $guardian)
    {
        //
        $this->student = $student;
        $this->guardian = $guardian;
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
