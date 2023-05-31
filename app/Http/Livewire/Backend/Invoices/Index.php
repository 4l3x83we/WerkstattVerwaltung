<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Index.php
 * User: ${USER}
 * Date: 31.${MONTH_NAME_FULL}.2023
 * Time: 07:33
 */

namespace App\Http\Livewire\Backend\Invoices;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.backend.invoices.index');
    }
}
