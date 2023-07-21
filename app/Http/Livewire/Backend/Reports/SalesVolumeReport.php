<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: SalesVolumeReport.php
 * User: ${USER}
 * Date: 15.${MONTH_NAME_FULL}.2023
 * Time: 20:34
 */

namespace App\Http\Livewire\Backend\Reports;

use App\Models\Backend\Reports\Umsatz;
use Carbon\Carbon;
use Livewire\Component;

class SalesVolumeReport extends Component
{
    public $groupBy;

    public $umsatzes;

    public $thisEinnahmen;

    public $thisUmsatz;

    public $thisDate;

    public $datasets = [];

    public $labels = [];

    public function mount()
    {
        $this->groupBy = 'all';
        $this->updateUmsatz();
    }

    public function updateUmsatz()
    {
        $this->umsatzes = $this->updatedGroupBy();
        $this->thisEinnahmen = $this->umsatzes->pluck('einnahmenBrutto', 'date')->values()->toArray();
        $this->thisUmsatz = $this->umsatzes->pluck('umsatzBrutto', 'date')->values()->toArray();
        $date = $this->umsatzes->pluck('date');
        $this->thisDate = $this->umsatzes->map(function ($date) {
            return $date->date->format('d.m.Y');
        })->toArray();
        $this->datasets = [
            [
                'label' => 'Umsatz',
                'backgroundColor' => 'mediumpurple',
                'data' => $this->thisUmsatz,
            ],
            [
                'label' => 'Einnahmen',
                'backgroundColor' => 'mediumseagreen',
                'data' => $this->thisEinnahmen,
            ],
        ];
        $this->labels = $this->thisDate;
        $this->emit('updateTheChart', [
            'datasets' => $this->datasets,
            'labels' => $this->labels,
        ]);
    }

    public function updatedGroupBy()
    {
        $umsatz = Umsatz::query();
        $umsatzFilter = $this->groupBy;
        if ($umsatzFilter === 'today') {
            $umsatz->whereDay('date', Carbon::today());
        } elseif ($umsatzFilter === 'yesterday') {
            $umsatz->whereDay('date', Carbon::yesterday());
        } elseif ($umsatzFilter === 'this_week') {
            $umsatz->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($umsatzFilter === 'last_week') {
            $umsatz->whereBetween('date', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]);
        } elseif ($umsatzFilter === 'this_month') {
            $umsatz->whereMonth('date', Carbon::now()->month);
        } elseif ($umsatzFilter === 'last_month') {
            $umsatz->whereMonth('date', Carbon::now()->subMonth()->month);
        }
        $umsatz->selectRaw('DATE_FORMAT(date, "%d.%m.%Y") as date');
        $umsatz->selectRaw('sum(umsatz_brutto) as umsatzBrutto');
        $umsatz->selectRaw('sum(umsatz_netto) as umsatzNetto');
        $umsatz->selectRaw('sum(einnahmen_brutto) as einnahmenBrutto');
        $umsatz->selectRaw('sum(einnahmen_netto) as einnahmenNetto');
        $umsatz->groupBy('date');

        return $umsatz->get();
    }

    public function render()
    {
        return view('livewire.backend.reports.sales-volume-report');
    }
}
