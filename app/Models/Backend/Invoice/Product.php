<?php

namespace App\Models\Backend\Invoice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['product_name', 'product_qty', 'product_desc', 'product_price'];
}
