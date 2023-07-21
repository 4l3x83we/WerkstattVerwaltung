<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Complete.php
 * User: ${USER}
 * Date: 04.${MONTH_NAME_FULL}.2023
 * Time: 11:07
 */

namespace App\Http\Livewire\Backend\Office\Invoice\Complete;

use App\Models\Backend\Office\NumberRanges;
use App\Models\Backend\Office\Protocol;
use App\Models\Backend\Reports\Umsatz;
use Carbon\Carbon;
use Livewire\Component;

class Complete extends Component
{
    public $order;

    public function complete($id)
    {
        $this->order->update([
            'invoice_nr' => date('Y').'-'.$this->lastInvoiceID(),
            'invoice_date' => Carbon::now()->format('Y-m-d'),
            'invoice_due_date' => Carbon::now()->addDays(14)->format('Y-m-d'),
            'invoice_type' => 'Rechnung',
            'invoice_status' => 'open',
            'invoice_payment_status' => 'pending',
            'updated_at' => now(),
        ]);
        $this->order->nr = $this->order->id;
        $this->order->date = Carbon::now()->format('Y-m-d');
        foreach ($this->order->invoiceDetail as $item) {
            $this->order->history($this->order, $item);
        }
        Umsatz::create([
            'invoice_id' => $this->order->id,
            'customer_id' => $this->order->customer_id,
            'date' => Carbon::now()->format('Y-m-d'),
            'umsatz_netto' => $this->order->invoice_subtotal,
            'umsatz_brutto' => $this->order->invoice_total,
        ]);
        NumberRanges::updateOrCreate(['id' => 1], [
            'invoice_nr' => $this->lastInvoiceID(),
        ]);
        $this->protocol($this->order);

        session()->flash('success', 'Die Rechnung wurde erstellt.');

        return redirect(route('backend.invoice.offen.show', $this->order->id));
    }

    public function lastInvoiceID()
    {
        $lastID = NumberRanges::latest()->first()->invoice_nr ?? 299999;

        if (date('Y-01-01') === date('Y-m-d')) {
            $nextOrderNumber = 300000;
        } else {
            $nextOrderNumber = $lastID + 1;
        }

        return $nextOrderNumber;
    }

    public function protocol($order)
    {
        Protocol::create([
            'protocol_type_nr' => $order->id,
            'protocol_type' => $order->invoice_type,
            'protocol_text' => 'Rechnung erstellt (Summe exkl. Steuer: '.number_format($order->invoice_subtotal, 2, ',', '.').' €)',
            'protocol_status' => 'created',
        ]);
    }

    public function render()
    {
        return view('livewire.backend.office.invoice.complete.complete');
    }
}
