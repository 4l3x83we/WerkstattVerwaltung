<?php

namespace App\Models\Backend\Office;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Positions extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'positions_art_nr',
        'positions_name',
        'positions_sales',
        'sales_total',
    ];
}
