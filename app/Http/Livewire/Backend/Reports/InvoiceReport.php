<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: InvoiceReport.php
 * User: ${USER}
 * Date: 15.${MONTH_NAME_FULL}.2023
 * Time: 12:35
 */

namespace App\Http\Livewire\Backend\Reports;

use App\Models\Backend\Office\Invoice\Invoice;
use Livewire\Component;

class InvoiceReport extends Component
{
    public $sortField = 'invoice_date';

    public $sortDirection = 'desc';

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

    public function show($id)
    {
        Invoice::where('id', '=', $id)->first()->invoices();
    }

    public function render()
    {
        $invoices = Invoice::where('invoice_type', '=', 'Rechnung')
            ->with(['customer', 'payment'])
            ->orderBy($this->sortField, $this->sortDirection)
            ->get();

        return view('livewire.backend.reports.invoice-report', [
            'invoices' => $invoices,
        ]);
    }
}
