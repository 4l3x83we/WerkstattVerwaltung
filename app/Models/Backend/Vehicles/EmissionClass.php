<?php

namespace App\Models\Backend\Vehicles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmissionClass extends Model
{
    use SoftDeletes;

    protected $fillable = ['emission_class', 'kat_id'];
}
