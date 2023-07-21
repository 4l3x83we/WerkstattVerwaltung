<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: CashBockReport.php
 * User: ${USER}
 * Date: 17.${MONTH_NAME_FULL}.2023
 * Time: 17:01
 */

namespace App\Http\Livewire\Backend\Reports;

use App\Models\Backend\Reports\CashBook;
use Carbon\Carbon;
use Livewire\Component;

class CashBockReport extends Component
{
    public $sortField = 'cashBook_date';

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

    public function render()
    {
        $cashBooks = $this->updatedSelectedRange();
        $saldo = $cashBooks->sum('cashBook_revenue_amount') + $cashBooks->sum('cashBook_output_amount');

        return view('livewire.backend.reports.cash-bock-report', [
            'cashBooks' => $cashBooks,
            'saldo' => $saldo,
        ]);
    }

    public function updatedSelectedRange()
    {
        $cashBook = CashBook::query();
        $selectRange = $this->selectedRange;
        if ($selectRange === 'Heute') {
            $cashBook->whereDay('cashBook_date', Carbon::today());
        } elseif ($selectRange === 'Gestern') {
            $cashBook->whereDay('cashBook_date', Carbon::yesterday());
        } elseif ($selectRange === 'Diese Woche') {
            $cashBook->whereBetween('cashBook_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($selectRange === 'Letzte Woche') {
            $cashBook->whereBetween('cashBook_date', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]);
        } elseif ($selectRange === 'Dieser Monat') {
            $cashBook->whereBetween('cashBook_date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
        } elseif ($selectRange === 'Letzter Monat') {
            $cashBook->whereBetween('cashBook_date', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()]);
        } elseif ($selectRange === 'Dieses Quartal') {
            $cashBook->whereBetween('cashBook_date', [Carbon::now()->startOfQuarter(), Carbon::now()->endOfQuarter()]);
        } elseif ($selectRange === 'Letztes Quartal') {
            $cashBook->whereBetween('cashBook_date', [Carbon::now()->subQuarter()->startOfQuarter(), Carbon::now()->subQuarter()->endOfQuarter()]);
        } elseif ($selectRange === 'Dieses Jahr') {
            $cashBook->whereYear('cashBook_date', Carbon::now()->year);
        } elseif ($selectRange === 'Letztes Jahr') {
            $cashBook->whereYear('cashBook_date', Carbon::now()->subYear()->year);
        }
        $cashBook->orderBy($this->sortField, $this->sortDirection);

        return $cashBook->paginate(50);
    }
}
