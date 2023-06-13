<?php

namespace App\Models\Backend\Customers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataProtection extends Model
{
    use SoftDeletes;

    protected $fillable = ['customer_id', 'issued_on', 'letters', 'phone', 'fax', 'mobile_phone', 'text_message', 'whatsapp', 'email'];

    protected $casts = ['issued_on' => 'date:Y-m-d'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
