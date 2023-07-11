<?php

namespace App\Models\Backend\Office\History;

use App\Models\Backend\Customers\Customer;
use App\Models\Backend\Product\Products;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class History extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'history_status',
        'history_inv_nr',
        'customer_id',
        'history_art_nr',
        'history_art_name',
        'history_inv_date',
        'history_vehicle',
        'history_mileage_vehicle',
        'history_qty',
        'history_subtotal',
        'history_total',
    ];

    protected $casts = [
        'history_inv_date' => 'date:Y-m-d',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function historyInvDate()
    {
        return $this->history_inv_date ? Carbon::parse($this->history_inv_date)->format('d.m.Y') : '--';
    }

    public function productName()
    {
        return Products::where('id', $this->history_art_nr)->first()->product_name;
    }
}
