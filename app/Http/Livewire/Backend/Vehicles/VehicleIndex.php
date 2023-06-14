<?php

namespace App\Http\Livewire\Backend\Vehicles;

use App\Models\Backend\Vehicles\Vehicles;
use Livewire\Component;
use Livewire\WithPagination;

class VehicleIndex extends Component
{
    use WithPagination;

    public $search = '';

    public $sortField = 'vehicles_internal_vehicle_number';

    public $sortDirection = 'asc';

    public $importMode = false;

    public function import()
    {
        $this->importMode = true;
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

    public function create()
    {
        return redirect(route('backend.fahrzeuge.create'));
    }

    public function edit($id)
    {
        return redirect(route('backend.fahrzeuge.create', $id));
    }

    public function show($id)
    {
        return redirect(route('backend.fahrzeuge.show', $id));
    }

    public function destroy()
    {

    }

    public function render()
    {
        $fahrzeuge = Vehicles::whereLike(['vehicles_hsn', 'vehicles_tsn', 'vehicles_brand', 'vehicles_model', 'vehicles_license_plate', 'customers.customer_firstname', 'customers.customer_lastname', 'customers.customer_kdnr', 'customers.customer_location', 'customers.customer_post_code'], $this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(25);

        return view('livewire.backend.vehicles.vehicle-index', ['fahrzeuge' => $fahrzeuge]);
    }
}
