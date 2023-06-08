<?php

namespace App\Models\Backend\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceGroup extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'artikel_id',
        'priceGroup_price_vk_1',
        'priceGroup_price_vk_2',
        'priceGroup_price_vk_3',
        'priceGroup_price_vk_4',
        'priceGroup_price_vk_5',
        'priceGroup_price_vk_brutto_1',
        'priceGroup_price_vk_brutto_2',
        'priceGroup_price_vk_brutto_3',
        'priceGroup_price_vk_brutto_4',
        'priceGroup_price_vk_brutto_5',
    ];

    public function products(): BelongsTo
    {
        return $this->belongsTo(Products::class);
    }
}
