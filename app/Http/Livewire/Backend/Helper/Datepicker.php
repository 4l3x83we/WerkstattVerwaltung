<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Datepicker.php
 * User: ${USER}
 * Date: 18.${MONTH_NAME_FULL}.2023
 * Time: 18:13
 */

namespace App\Http\Livewire\Backend\Helper;

use Livewire\Component;

class Datepicker extends Component
{
    public $start;

    public $end;

    protected $rules = [
        'start' => 'nullable',
        'end' => 'nullable',
    ];

    public function mount()
    {

    }

    public function updatedStart($start)
    {
        $this->start = $start;
    }

    public function updatedEnd($end)
    {
        $this->end = $end;
    }

    public function render()
    {
        return view('livewire.backend.helper.datepicker', [
            'start' => $this->start,
            'end' => $this->end,
        ]);
    }
}
