<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Copy.php
 * User: ${USER}
 * Date: 04.${MONTH_NAME_FULL}.2023
 * Time: 11:12
 */

namespace App\Http\Livewire\Backend\Office\Invoice\Copy;

use App\Models\Backend\Office\Invoice\Invoice;
use Carbon\Carbon;
use Livewire\Component;

class Copy extends Component
{
    public $order;

    public function copy($id)
    {
        $order = Invoice::with('invoiceDetail')->find($id);
        $newOrder = $order->replicate();
        $newOrder->order_nr = $this->lastInvoiceID();
        $newOrder->order_date = Carbon::now()->format('Y-m-d');
        $newOrder->created_at = Carbon::now();
        $newOrder->updated_at = Carbon::now();
        $newOrder->save();
        foreach ($newOrder->invoiceDetail as $invoiceDetail) {
            $detail = $invoiceDetail->replicate();
            $detail->invoice_id = $newOrder->id;
            $detail->created_at = Carbon::now();
            $detail->updated_at = Carbon::now();
            $detail->save();
            $newOrder->history($newOrder, $invoiceDetail);
        }
        $invoice = [
            'protocol_text' => 'Neue Kopie von '.$newOrder->invoice_type.' '.$newOrder->order_nr.' erstellt (Summe exkl. Steuer: '.number_format($order->invoice_subtotal, 2, ',', '.').'€)',
            'protocol_status' => 'created',
        ];
        $newOrder->protocol($invoice);

        session()->flash('success', 'Der Auftrag wurde Kopiert.');

        return redirect(route('backend.auftraege.show', $newOrder->id));
    }

    public function lastInvoiceID()
    {
        $lastID = Invoice::withTrashed()->latest()->first()->order_nr ?? 199999;
        if (date('Y-01-01') === date('Y-m-d')) {
            $nextOrderNumber = date('Y').'-200000';
        } else {
            $nextOrderNumber = $lastID + 1;
        }

        return $nextOrderNumber;
    }

    public function render()
    {
        return view('livewire.backend.office.invoice.copy.copy');
    }
}
