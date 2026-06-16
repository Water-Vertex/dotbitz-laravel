<?php

namespace App\Mail;

use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StudentEnrollmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $student;

    /**
     * Create a new message instance.
     */
    public function __construct(Student $student)
    {
        //
        $this->student = $student;
    }
    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->subject('You have successfully registered your account')
                    ->view('emails.student-enrollment');
    }
}
