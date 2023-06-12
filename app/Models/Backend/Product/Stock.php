<?php

namespace App\Models\Backend\Product;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use SoftDeletes;

    protected $fillable = ['stock_reserved', 'stock_available', 'storage_location', 'minimum_amount', 'maximum_amount', 'product_id', 'stock_movement_date', 'stock_movement_qty', 'stock_movement_note'];

    public function products(): BelongsTo
    {
        return $this->belongsTo(Products::class);
    }

    public function stockMovementDate()
    {
        return Carbon::parse($this->stock_movement_date)->format('d.m.Y');
    }
}
