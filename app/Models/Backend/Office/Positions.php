<?php

namespace App\Models\Backend\Office;

use App\Models\Backend\Product\Products;
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

    public function positionsName()
    {
        $product = Products::where('product_artnr', $this->positions_art_nr)->first()->product_name;
        if (! is_null($product)) {
            return $product;
        }
    }
}
