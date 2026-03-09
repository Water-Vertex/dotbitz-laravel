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

    public function __construct(
        public string $recipientName,
        public string $announcementTitle,
        public string $announcementMessage,
        public string $priority,
        public string $announcedBy,
        public string $announcedByName,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[DotBitz] ' . $this->announcementTitle,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.announcement',
        );
    }
}