<?php

namespace App\Models\Backend\Office\Invoice;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'payment_nr',
        'invoice_id',
        'payment_amount',
        'date_of_payment',
        'payment_method',
        'notes',
    ];

    protected $casts = [
        'date_of_payment' => 'date:Y-m-d',
    ];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function dateOfPayment()
    {
        return Carbon::parse($this->date_of_payment)->format('d.m.Y');
    }
}
