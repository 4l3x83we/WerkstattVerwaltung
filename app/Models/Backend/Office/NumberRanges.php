<?php

namespace App\Models\Backend\Office;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NumberRanges extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'invoice_nr',
        'draft_nr',
        'order_nr',
        'offer_nr',
        'cash_book_nr',
        'customer_nr',
    ];
}
