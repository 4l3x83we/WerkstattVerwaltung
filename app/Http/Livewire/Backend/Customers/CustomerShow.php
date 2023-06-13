<?php

namespace App\Http\Livewire\Backend\Customers;

use Livewire\Component;

class CustomerShow extends Component
{
    public $customers;

    public function render()
    {
        return view('livewire.backend.customers.customer-show');
    }
}
