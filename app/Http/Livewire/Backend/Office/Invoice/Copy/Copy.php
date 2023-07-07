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
use App\Models\Backend\Office\Invoice\InvoiceDetails;
use Livewire\Component;

class Copy extends Component
{
    public $order;

    public function copy($id)
    {
        $this->order['order_nr'] += 1;
        $this->order['invoice_nr'] = null;
        $invoice = Invoice::create($this->order->getAttributes());
        foreach ($this->order->invoiceDetail as $invoiceDetail) {
            InvoiceDetails::create([
                'invoice_id' => $invoice->id,
                'product_id' => $invoiceDetail->product_id,
                'qty' => $invoiceDetail->qty,
                'price' => $invoiceDetail->price,
                'discountPercent' => $invoiceDetail->discountPercent,
                'discount' => $invoiceDetail->discount,
                'subtotal' => $invoiceDetail->subtotal,
            ]);
        }

        session()->flash('success', 'Der Auftrag wurde Kopiert.');

        return redirect(route('backend.order.show-order', $this->order->order_nr));
    }

    public function lastInvoiceID()
    {
        $lastID = Invoice::withTrashed()->latest()->first()->invoice_nr;
        if (date('Y-01-01') === date('Y-m-d')) {
            $nextInvoiceNumber = date('Y').'000001';
        } else {
            $nextInvoiceNumber = $lastID + 1;
        }

        return $nextInvoiceNumber;
    }

    public function render()
    {
        return view('livewire.backend.office.invoice.copy.copy');
    }
}
