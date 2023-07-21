<?php

namespace App\Models\Backend\Reports;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Umsatz extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'invoice_id',
        'customer_id',
        'date',
        'umsatz_brutto',
        'umsatz_netto',
        'einnahmen_netto',
        'einnahmen_brutto',
        'steuer',
    ];

    protected $casts = ['date' => 'date:Y-m-d'];
}
