<?php

namespace App\Models\Backend\Vehicles;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    protected $fillable = [
        'brands_brand_id',
        'brands_brand_name',
    ];
}
