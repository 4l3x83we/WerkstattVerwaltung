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

use Livewire\Component;

class SalesVolumeReport extends Component
{
    public $types = ['Einnahmen', 'Umsatz'];

    public function render()
    {
        return view('livewire.backend.reports.sales-volume-report');
    }
}
