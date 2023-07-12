<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Draft.php
 * User: ${USER}
 * Date: 04.${MONTH_NAME_FULL}.2023
 * Time: 10:01
 */

namespace App\Http\Livewire\Backend\Office\Invoice\Draft;

use App\Models\Backend\Office\NumberRanges;
use App\Models\Backend\Office\Protocol;
use Livewire\Component;

class Draft extends Component
{
    public $order;

    public function draft($id)
    {
        $this->order->update([
            'invoice_nr' => $this->lastDraftID(),
            'invoice_type' => 'Entwurf',
            'invoice_status' => 'entwurf',
            'invoice_payment_status' => 'entwurf',
            'updated_at' => now(),
        ]);
        $this->order->nr = $this->order->id;
        $this->order->history_status = $this->order->invoice_payment_status;
        foreach ($this->order->invoiceDetail as $item) {
            $this->order->history($this->order, $item);
        }
        NumberRanges::updateOrCreate(['id' => 1], [
            'draft_nr' => $this->lastDraftID(),
        ]);
        $this->protocol($this->order);

        session()->flash('success', 'Der Rechnungsentwurf wurde erstellt.');

        return redirect(route('backend.invoice.entwurf.edit', $this->order->id));
    }

    public function lastDraftID()
    {
        $lastID = NumberRanges::latest()->first()->draft_nr ?? 0;

        if (date('Y-01-01') === date('Y-m-d')) {
            $nextOrderNumber = 1;
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
            'protocol_text' => 'Rechnungsentwurf erstellt (Summe exkl. Steuer: '.number_format($order->invoice_subtotal, 2, ',', '.').' €)',
            'protocol_status' => 'created',
        ]);
    }

    public function render()
    {
        return view('livewire.backend.office.invoice.draft.draft');
    }
}
