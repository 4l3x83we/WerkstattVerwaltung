<?php

namespace App\Models\Backend\Invoice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customers extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'phone', 'email', 'address_1', 'address_2', 'city', 'country', 'post_code', 'ship_name', 'ship_phone', 'ship_email', 'ship_address_1', 'ship_address_2', 'ship_city', 'ship_country', 'ship_post_code'];
}
