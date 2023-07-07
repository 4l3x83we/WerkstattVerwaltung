<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Edit.php
 * User: ${USER}
 * Date: 05.${MONTH_NAME_FULL}.2023
 * Time: 21:23
 */

namespace App\Http\Livewire\Backend\Office\Invoice\Button;

use Livewire\Component;

class Edit extends Component
{
    public $order;

    public function edit()
    {

        return redirect(route('backend.invoice.offen.edit', $this->order));
    }

    public function render()
    {
        return view('livewire.backend.office.invoice.button.edit');
    }
}
