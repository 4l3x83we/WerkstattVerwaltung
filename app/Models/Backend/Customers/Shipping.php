<?php

namespace App\Models\Backend\Customers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipping extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'shipping_salutation',
        'shipping_firstname',
        'shipping_lastname',
        'shipping_additive',
        'shipping_country',
        'shipping_country',
        'shipping_post_code',
        'shipping_location',
    ];

    public function customers(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
