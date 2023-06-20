<?php

namespace App\Models\Backend\Vehicles;

use Illuminate\Database\Eloquent\Model;

class Vehicles_Hersteller_Model extends Model
{
    protected $fillable = [
        'brand_id',
        'vhm_hersteller_name',
        'model_id',
        'vhm_model_name',
        'vhm_typ',
        'vhm_prod_month_von',
        'vhm_prod_month_bis',
        'vhm_prod_year_von',
        'vhm_prod_year_bis',
        'vhm_ps',
        'vhm_kw',
        'vhm_hubraum',
        'vhm_fuel',
        'vhm_hsn',
        'vhm_tsn',
        'vehicles_id',
    ];
}
