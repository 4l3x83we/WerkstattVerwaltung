<?php

namespace App\Models\Backend\Vehicles;

use App\Models\Backend\Customers\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicles extends Model
{
    use SoftDeletes;

    protected $fillable = ['vehicles_internal_vehicle_number', 'vehicles_license_plate', 'vehicles_hsn', 'vehicles_tsn', 'vehicles_brand', 'vehicles_model', 'vehicles_type', 'vehicles_class', 'vehicles_category', 'vehicles_identification_number', 'vehicles_first_registration', 'vehicles_cubic_capacity', 'vehicles_hp', 'vehicles_kw', 'vehicles_mileage', 'vehicles_hu', 'vehicles_tire_1', 'vehicles_tire_2', 'vehicles_tpms', 'vehicles_engine_code', 'vehicles_fuel', 'vehicles_cat', 'vehicles_plaque', 'vehicles_emission_class', 'vehicles_transmission', 'vehicles_note'];

    protected $casts = ['vehicles_first_registration' => 'date:Y-m-d', 'vehicles_hu' => 'date:Y-m-d'];

    public function customers(): BelongsToMany
    {
        return $this->belongsToMany(Customer::class, 'vehicle_customer');
    }

    public function vehicleFurtherData(): HasOne
    {
        return $this->hasOne(VehicleFurtherData::class);
    }

    public function vehiclesPlaque($id)
    {
        foreach (json()['plaque'] as $item) {
            $id = $item->id;
        }

        return $id;
    }

    public function vehiclesEmissionClass()
    {
        return EmissionClass::where('id', $this->vehicles_emission_class)->emission_class;
    }
}
