<?php

namespace App\Models\Backend\Reports;

use App\Models\Backend\Customers\Customer;
use App\Models\Backend\Office\Invoice\Invoice;
use App\Models\Backend\Office\Invoice\Payment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CashRegister extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'cashRegister_date',
        'invoice_id',
        'customer_id',
        'cashRegister_clerk',
        'cashRegister_output',
        'cashRegister_revenue',
        'cashRegister_saldo',
        'cashRegister_storno',
    ];

    protected $casts = [
        'cashRegister_date' => 'date:Y-m-d',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function invoice()
    {
        return $this->hasMany(Invoice::class, 'id');
    }

    public function dateOfPayment()
    {
        return Carbon::parse($this->cashRegister_date)->format('d.m.Y');
    }

    public function relatedTo()
    {
        $invoice = $this->invoice->first();
        if ($invoice->invoice_type === 'Rechnung') {
            $relatedTo = '<a href="'.route('backend.invoice.bezahlt.show', $invoice->id).'">Rechnung '.$invoice->invoice_nr.'</a>';
        } else {
            $relatedTo = '--';
        }

        return $relatedTo;
    }

    public function customerSupplier()
    {
        $customer = Customer::where('id', $this->customer_id)->first();

        return '<a href="'.route('backend.kunden.show', $customer->id).'">'.$customer->fullname().'</a>';
    }

    public function clerk()
    {
        return Invoice::where('id', $this->invoice_id)->first()->invoice_clerk;
    }

    public function payment()
    {
        return Payment::where('invoice_id', $this->invoice_id)->first()->payment_method;
    }
}
