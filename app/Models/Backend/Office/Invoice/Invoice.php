<?php

namespace App\Models\Backend\Office\Invoice;

use App\Models\Backend\Customers\Customer;
use App\Models\Backend\Vehicles\Vehicles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'invoice_nr',
        'customer_id',
        'vehicles_id',
        'invoice_date',
        'invoice_due_date',
        'invoice_subtotal',
        'invoice_shipping',
        'invoice_discount',
        'invoice_vat_19',
        'invoice_vat_7',
        'invoice_vat_at',
        'invoice_total',
        'invoice_notes_1',
        'invoice_notes_2',
        'invoice_type',
        'invoice_status',
        'invoice_external_service',
        'invoice_payment',
        'invoice_payment_status',
        'invoice_order_type',
        'invoice_clerk',
        'delivery_performance_date',
    ];

    protected $casts = [
        'invoice_date' => 'date:Y-m-d',
        'invoice_due_date' => 'date:Y-m-d',
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

    public function invoiceDetail(): HasMany
    {
        return $this->hasMany(InvoiceDetails::class, 'invoice_id', 'id');
    }
}
