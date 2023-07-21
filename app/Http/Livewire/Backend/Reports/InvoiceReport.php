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
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class InvoiceReport extends Component
{
    use WithPagination;

    public $sortField = 'invoice_date';

    public $sortDirection = 'desc';

    public $selectedRange = 'Dieser Monat';

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

    public function updateInvoice()
    {
        $this->resetPage();
    }

    public function render()
    {
        $invoices = $this->updatedSelectedRange();

        return view('livewire.backend.reports.invoice-report', [
            'invoices' => $invoices,
        ]);
    }

    public function updatedSelectedRange()
    {
        $invoice = Invoice::query();
        $invoice->where('invoice_type', '=', 'Rechnung');
        $selectRange = $this->selectedRange;
        if ($selectRange === 'Heute') {
            $invoice->whereDay('invoice_date', Carbon::today());
        } elseif ($selectRange === 'Gestern') {
            $invoice->whereDay('invoice_date', Carbon::yesterday());
        } elseif ($selectRange === 'Diese Woche') {
            $invoice->whereBetween('invoice_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($selectRange === 'Letzte Woche') {
            $invoice->whereBetween('invoice_date', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]);
        } elseif ($selectRange === 'Dieser Monat') {
            $invoice->whereBetween('invoice_date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
        } elseif ($selectRange === 'Letzter Monat') {
            $invoice->whereBetween('invoice_date', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()]);
        } elseif ($selectRange === 'Dieses Quartal') {
            $invoice->whereBetween('invoice_date', [Carbon::now()->startOfQuarter(), Carbon::now()->endOfQuarter()]);
        } elseif ($selectRange === 'Letztes Quartal') {
            $invoice->whereBetween('invoice_date', [Carbon::now()->subQuarter()->startOfQuarter(), Carbon::now()->subQuarter()->endOfQuarter()]);
        } elseif ($selectRange === 'Dieses Jahr') {
            $invoice->whereYear('invoice_date', Carbon::now()->year);
        } elseif ($selectRange === 'Letztes Jahr') {
            $invoice->whereYear('invoice_date', Carbon::now()->subYear()->year);
        }
        $invoice->with(['customer', 'payment']);
        $invoice->orderBy($this->sortField, $this->sortDirection);

        return $invoice->paginate(50);
    }
}
