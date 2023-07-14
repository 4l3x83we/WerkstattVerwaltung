<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: MailModal.php
 * User: ${USER}
 * Date: 13.${MONTH_NAME_FULL}.2023
 * Time: 07:45
 */

namespace App\Http\Livewire\Backend\Office\Invoice\Mail;

use App\Http\Livewire\Modal;
use App\Mail\Backend\Invoice\InvoiceMail;
use App\Models\Admin\Settings\CompanySettings;
use App\Models\Backend\Customers\Customer;
use Carbon\Carbon;
use Mail;

class InvoiceMailModal extends Modal
{
    public $invoice;

    public $customer;

    public $mail;

    public $greeting;

    public $settings;

    protected $rules = [
        'customer.customer_email' => 'required',
        'mail.cc_email' => 'nullable',
        'mail.bcc_email' => 'nullable',
        'mail.subject' => 'required',
        'mail.text' => 'required',
    ];

    public function mount()
    {
        $this->settings = CompanySettings::latest()->first();
        $this->customer = Customer::where('id', $this->invoice->customer_id)->first();
        $this->mail['cc_email'] = $this->settings->company_email;
        $this->mail['subject'] = 'Ihre Rechnung der '.$this->settings->company_name.' mit der Re-Nr.: '.$this->invoice->invoice_nr;
        $this->greeting = $this->greeting($this->invoice);
        $this->mail['text'] = $this->greeting;
    }

    public function greeting($invoice)
    {
        $hour = Carbon::now()->format('H');
        if ($hour < 11) {
            $greeting = 'Guten Morgen '.$this->invoice->customer->customer_salutation.' '.$this->invoice->customer->fullname().',';
        } elseif ($hour < 18) {
            $greeting = 'Guten Tag '.$this->invoice->customer->customer_salutation.' '.$this->invoice->customer->fullname().',';
        } elseif ($hour < 24) {
            $greeting = 'Guten Abend '.$this->invoice->customer->customer_salutation.' '.$this->invoice->customer->fullname().',';
        }
        $text = $greeting;
        $text .= '

danke für ihr Vertrauen.

Im Anhang finden sie unsere Rechnung mit der Rechnungsnummer: '.$this->invoice->invoice_nr.'.

Sollten Sie noch Fragen haben, melden Sie sich gern jederzeit.

Mit freundlichen Grüßen';
        $text .= '

'.$this->invoice->invoice_clerk;
        $text .= '

'.$this->settings->company_name.'
'.$this->settings->company_street.'
'.$this->settings->company_post_code.' '.$this->settings->company_city.'

Telefon: '.$this->settings->company_telefon.'
Mobil: '.$this->settings->company_mobil.'
'.$this->settings->company_email;

        return $text;
    }

    public function mail()
    {
        if ($this->customer->customer_email) {
            $mail = $this->mail;
            $mail['email'] = $this->customer->customer_email;
            $mail['fullname'] = $this->invoice->customer->fullname();
            $mail['invoice_nr'] = $this->invoice->invoice_nr;
            $pdf = $this->invoice->savePDF('Rechnung');
            Mail::to($mail['email'])->cc($mail['cc_email'] ?? null)->bcc($mail['bcc_email'] ?? null)->send(new InvoiceMail($mail));
            session()->flash('success', 'Die Rechnung wurde per E-Mail versendet.');
        } else {
            session()->flash('error', 'Die Rechnung wurde nicht versendet E-Mail Adresse fehlt.');
        }

        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.backend.office.invoice.mail.invoice-mail-modal');
    }
}
