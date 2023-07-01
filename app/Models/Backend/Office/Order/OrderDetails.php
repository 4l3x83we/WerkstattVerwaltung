<?php

namespace App\Models\Backend\Office\Order;

use App\Models\Backend\Product\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetails extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'order_id',
        'product_id',
        'qty',
        'price',
        'discountPercent',
        'discount',
        'subtotal',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Products::class, 'product_id', 'id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
