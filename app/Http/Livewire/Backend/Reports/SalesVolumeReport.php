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

use App\Charts\UmsatzChart;
use Livewire\Component;

class SalesVolumeReport extends Component
{
    public $types = ['Einnahmen', 'Umsatz'];

    public $colors = [
        'Einnahmen' => '#9061F9',
        'Umsatz' => '#0E9F6E',
    ];

    public $chartDatasets = [[]];

    public $chartLabels = [];

    public $chartId = null;

    public $sortField = 'invoice_date';

    public $sortDirection = 'desc';

    protected $listeners = [
        'onPointClick' => 'handleOnPointClick',
    ];

    public function handleOnPointClick($point)
    {
        dd($point);
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
        $this->addDataToChart();

        if (! $this->chartId) {
            $chart = new UmsatzChart($this->chartDatasets, $this->chartLabels);

            $this->chartId = $chart->id;
        } else {
            $this->emit('chartUpdate', $this->chartId, $this->chartLabels, $this->chartDatasets);
        }

        return view('livewire.backend.reports.sales-volume-report', [
            'chart' => $chart ?? null,
        ]);
    }
}
