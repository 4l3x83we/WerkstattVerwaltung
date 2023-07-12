<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Payment.php
 * User: ${USER}
 * Date: 06.${MONTH_NAME_FULL}.2023
 * Time: 06:26
 */

namespace App\Http\Livewire\Backend\Office\Invoice\Payment;

use App\Http\Livewire\Modal;
use App\Models\Backend\Office\NumberRanges;
use Carbon\Carbon;

class Payment extends Modal
{
    public $payments;

    public $payment;

    public $invoice;

    protected $rules = [
        'payment.payment_nr' => 'nullable',
        'payment.invoice_id' => 'nullable',
        'payment.payment_amount' => 'nullable',
        'payment.date_of_payment' => 'nullable',
        'payment.payment_method' => 'nullable',
        'payment.notes' => 'nullable',
        'payment.total_amount' => 'nullable',
        'payment.balance' => 'nullable',
        'payment.payment_in_percent' => 'nullable',
    ];

    public function mount()
    {
        $id = $this->payments->id ?? null;
        $payment = \App\Models\Backend\Office\Invoice\Payment::where('id', $id)->latest()->first();
        $this->payment['date_of_payment'] = Carbon::parse(now())->format('Y-m-d');
        $this->payment['payment_amount'] = $payment ? $this->invoice->invoice_total - $payment->payment_amount : $this->invoice->invoice_total;
        $this->payment['payment_nr'] = $this->lastPaymentID();
        $this->payment['payment_method'] = 'Bar';
    }

    public function lastPaymentID()
    {
        $lastID = NumberRanges::withTrashed()->latest()->first()->cash_book_nr ?? 0;

        return $lastID + 1;
    }

    public function render()
    {
        return view('livewire.backend.office.invoice.payment.payment');
    }

    public function new()
    {
        $validatedData = $this->validate();
        $validatedData['payment']['notes'] = ! empty($this->payment['notes']) ? nl2br(e($this->payment['notes'])) : null;
        $validatedData['payment']['invoice_id'] = $this->invoice->id;

        \App\Models\Backend\Office\Invoice\Payment::create($validatedData['payment']);
        $this->invoice->update([
            'invoice_status' => 'paid',
            'invoice_payment' => $this->payment['payment_method'],
            'invoice_payment_status' => 'paid',
        ]);
        $this->invoice->nr = $this->invoice->id;
        $this->invoice->history_status = $this->invoice->invoice_payment_status;
        foreach ($this->invoice->invoiceDetail as $item) {
            $this->invoice->history($this->invoice, $item);
        }
        $invoice = [
            'protocol_text' => 'Zahlung '.number_format($this->invoice->invoice_total, 2, ',', '.').' € '.$this->payment['payment_method'].' am '.Carbon::parse(now())->format('d.m.Y'),
            'protocol_status' => 'payment',
        ];
        $this->invoice->protocol($invoice);

        session()->flash('success', 'Zahlung erhalten');

        return redirect(route('backend.invoice.bezahlt.show', $this->invoice->id));
    }
}
