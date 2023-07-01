<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: InvoiceShow.php
 * User: ${USER}
 * Date: 23.${MONTH_NAME_FULL}.2023
 * Time: 06:16
 */

namespace App\Http\Livewire\Backend\Office\Invoice;

use Livewire\Component;

class InvoiceShow extends Component
{
    public function render()
    {
        return view('livewire.backend.office.invoice.invoice-show');
    }
}
