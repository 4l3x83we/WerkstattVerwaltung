<?php

namespace App\Models\Backend\Office\Order;

use App\Models\Backend\Customers\Customer;
use App\Models\Backend\Vehicles\Vehicles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'order_nr',
        'customer_id',
        'vehicles_id',
        'order_date',
        'order_due_date',
        'order_subtotal',
        'order_shipping',
        'order_discount',
        'order_vat_19',
        'order_vat_7',
        'order_vat_at',
        'order_total',
        'order_notes_1',
        'order_notes_2',
        'order_type',
        'order_status',
        'order_external_service',
        'order_payment',
        'order_payment_status',
        'order_order_type',
        'order_clerk',
        'delivery_performance_date',
    ];

    protected $casts = [
        'order_date' => 'date:Y-m-d',
        'order_due_date' => 'date:Y-m-d',
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

    public function orderDetail(): HasMany
    {
        return $this->hasMany(OrderDetails::class, 'order_id', 'id');
    }
}
