<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AssignAssessmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $recipientName;
public $courseName;
public $assessmentTitle;
public $timeToComplete;
public $totalMarks;
public $isAdmin;
public $isGuest;
public $assessmentId;
public $email;
public $dueDate;

public function __construct(
    $recipientName,
    $courseName,
    $assessmentTitle,
    $timeToComplete,
    $totalMarks,
    $isAdmin = false,
    $isGuest = false,
    $assessmentId = null,
    $email = null,
    $dueDate = null
) {
    $this->recipientName   = $recipientName;
    $this->courseName      = $courseName;
    $this->assessmentTitle = $assessmentTitle;
    $this->timeToComplete  = $timeToComplete;
    $this->totalMarks      = $totalMarks;
    $this->isAdmin         = $isAdmin;
    $this->isGuest         = $isGuest;
    $this->assessmentId    = $assessmentId;
    $this->email           = $email;
    $this->dueDate         = $dueDate;
}

    public function build()
    {
        $subject = $this->isAdmin
            ? 'New Assessment Assigned - ' . $this->courseName
            : 'Assessment Assigned - ' . $this->courseName;

        return $this->subject($subject)
                    ->view('emails.assign-assessment');
    }
}
