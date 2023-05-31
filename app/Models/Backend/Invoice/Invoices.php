<?php

namespace App\Models\Backend\Invoice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoices extends Model
{
    use SoftDeletes;

    protected $fillable = ['email', 'invoice_date', 'invoice_due_date', 'subtotal', 'shipping', 'discount', 'vat', 'total', 'notes', 'invoice_type', 'status'];

    protected $casts = [
        'invoice_date' => 'date',
        'invoice_due_date' => 'date',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customers::class, 'email', 'email');
    }

    public function invoiceDetails(): HasMany
    {
        return $this->hasMany(InvoiceDetail::class, 'invoice_id', 'id');
    }
}
