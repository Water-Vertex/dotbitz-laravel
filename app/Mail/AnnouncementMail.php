<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AnnouncementMail extends Mailable
{
    use Queueable, SerializesModels;
        public  $recipientName;
        public  $announcementTitle;
        public  $announcementMessage;
        public  $priority;
        public  $announcedBy;
        public  $announcedByName;

    public function __construct($recipientName,$announcementTitle,$announcementMessage,$priority,$announcedBy,$announcedByName) {
        $this->recipientName = $recipientName;
        $this->announcementTitle = $announcementTitle;
        $this->announcementMessage = $announcementMessage;
        $this->priority = $priority;
        $this->announcedBy = $announcedBy;
        $this->announcedByName = $announcedByName;
    }

     public function build()
    {
        return $this->subject($this->announcementTitle)
                    ->view('emails.announcement');
    }
}