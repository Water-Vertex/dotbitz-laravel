<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\PreRegistration;

class AdminPreRegistrationMail extends Mailable
{
    use Queueable, SerializesModels;

    public PreRegistration $preRegistration;

    public function __construct(PreRegistration $preRegistration)
    {
        $this->preRegistration = $preRegistration;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Pre-Registration — ' . $this->preRegistration->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.admin-pre-registration',
        );
    }
}