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

    public function summe()
    {
        $total = $this->sum('payment_amount') >= 0 ? ($this->sum('payment_amount') > 0 ? '<span class="text-green-500">'.number_format($this->sum('payment_amount'), 2, ',', '.').' €</span>' : '<span>'.number_format($this->sum('payment_amount'), 2, ',', '.').' €</span>') : '<span class="text-red-600">'.number_format($this->sum('payment_amount'), 2, ',', '.').' €</span>';
        $bar = $this->where('payment_method', '=', 'Bar')->sum('payment_amount') >= 0 ? ($this->where('payment_method', '=', 'Bar')->sum('payment_amount') > 0 ? '<span class="text-green-500">'.number_format($this->where('payment_method', '=', 'Bar')->sum('payment_amount'), 2, ',', '.').' €</span>' : '<span>'.number_format($this->where('payment_method', '=', 'Bar')->sum('payment_amount'), 2, ',', '.').' €</span>') : '<span class="text-red-600">'.number_format($this->where('payment_method', '=', 'Bar')->sum('payment_amount'), 2, ',', '.').' €</span>';
        $ueberweisung = $this->where('payment_method', '=', 'Überweisung')->sum('payment_amount') >= 0 ? ($this->where('payment_method', '=', 'Überweisung')->sum('payment_amount') > 0 ? '<span class="text-green-500">'.number_format($this->where('payment_method', '=', 'Überweisung')->sum('payment_amount'), 2, ',', '.').' €</span>' : '<span>'.number_format($this->where('payment_method', '=', 'Überweisung')->sum('payment_amount'), 2, ',', '.').' €</span>') : '<span class="text-red-600">'.number_format($this->where('payment_method', '=', 'Überweisung')->sum('payment_amount'), 2, ',', '.').' €</span>';
        $kartenzahlung = $this->where('payment_method', '=', 'Kartenzahlung')->sum('payment_amount') >= 0 ? ($this->where('payment_method', '=', 'Kartenzahlung')->sum('payment_amount') > 0 ? '<span class="text-green-500">'.number_format($this->where('payment_method', '=', 'Kartenzahlung')->sum('payment_amount'), 2, ',', '.').' €</span>' : '<span>'.number_format($this->where('payment_method', '=', 'Kartenzahlung')->sum('payment_amount'), 2, ',', '.').' €</span>') : '<span class="text-red-600">'.number_format($this->where('payment_method', '=', 'Kartenzahlung')->sum('payment_amount'), 2, ',', '.').' €</span>';
        $paypal = $this->where('payment_method', '=', 'PayPal')->sum('payment_amount') >= 0 ? ($this->where('payment_method', '=', 'PayPal')->sum('payment_amount') > 0 ? '<span class="text-green-500">'.number_format($this->where('payment_method', '=', 'PayPal')->sum('payment_amount'), 2, ',', '.').' €</span>' : '<span>'.number_format($this->where('payment_method', '=', 'PayPal')->sum('payment_amount'), 2, ',', '.').' €</span>') : '<span class="text-red-600">'.number_format($this->where('payment_method', '=', 'PayPal')->sum('payment_amount'), 2, ',', '.').' €</span>';

        return [
            'total' => $total,
            'bar' => $bar,
            'ueberweisung' => $ueberweisung,
            'kartenzahlung' => $kartenzahlung,
            'paypal' => $paypal,
        ];
    }
}
