<?php

namespace App\Models\Backend\Office\Offer;

use App\Models\Backend\Customers\Customer;
use App\Models\Backend\Vehicles\Vehicles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'offer_nr',
        'customer_id',
        'vehicles_id',
        'offer_date',
        'offer_due_date',
        'offer_subtotal',
        'offer_shipping',
        'offer_discount',
        'offer_vat_19',
        'offer_vat_7',
        'offer_vat_at',
        'offer_total',
        'offer_notes_1',
        'offer_notes_2',
        'offer_type',
        'offer_status',
        'offer_external_service',
        'offer_payment',
        'offer_payment_status',
        'offer_order_type',
        'offer_clerk',
        'delivery_performance_date',
    ];

    protected $casts = [
        'offer_date' => 'date:Y-m-d',
        'offer_due_date' => 'date:Y-m-d',
        'delivery_performance_date' => 'date:Y-m-d',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicles::class, 'vehicles_id');
    }

    public function offerDetail(): HasMany
    {
        return $this->hasMany(OfferDetails::class, 'offer_id', 'id');
    }
}
