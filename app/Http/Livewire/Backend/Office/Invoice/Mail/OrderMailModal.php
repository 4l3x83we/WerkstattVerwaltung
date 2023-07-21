<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: OrderMailModal.php
 * User: ${USER}
 * Date: 13.${MONTH_NAME_FULL}.2023
 * Time: 08:33
 */

namespace App\Http\Livewire\Backend\Office\Invoice\Mail;

use App\Http\Livewire\Modal;
use App\Mail\Backend\Invoice\OrderMail;
use App\Models\Admin\Settings\CompanySettings;
use App\Models\Backend\Customers\Customer;
use Mail;

class OrderMailModal extends Modal
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
        $this->mail['subject'] = 'Ihre Auftrag der '.$this->settings->company_name.' mit der Auftragsnr.: '.$this->invoice->order_nr;
        $this->mail['text'] = mailOrderText($this->invoice);
    }

    public function mail()
    {
        $mail = $this->mail;
        $mail['invoice_nr'] = $this->invoice->order_nr;
        $mail['fullname'] = $this->invoice->customer->fullname();
        $mail['email'] = $this->customer->customer_email;
        $mail['invoice_id'] = $this->invoice->id;
        $pdf = $this->invoice->savePDF('Auftrag');
        Mail::to($mail['email'])
            ->cc($this->mail['cc_email'] ?? null)
            ->bcc($this->mail['bcc_email'] ?? null)
            ->send(new OrderMail($mail));

        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.backend.office.invoice.mail.order-mail-modal');
    }
}
