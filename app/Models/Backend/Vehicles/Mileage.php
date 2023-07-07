<?php

namespace App\Models\Backend\Vehicles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mileage extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'vehicle_id',
        'mileage',
        'date',
    ];

    protected $casts = [
        'date' => 'date:Y-m-d',
    ];

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicles::class);
    }
}
