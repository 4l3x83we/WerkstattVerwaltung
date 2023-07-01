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

    public $sortDirection = 'asc';

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

    public function edit($id)
    {
        return redirect(route('backend.rechnung.edit', $id));
    }

    public function print($id)
    {
        $invoice = InvoiceModel::find($id);
        $invoice->update([
            'printed' => 1,
        ]);

        return redirect(route('backend.rechnung.pdf', $id));
    }

    public function render()
    {
        $invoices = InvoiceModel::whereLike(['invoice_nr', 'customer.customer_firstname', 'customer.customer_lastname'], $this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(50);

        return view('livewire.backend.office.invoice.invoice', ['invoices' => $invoices]);
    }
}
