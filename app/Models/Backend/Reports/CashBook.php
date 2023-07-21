<?php

namespace App\Models\Backend\Reports;

use App\Models\Backend\Customers\Customer;
use App\Models\Backend\Office\Invoice\Invoice;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CashBook extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'invoice_id',
        'customer_id',
        'cashBook_nr',
        'cashBook_desc',
        'cashBook_clerk',
        'cashBook_output_amount',
        'cashBook_revenue_amount',
        'cashBook_saldo',
        'cashBook_date',
    ];

    protected $casts = [
        'cashBook_date' => 'date:Y-m-d',
    ];

    public function cashBookDate()
    {
        return Carbon::parse($this->cashBook_date)->format('d.m.Y');
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
        $customer = Customer::where('id', $this->customer_id)->first();

        return '<a href="'.route('backend.kunden.show', $customer->id).'">'.$customer->fullname().'</a>';
    }
}
