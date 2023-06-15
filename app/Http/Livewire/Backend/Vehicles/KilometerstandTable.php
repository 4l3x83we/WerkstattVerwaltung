<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: KilometerstandTable.php
 * User: ${USER}
 * Date: 14.${MONTH_NAME_FULL}.2023
 * Time: 08:28
 */

namespace App\Http\Livewire\Backend\Vehicles;

use App\Http\Livewire\Modal;

class KilometerstandTable extends Modal
{
    public $fahrzeuge;

    public function mount()
    {

    }

    public function render()
    {
        $fahrzeuge = $this->fahrzeuge;

        return view('livewire.backend.vehicles.kilometerstand-table', ['fahrzeuge' => $fahrzeuge]);
    }
}
