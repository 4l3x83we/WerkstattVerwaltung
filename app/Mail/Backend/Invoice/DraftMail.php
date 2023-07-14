<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: DraftMail.php
 * User: ${USER}
 * Date: 13.${MONTH_NAME_FULL}.2023
 * Time: 17:33
 */

namespace App\Mail\Backend\Invoice;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DraftMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $mail;

    public function __construct($mail)
    {
        $this->mail = $mail;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: $this->mail['subject']);
    }

    public function content(): Content
    {
        return new Content(view: 'emails.backend.invoice.draft');
    }

    public function attachments(): array
    {
        return [
            Attachment::fromPath(public_path('dokumente/'.replaceStrToLower($this->mail['fullname'].'/rechnungen').'/Rechnung-'.$this->mail['invoice_nr'].'.pdf'))
                ->as('Entwurfsrechnung-'.$this->mail['invoice_nr'].'.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
