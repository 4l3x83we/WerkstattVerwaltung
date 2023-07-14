<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: InvoiceDraftMailModal.php
 * User: ${USER}
 * Date: 13.${MONTH_NAME_FULL}.2023
 * Time: 17:27
 */

namespace App\Http\Livewire\Backend\Office\Invoice\Mail;

use App\Http\Livewire\Modal;
use App\Mail\Backend\Invoice\DraftMail;
use App\Models\Admin\Settings\BankSettings;
use App\Models\Admin\Settings\CompanySettings;
use App\Models\Backend\Customers\Customer;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use File;
use Mail;

class InvoiceDraftMailModal extends Modal
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
        $this->mail['subject'] = 'Ihre Entwurfsrechnung der '.$this->settings->company_name.' mit der Nr.: '.$this->invoice->id;
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

Im Anhang finden sie unsere Entwurfsrechnung mit der Entwurfsrechnungsnummer: '.$this->invoice->id.'.

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
        $invoice = $this->invoice;
        $settings = $this->settings;
        $mail = $this->mail;
        $pdf = $this->pdf($invoice);
        Mail::to($this->invoice->company->comapany_email ?? 'noreplay@thueringer-tuning-freunde.de')
            ->cc($this->mail['cc_email'] ?? null)
            ->bcc($this->mail['bcc_email'] ?? null)
            ->send(new DraftMail($invoice, $mail, $settings, $pdf));

        return redirect(request()->header('Referer'));
    }

    public function pdf($rechnung)
    {
        $bank = BankSettings::where('id', $this->settings->id)->first();
        $pdf = PDF::loadView('backend.buero.pdf.invoice', [
            'settings' => $this->settings,
            'rechnung' => $rechnung,
            'rechnungDetails' => $rechnung->invoiceDetail,
            'bank' => $bank,
            'type' => 'Entwurf',
            'toPay' => $rechnung->invoice_payment !== 'Bar',
            'skonto' => invoiceTotalDiscount($rechnung),
        ])->setOption('isPhpEnabled', true)
            ->setPaper('a4', 'portrait');

        $path = 'dokumente/'.replaceStrToLower($rechnung->customer->fullname().'/rechnungen');
        if (! File::isDirectory(public_path($path))) {
            File::makeDirectory(public_path($path), 0775, true, true);
        }

        $pdf->save(public_path($path).'/Entwurfsrechnung-'.$rechnung->invoice_nr.'.pdf');
    }

    public function render()
    {
        return view('livewire.backend.office.invoice.mail.invoice-draft-mail-modal');
    }
}
