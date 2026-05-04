<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\PreRegistration;

class PreRegistrationConfirmationMail extends Mailable
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
            subject: 'Pre-Registration Confirmed — DotBitz!',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.pre-registration-confirmation',
        );
    }
}