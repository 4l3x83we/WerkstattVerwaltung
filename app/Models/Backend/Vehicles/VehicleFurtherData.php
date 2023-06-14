<?php

namespace App\Models\Backend\Vehicles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class VehicleFurtherData extends Model
{
    use SoftDeletes;

    protected $fillable = ['vehicles_id', 'vehicles_color', 'vehicles_color_code', 'vehicles_upholstery_type', 'vehicles_upholstery_color', 'vehicles_radio_code', 'vehicles_key_number', 'vehicles_seats', 'vehicles_doors', 'vehicles_sleeping_places', 'vehicles_axles', 'vehicles_number_of_gears', 'vehicles_cylinder', 'vehicles_curb_weight', 'vehicles_payload', 'vehicles_total_weight', 'vehicles_length', 'vehicles_broad', 'vehicles_height'];

    public function vehicles(): BelongsTo
    {
        return $this->belongsTo(Vehicles::class);
    }
}
