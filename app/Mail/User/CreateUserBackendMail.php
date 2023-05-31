<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: CreateUserBackendMail.php
 * User: ${USER}
 * Date: 30.${MONTH_NAME_FULL}.2023
 * Time: 07:15
 */

namespace App\Mail\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CreateUserBackendMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;

    public $userID;

    public function __construct($user, $userID)
    {
        $this->user = $user;
        $this->userID = $userID;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Dein neuer Benutzeraccount bei '.env('APP_NAME').' wurde durch einen Admin angelegt.');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.user.create-user-backend');
    }

    public function attachments(): array
    {
        return [];
    }
}
