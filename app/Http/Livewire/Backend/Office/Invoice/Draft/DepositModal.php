<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: DepositModal.php
 * User: ${USER}
 * Date: 15.${MONTH_NAME_FULL}.2023
 * Time: 07:54
 */

namespace App\Http\Livewire\Backend\Office\Invoice\Draft;

use App\Http\Livewire\Modal;
use App\Models\Admin\Settings\CompanySettings;
use App\Models\Backend\Office\Invoice\InvoiceDetails;
use App\Models\Backend\Office\NumberRanges;
use Carbon\Carbon;

class DepositModal extends Modal
{
    public $deposit = [
        'tax' => 19,
    ];

    public $invoice;

    public $mwstWert;

    protected $rules = [
        'deposit.date' => 'required',
        'deposit.amount' => 'required',
        'deposit.tax' => 'required',
    ];

    public function mount()
    {
        $this->mwstWert = $this->mwstWerte();
        $this->deposit['date'] = Carbon::now()->format('Y-m-d');
    }

    public function mwstWerte()
    {
        $tax = CompanySettings::select(['tax_rate_full', 'tax_rate_reduced', 'tax_rate_free', 'tax_rate_core'])->latest()->first();

        return [
            [
                'wert' => $tax->tax_rate_full,
                'name' => '19% volle MwSt',
            ],
            [
                'wert' => $tax->tax_rate_reduced,
                'name' => '7% verm. MwSt',
            ],
            [
                'wert' => $tax->tax_rate_free,
                'name' => 'MwSt frei',
            ],
            [
                'wert' => $tax->tax_rate_core,
                'name' => '20.9% AT.-MwSt',
            ],
        ];
    }

    public function store()
    {
        $this->invoice->update([
            'invoice_nr' => date('Y').'-'.$this->lastInvoiceID(),
            'invoice_type' => 'Rechnung',
            'invoice_status' => 'open',
            'invoice_payment_status' => 'pending',
            'invoice_subtotal' => $this->invoice['invoice_subtotal'] - $this->tax()['amount'],
            'invoice_vat_19' => $this->invoice['invoice_vat_19'] - $this->tax()['total19'],
            'invoice_vat_7' => $this->invoice['invoice_vat_7'] - $this->tax()['total7'],
            'invoice_vat_at' => $this->invoice['invoice_vat_at'] - $this->tax()['totalAT'],
            'invoice_total' => $this->invoice['invoice_total'] - $this->deposit['amount'],
        ]);
        NumberRanges::updateOrCreate(['id' => 1], [
            'invoice_nr' => $this->lastInvoiceID(),
        ]);
        InvoiceDetails::create([
            'invoice_id' => $this->invoice['id'],
            'product_name' => 'Anzahlung (Rechnung/Entwurf '.date('Y').'-'.$this->lastInvoiceID().')',
            'qty' => 1,
            'price' => -$this->tax()['amount'],
            'tax' => $this->deposit['tax'],
            'subtotal' => -$this->tax()['amount'] * 1,
        ]);

        $amount = number_format($this->deposit['amount'], 2);
        $newDeposit = $this->invoice->replicate();
        $newDeposit->invoice_nr = date('Y').'-'.$this->lastInvoiceID();
        $newDeposit->invoice_date = Carbon::now()->format('Y-m-d');
        $newDeposit->invoice_due_date = Carbon::now()->addDays(14)->format('Y-m-d');
        $newDeposit->delivery_performance_date = Carbon::now()->format('Y-m-d');
        $newDeposit->invoice_subtotal = $this->tax()['amount'];
        $newDeposit->invoice_vat_19 = $this->tax()['total19'];
        $newDeposit->invoice_vat_7 = $this->tax()['total7'];
        $newDeposit->invoice_vat_at = $this->tax()['totalAT'];
        $newDeposit->invoice_total = $amount;
        $newDeposit->invoice_type = 'Rechnung';
        $newDeposit->invoice_status = 'open';
        $newDeposit->invoice_payment_status = 'pending';
        $newDeposit->save();
        InvoiceDetails::create([
            'invoice_id' => $newDeposit->id,
            'product_name' => 'Anzahlung zu Rechnung/Entwurf '.$newDeposit->invoice_nr,
            'qty' => 1,
            'price' => $this->tax()['amount'],
            'tax' => $this->deposit['tax'],
            'subtotal' => $this->tax()['amount'] * 1,
        ]);
        NumberRanges::updateOrCreate(['id' => 1], [
            'invoice_nr' => $this->lastInvoiceID(),
        ]);
        $invoice = [
            'protocol_text' => 'Anzahlung '.number_format($this->deposit['amount'], 2, ',', '.').' € am '.Carbon::now()->format('d.m.Y').' <a href="'.route('backend.invoice.offen.show', $newDeposit->id).'"> ( Rechnung: '.$newDeposit->invoice_nr.' )</a>',
            'protocol_status' => 'payment',
        ];
        $this->invoice->protocol($invoice);
        $newDeposit->protocol([
            'protocol_text' => 'Rechnung erstellt (Summe exkl. Steuer: '.number_format($newDeposit->invoice_subtotal, 2, ',', '.').' €)',
            'protocol_status' => 'created',
        ]);
        $newDeposit->protocol([
            'protocol_text' => 'Rechnung abgeschlossen (Summe exkl. Steuer: '.number_format($newDeposit->invoice_subtotal, 2, ',', '.').' €)',
            'protocol_status' => 'complete',
        ]);
        session()->flash('success', 'Anzahlungsrechnung erstellt.');

        return redirect(route('backend.invoice.offen.show', $newDeposit->id));
    }

    public function lastInvoiceID()
    {
        $lastID = NumberRanges::latest()->first()->invoice_nr ?? 299999;

        return date('Y-01-01') === date('Y-m-d') ? 300000 : $lastID + 1;
    }

    public function tax()
    {
        $total19 = 0;
        $total7 = 0;
        $totalAT = 0;
        $total = 0;
        $amount = 0;
        if ($this->deposit['amount']) {
            $amount += $this->deposit['amount'] / mwst($this->deposit['tax']);
        }
        if ($this->deposit['tax'] == 19) {
            $total19 += $this->deposit['amount'] - ($this->deposit['amount'] / mwst($this->deposit['tax']));
        }
        if ($this->deposit['tax'] == 7) {
            $total7 += $this->deposit['amount'] - ($this->deposit['amount'] / mwst($this->deposit['tax']));
        }
        if ($this->deposit['tax'] == 20.9) {
            $totalAT += $this->deposit['amount'] - ($this->deposit['amount'] / mwst($this->deposit['tax']));
        }

        $total += $total19 + $total7 + $totalAT;

        return [
            'total19' => number_format($total19, 2),
            'total7' => number_format($total7, 2),
            'totalAT' => number_format($totalAT, 2),
            'total' => number_format($total, 2),
            'amount' => number_format($amount, 2),
        ];
    }

    public function render()
    {
        return view('livewire.backend.office.invoice.draft.deposit-modal');
    }
}
