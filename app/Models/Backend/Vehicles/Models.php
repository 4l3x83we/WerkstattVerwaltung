<?php

namespace App\Models\Backend\Vehicles;

use Illuminate\Database\Eloquent\Model;

class Models extends Model
{
    protected $fillable = [
        'brand_id',
        'models_model_id',
        'models_model_name',
    ];
}
