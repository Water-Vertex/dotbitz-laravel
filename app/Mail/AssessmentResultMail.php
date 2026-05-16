<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AssessmentResultMail extends Mailable
{
    use Queueable, SerializesModels;

   // AssessmentResultMail.php

public $recipientName;
public $courseName;
public $assessmentTitle;
public $obtainedMarks;
public $totalMarks;
public $remarks;
public $email;
public function __construct($recipientName, $courseName, $assessmentTitle, $obtainedMarks, $totalMarks, $remarks, $email)
{
    $this->recipientName = $recipientName;
    $this->courseName = $courseName;
    $this->assessmentTitle = $assessmentTitle;
    $this->obtainedMarks = $obtainedMarks;
    $this->totalMarks = $totalMarks;
    $this->remarks = $remarks;
    $this->email = $email;
}

    public function build()
    {
        return $this->subject("Assessment Result: Your test for {$this->courseName} has been checked")
                    ->view('emails.assessment-result');
    }
}
