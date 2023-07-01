<?php

namespace App\Models\Backend\Office\Offer;

use App\Models\Backend\Product\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfferDetails extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'offer_id',
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

    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class, 'offer_id', 'id');
    }
}
