<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: CustomerIndex.php
 * User: ${USER}
 * Date: 13.${MONTH_NAME_FULL}.2023
 * Time: 07:21
 */

namespace App\Http\Livewire\Backend\Customers;

use App\Models\Backend\Customers\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerIndex extends Component
{
    use WithPagination;

    public $search = '';

    public $importMode = false;

    public $sortField = 'customer_kdnr';

    public $sortDirection = 'asc';

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

    public function edit($id)
    {
        return redirect(route('backend.kunden.edit', $id));
    }

    public function show($id)
    {
        return redirect(route('backend.kunden.show', $id));
    }

    public function destroy($id)
    {
        $customer = Customer::where('id', $id)->first();
        $customer->shippings()->delete();
        $customer->dataProtection()->delete();
        $customer->financialAccountingConditions()->delete();
        $customer->delete();

        session()->flash('successError', 'Kunde wurde gelöscht.');

        return redirect()->back();
    }

    public function import()
    {
        $this->importMode = true;
    }

    public function render()
    {
        $customer = Customer::whereLike(['customer_kdnr', 'customer_firstname', 'customer_lastname'], $this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(25);

        return view('livewire.backend.customers.customer-index', ['customers' => $customer]);
    }
}
