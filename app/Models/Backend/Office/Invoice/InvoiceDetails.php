<?php

namespace App\Models\Backend\Office\Invoice;

use App\Models\Backend\Product\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceDetails extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'invoice_id',
        'product_id',
        'product_art_nr',
        'product_name',
        'product_desc',
        'qty',
        'tax',
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

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoice_id', 'id');
    }
}
