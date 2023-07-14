<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: WorkOrderMail.php
 * User: ${USER}
 * Date: 13.${MONTH_NAME_FULL}.2023
 * Time: 16:43
 */

namespace App\Mail\Backend\Invoice;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WorkOrderMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $invoice;

    public $mail;

    public $settings;

    public $pdf;

    public function __construct($invoice, $mail, $settings, $pdf)
    {
        $this->invoice = $invoice;
        $this->mail = $mail;
        $this->settings = $settings;
        $this->pdf = $pdf;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: $this->mail['subject']);
    }

    public function content(): Content
    {
        return new Content(view: 'emails.backend.invoice.work-order');
    }

    public function attachments(): array
    {
        return [
            Attachment::fromPath(public_path('dokumente/'.replaceStrToLower($this->invoice->customer->fullname().'/arbeitsauftraege').'/Arbeitsauftrag-'.$this->invoice->order_nr.'.pdf'))
                ->withMime('application/pdf'),
        ];
    }
}
