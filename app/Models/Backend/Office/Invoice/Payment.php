<?php

namespace App\Models\Backend\Office\Invoice;

use App\Models\Backend\Customers\Customer;
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
        if ($this->sum('payment_amount') >= 0) {
            if ($this->sum('payment_amount') > 0) {
                $total = ('<span class="text-green-500">'.number_format($this->sum('payment_amount'), 2, ',', '.').' €</span>');
            } else {
                $total = ('<span>'.number_format($this->sum('payment_amount'), 2, ',', '.').' €</span>');
            }
        } else {
            $total = '<span class="text-red-600">'.number_format($this->sum('payment_amount'), 2, ',', '.').' €</span>';
        }
        if ($this->where('payment_method', '=', 'Bar')->sum('payment_amount') >= 0) {
            if ($this->where('payment_method', '=', 'Bar')->sum('payment_amount') > 0) {
                $bar = ('<span class="text-green-500">'.number_format($this->where('payment_method', '=', 'Bar')->sum('payment_amount'), 2, ',', '.').' €</span>');
            } else {
                $bar = ('<span>'.number_format($this->where('payment_method', '=', 'Bar')->sum('payment_amount'), 2, ',', '.').' €</span>');
            }
        } else {
            $bar = '<span class="text-red-600">'.number_format($this->where('payment_method', '=', 'Bar')->sum('payment_amount'), 2, ',', '.').' €</span>';
        }
        if ($this->where('payment_method', '=', 'Überweisung')->sum('payment_amount') >= 0) {
            if ($this->where('payment_method', '=', 'Überweisung')->sum('payment_amount') > 0) {
                $ueberweisung = ('<span class="text-green-500">'.number_format($this->where('payment_method', '=', 'Überweisung')->sum('payment_amount'), 2, ',', '.').' €</span>');
            } else {
                $ueberweisung = ('<span>'.number_format($this->where('payment_method', '=', 'Überweisung')->sum('payment_amount'), 2, ',', '.').' €</span>');
            }
        } else {
            $ueberweisung = '<span class="text-red-600">'.number_format($this->where('payment_method', '=', 'Überweisung')->sum('payment_amount'), 2, ',', '.').' €</span>';
        }
        $kartenzahlung = $this->getKartenzahlung();
        if ($this->where('payment_method', '=', 'PayPal')->sum('payment_amount') >= 0) {
            if ($this->where('payment_method', '=', 'PayPal')->sum('payment_amount') > 0) {
                $paypal = ('<span class="text-green-500">'.number_format($this->where('payment_method', '=', 'PayPal')->sum('payment_amount'), 2, ',', '.').' €</span>');
            } else {
                $paypal = ('<span>'.number_format($this->where('payment_method', '=', 'PayPal')->sum('payment_amount'), 2, ',', '.').' €</span>');
            }
        } else {
            $paypal = '<span class="text-red-600">'.number_format($this->where('payment_method', '=', 'PayPal')->sum('payment_amount'), 2, ',', '.').' €</span>';
        }

        return [
            'total' => $total,
            'bar' => $bar,
            'ueberweisung' => $ueberweisung,
            'kartenzahlung' => $kartenzahlung,
            'paypal' => $paypal,
        ];
    }

    public function getKartenzahlung(): string
    {
        if ($this->where('payment_method', '=', 'Kartenzahlung')->sum('payment_amount') >= 0) {
            if ($this->where('payment_method', '=', 'Kartenzahlung')->sum('payment_amount') > 0) {
                $kartenzahlung = ('<span class="text-green-500">'.number_format($this->where('payment_method', '=', 'Kartenzahlung')->sum('payment_amount'), 2, ',', '.').' €</span>');
            } else {
                $kartenzahlung = ('<span>'.number_format($this->where('payment_method', '=', 'Kartenzahlung')->sum('payment_amount'), 2, ',', '.').' €</span>');
            }
        } else {
            $kartenzahlung = '<span class="text-red-600">'.number_format($this->where('payment_method', '=', 'Kartenzahlung')->sum('payment_amount'), 2, ',', '.').' €</span>';
        }

        return $kartenzahlung;
    }

    public function summeCard()
    {
        $total = $this->getKartenzahlung();

        return [
            'total' => $total,
        ];
    }

    public function relatedTo()
    {
        $invoice = Invoice::where('id', $this->invoice_id)->first();
        if ($invoice->invoice_type === 'Rechnung') {
            $relatedTo = '<a href="'.route('backend.invoice.bezahlt.show', $invoice->id).'">Rechnung '.$invoice->invoice_nr.'</a>';
        } else {
            $relatedTo = '--';
        }

        return $relatedTo;
    }

    public function customerSupplier()
    {
        $customer = Customer::where('id', $this->invoice->customer->id)->first();

        return '<a href="'.route('backend.kunden.show', $customer->id).'">'.$customer->fullname().'</a>';
    }
}
