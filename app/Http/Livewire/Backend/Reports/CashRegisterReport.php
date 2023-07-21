<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: CashRegisterReport.php
 * User: ${USER}
 * Date: 18.${MONTH_NAME_FULL}.2023
 * Time: 05:50
 */

namespace App\Http\Livewire\Backend\Reports;

use App\Models\Backend\Reports\CashRegister;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class CashRegisterReport extends Component
{
    use WithPagination;

    public $sortField = 'id';

    public $sortDirection = 'desc';

    public $selectedRange;

    public function mount()
    {
        $this->selectedRange = 'Dieser Monat';
    }

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
        $cashRegisters = $this->updatedSelectedRange();

        return view('livewire.backend.reports.cash-register-report', [
            'cashRegisters' => $cashRegisters,
            'ranges' => $this->ranges(),
        ]);
    }

    public function updatedSelectedRange()
    {
        $cashRegister = CashRegister::query();
        $selectRange = $this->selectedRange;
        if ($selectRange === 'Heute') {
            $cashRegister->whereDay('cashRegister_date', Carbon::today());
        } elseif ($selectRange === 'Gestern') {
            $cashRegister->whereDay('cashRegister_date', Carbon::yesterday());
        } elseif ($selectRange === 'Diese Woche') {
            $cashRegister->whereBetween('cashRegister_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($selectRange === 'Letzte Woche') {
            $cashRegister->whereBetween('cashRegister_date', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]);
        } elseif ($selectRange === 'Dieser Monat') {
            $cashRegister->whereBetween('cashRegister_date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
        } elseif ($selectRange === 'Letzter Monat') {
            $cashRegister->whereBetween('cashRegister_date', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()]);
        } elseif ($selectRange === 'Dieses Quartal') {
            $cashRegister->whereBetween('cashRegister_date', [Carbon::now()->startOfQuarter(), Carbon::now()->endOfQuarter()]);
        } elseif ($selectRange === 'Letztes Quartal') {
            $cashRegister->whereBetween('cashRegister_date', [Carbon::now()->subQuarter()->startOfQuarter(), Carbon::now()->subQuarter()->endOfQuarter()]);
        } elseif ($selectRange === 'Dieses Jahr') {
            $cashRegister->whereYear('cashRegister_date', Carbon::now()->year);
        } elseif ($selectRange === 'Letztes Jahr') {
            $cashRegister->whereYear('cashRegister_date', Carbon::now()->subYear()->year);
        }
        $cashRegister->orderBy($this->sortField, $this->sortDirection);

        return $cashRegister->paginate(50);
    }

    public function ranges()
    {
        return [
            [
                'wert' => 'Heute',
                'name' => 'Heute '.Carbon::today()->format('d.m.Y'),
            ],
            [
                'wert' => 'Gestern',
                'name' => 'Gestern '.Carbon::yesterday()->format('d.m.Y'),
            ],
            [
                'wert' => 'Diese Woche',
                'name' => 'Diese Woche '.Carbon::now()->startOfWeek()->format('d.m.Y').' - '.Carbon::now()->endOfWeek()->format('d.m.Y'),
            ],
            [
                'wert' => 'Letzte Woche',
                'name' => 'Letzte Woche '.Carbon::now()->subWeek()->startOfWeek()->format('d.m.Y').' - '.Carbon::now()->subWeek()->endOfWeek()->format('d.m.Y'),
            ],
            [
                'wert' => 'Dieser Monat',
                'name' => 'Dieser Monat '.Carbon::now()->startOfMonth()->format('d.m.Y').' - '.Carbon::now()->endOfMonth()->format('d.m.Y'),
            ],
            [
                'wert' => 'Letzter Monat',
                'name' => 'Letzter Monat '.Carbon::now()->subMonth()->startOfMonth()->format('d.m.Y').' - '.Carbon::now()->subMonth()->endOfMonth()->format('d.m.Y'),
            ],
            [
                'wert' => 'Dieses Quartal',
                'name' => 'Dieses Quartal '.Carbon::now()->startOfQuarter()->format('d.m.Y').' - '.Carbon::now()->endOfQuarter()->format('d.m.Y'),
            ],
            [
                'wert' => 'Letztes Quartal',
                'name' => 'Letztes Quartal '.Carbon::now()->subQuarter()->startOfQuarter()->format('d.m.Y').' - '.Carbon::now()->subQuarter()->endOfQuarter()->format('d.m.Y'),
            ],
            [
                'wert' => 'Dieses Jahr',
                'name' => 'Diese Jahr '.Carbon::now()->startOfYear()->format('d.m.Y').' - '.Carbon::now()->endOfYear()->format('d.m.Y'),
            ],
            [
                'wert' => 'Letztes Jahr',
                'name' => 'Letztes Jahr '.Carbon::now()->subYear()->startOfYear()->format('d.m.Y').' - '.Carbon::now()->subYear()->endOfYear()->format('d.m.Y'),
            ],
        ];
    }

    public function updateCashRegister()
    {
        $this->resetPage();
    }
}
