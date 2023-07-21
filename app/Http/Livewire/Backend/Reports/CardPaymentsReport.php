<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: CardPaymentsReport.php
 * User: ${USER}
 * Date: 17.${MONTH_NAME_FULL}.2023
 * Time: 22:15
 */

namespace App\Http\Livewire\Backend\Reports;

use App\Models\Backend\Office\Invoice\Payment;
use Carbon\Carbon;
use Livewire\Component;

class CardPaymentsReport extends Component
{
    public $sortField = 'payment_nr';

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
        $payments = $this->updatedSelectedRange();

        $summe = [];
        foreach ($payments as $payment) {
            $summe = $payment->summeCard();
        }

        return view('livewire.backend.reports.card-payments-report', [
            'payments' => $payments,
            'summe' => $this->updatedSelectedRange()->sum('payment_amount'),
        ]);
    }

    public function updatedSelectedRange()
    {
        $payment = Payment::query();
        $payment->where('payment_method', '=', 'Kartenzahlung');
        $selectRange = $this->selectedRange;
        if ($selectRange === 'Heute') {
            $payment->whereDay('date_of_payment', Carbon::today());
        } elseif ($selectRange === 'Gestern') {
            $payment->whereDay('date_of_payment', Carbon::yesterday());
        } elseif ($selectRange === 'Diese Woche') {
            $payment->whereBetween('date_of_payment', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($selectRange === 'Letzte Woche') {
            $payment->whereBetween('date_of_payment', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]);
        } elseif ($selectRange === 'Dieser Monat') {
            $payment->whereBetween('date_of_payment', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
        } elseif ($selectRange === 'Letzter Monat') {
            $payment->whereBetween('date_of_payment', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()]);
        } elseif ($selectRange === 'Dieses Quartal') {
            $payment->whereBetween('date_of_payment', [Carbon::now()->startOfQuarter(), Carbon::now()->endOfQuarter()]);
        } elseif ($selectRange === 'Letztes Quartal') {
            $payment->whereBetween('date_of_payment', [Carbon::now()->subQuarter()->startOfQuarter(), Carbon::now()->subQuarter()->endOfQuarter()]);
        } elseif ($selectRange === 'Dieses Jahr') {
            $payment->whereYear('date_of_payment', Carbon::now()->year);
        } elseif ($selectRange === 'Letztes Jahr') {
            $payment->whereYear('date_of_payment', Carbon::now()->subYear()->year);
        }
        $payment->with('invoice');
        $payment->orderBy($this->sortField, $this->sortDirection);

        return $payment->paginate(50);
    }
}
