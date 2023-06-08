<?php

namespace App\Models\Backend\Product;

use Illuminate\Database\Eloquent\Model;

class Hersteller extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];
}
