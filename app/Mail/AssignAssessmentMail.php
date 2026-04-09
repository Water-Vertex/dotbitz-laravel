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
    public $pdfPath;

    public function __construct($recipientName, $courseName, $assessmentTitle, $timeToComplete, $totalMarks, $isAdmin = false, $pdfPath = null)
    {
        $this->recipientName   = $recipientName;
        $this->courseName      = $courseName;
        $this->assessmentTitle = $assessmentTitle;
        $this->timeToComplete  = $timeToComplete;
        $this->totalMarks      = $totalMarks;
        $this->isAdmin         = $isAdmin;
        $this->pdfPath         = $pdfPath;
    }

    public function build()
    {
        $subject = $this->isAdmin
            ? 'New Assessment Assigned - ' . $this->courseName
            : 'Assessment Assigned - ' . $this->courseName;

        $mail = $this->subject($subject)
                     ->view('emails.assign-assessment');

        if ($this->pdfPath) {
            $mail->attach($this->pdfPath, [
                'as'   => 'assessment.pdf',
                'mime' => 'application/pdf',
            ]);
        }

        return $mail;
    }
}