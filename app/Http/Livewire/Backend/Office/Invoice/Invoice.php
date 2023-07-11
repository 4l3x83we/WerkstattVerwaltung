<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Invoice.php
 * User: ${USER}
 * Date: 22.${MONTH_NAME_FULL}.2023
 * Time: 16:27
 */

namespace App\Http\Livewire\Backend\Office\Invoice;

use App\Models\Backend\Office\Invoice\Invoice as InvoiceModel;
use Livewire\Component;
use Livewire\WithPagination;

class Invoice extends Component
{
    use WithPagination;

    public $importMode = false;

    public $search = '';

    public $sortField = 'id';

    public $sortDirection = 'desc';

    public $invoiceNummer = true;

    public function sortBy($field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function swapSortDirection(): string
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function import()
    {
        $this->importMode = true;
    }

    public function show($id)
    {
        return redirect(route('backend.invoice.offen.show', $id));
    }

    public function render()
    {
        $outstanding_payments = number_format(0, 2, ',', '.').' €';

        $invoices = InvoiceModel::where('invoice_type', '=', 'Rechnung')
            ->where('invoice_status', 'open')
            ->whereLike(['invoice_nr', 'order_nr', 'customer.customer_firstname', 'customer.customer_lastname', 'vehicle.vehicles_license_plate', 'vehicle.vehicles_brand'], $this->search)
            ->orderBy($this->sortField, $this->sortDirection)
//            ->with(['customer', 'vehicle'])
            ->paginate(50);

        foreach ($invoices as $invoice) {
            $outstanding_payments = number_format($invoice->where('invoice_payment_status', 'not_paid')
                ->where('invoice_type', 'Rechnung')
                ->sum('invoice_total'), 2, ',', '.').' €';
        }

        $this->invoiceNummer = 'Rechnungsnummer';

        return view('livewire.backend.office.invoice.invoice', [
            'invoices' => $invoices,
            'outstanding_payments' => $outstanding_payments,
        ]);
    }
}
