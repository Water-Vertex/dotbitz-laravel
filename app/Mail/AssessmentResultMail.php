<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AssessmentResultMail extends Mailable
{
    use Queueable, SerializesModels;

    public $recipientName;
    public $courseName;
    public $assessmentTitle;
    public $obtainedMarks;
    public $totalMarks;
    public $remarks;
    public $email;
    public $userType;

    public function __construct($recipientName, $courseName, $assessmentTitle, $obtainedMarks, $totalMarks, $remarks, $email, $userType = 'guest')
    {
        $this->recipientName = $recipientName;
        $this->courseName = $courseName;
        $this->assessmentTitle = $assessmentTitle;
        $this->obtainedMarks = $obtainedMarks;
        $this->totalMarks = $totalMarks;
        $this->remarks = $remarks;
        $this->email = $email;
        $this->userType = $userType;
    }

    public function build()
    {
        return $this->subject('Your Assessment Result - DotBitz')
                    ->view('emails.assessment-result');
    }
}