<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: OrderMail.php
 * User: ${USER}
 * Date: 13.${MONTH_NAME_FULL}.2023
 * Time: 16:10
 */

namespace App\Mail\Backend\Invoice;

use App\Models\Backend\Emails\Emails;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable implements ShouldQueue
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
        Emails::create([
            'invoice_id' => $this->mail['invoice_id'],
            'customer_id' => $this->mail['customer_id'],
            'email_art' => 'Auftrag',
            'email_empfaenger' => $this->mail['email'],
            'email_betreff' => $this->mail['subject'],
            'email_send_date' => Carbon::now()->format('Y-m-d'),
        ]);

        return new Content(view: 'emails.backend.invoice.order');
    }

    public function attachments(): array
    {
        return [
            Attachment::fromPath(public_path('dokumente/'.replaceStrToLower($this->mail['fullname'].'/auftrag').'/Auftrag-'.$this->mail['invoice_nr'].'.pdf'))
                ->withMime('application/pdf'),
        ];
    }
}
