<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: RegisterMail.php
 * User: ${USER}
 * Date: 29.${MONTH_NAME_FULL}.2023
 * Time: 06:27
 */

namespace App\Mail\Register;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegisterMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Ein neuer Benutzer mit dem Namen '.$this->user->name.' hat sich angemeldet.');
    }

    public function content(): Content
    {
        return new Content(markdown: 'emails.register.register');
    }

    public function attachments(): array
    {
        return [];
    }
}
