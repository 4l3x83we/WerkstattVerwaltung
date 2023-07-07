<?php

namespace App\Http\Livewire\Backend\Vehicles;

use App\Models\Backend\Vehicles\Vehicles;
use Livewire\Component;

class VehicleShow extends Component
{
    public $fahrzeuge;

    public $customers;

    public function mount($fahrzeuge)
    {
        $this->fahrzeuge = Vehicles::where('id', $fahrzeuge->id)->with('customers', 'vehicleFurtherData')->first();
        foreach ($this->fahrzeuge->customers as $customer) {
            $this->customers = $customer;
        }
    }

    public function render()
    {
        $dokumente = [];

        return view('livewire.backend.vehicles.vehicle-show', [
            'termine' => 0,
            'dateien' => 0,
            'history' => 0,
            'dokumente' => $dokumente,
        ]);
    }
}
