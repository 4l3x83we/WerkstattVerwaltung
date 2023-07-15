<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Revenue.php
 * User: ${USER}
 * Date: 15.${MONTH_NAME_FULL}.2023
 * Time: 19:30
 */

namespace App\Http\Livewire\Backend\Reports;

use App\Models\Backend\Office\Invoice\Payment;
use Livewire\Component;

class RevenueReport extends Component
{
    public $sortField = 'payment_nr';

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

    public function render()
    {
        $payments = Payment::orderBy($this->sortField, $this->sortDirection)
            ->get();

        $summe = [];
        foreach ($payments as $payment) {
            $summe = $payment->summe();
        }

        return view('livewire.backend.reports.revenue-report', [
            'payments' => $payments,
            'summe' => $summe,
        ]);
    }
}
