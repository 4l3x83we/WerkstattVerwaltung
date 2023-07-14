<?php

namespace App\Models\Backend\Office\Invoice;

use App\Models\Admin\Settings\BankSettings;
use App\Models\Admin\Settings\CompanySettings;
use App\Models\Backend\Customers\Customer;
use App\Models\Backend\Office\History\History;
use App\Models\Backend\Office\NumberRanges;
use App\Models\Backend\Office\Protocol;
use App\Models\Backend\Vehicles\Vehicles;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'invoice_nr',
        'order_nr',
        'customer_id',
        'vehicles_id',
        'order_date',
        'invoice_date',
        'invoice_due_date',
        'invoice_subtotal',
        'invoice_shipping',
        'invoice_discount',
        'invoice_vat_19',
        'invoice_vat_7',
        'invoice_vat_at',
        'invoice_total',
        'invoice_notes_1',
        'invoice_notes_2',
        'invoice_type',
        'invoice_status',
        'invoice_external_service',
        'invoice_payment',
        'invoice_payment_status',
        'invoice_order_type',
        'invoice_clerk',
        'delivery_performance_date',
    ];

    protected $casts = [
        'order_date' => 'date:Y-m-d',
        'invoice_date' => 'date:Y-m-d',
        'invoice_due_date' => 'date:Y-m-d',
        'delivery_performance_date' => 'date:Y-m-d',
    ];

    public function protocol($invoice)
    {
        Protocol::create([
            'protocol_type_nr' => $this->id,
            'protocol_type' => $this->invoice_type,
            'protocol_text' => $invoice['protocol_text'],
            'protocol_status' => $invoice['protocol_status'],
        ]);
    }

    public function history($invoice, $invoiceDetail)
    {
        History::updateOrCreate(
            [
                'history_inv_nr' => $this->id,
                'history_art_nr' => $invoiceDetail['product_art_nr'],
            ],
            [
                'history_status' => $invoice->invoice_payment_status,
                'history_inv_nr' => $invoice['nr'],
                'customer_id' => $this->customer->id,
                'history_art_nr' => $invoiceDetail['product_art_nr'],
                'history_art_name' => $invoiceDetail['product_name'],
                'history_inv_date' => $invoice['date'],
                'history_vehicle' => $this->vehicle->vehicles_brand.' / '.$this->vehicle->vehicles_license_plate,
                'history_mileage_vehicle' => $this->vehicle->vehicles_mileage,
                'history_qty' => $invoiceDetail['qty'],
                'history_subtotal' => $invoiceDetail['price'],
                'history_total' => $invoiceDetail['subtotal'],
            ]);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicles::class, 'vehicles_id');
    }

    public function invoiceDetail(): HasMany
    {
        return $this->hasMany(InvoiceDetails::class, 'invoice_id', 'id');
    }

    public function payment(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function calculatePayment($zahlungsBetrag)
    {
        return $this->invoice_total - $zahlungsBetrag;
    }

    public function checkInvoiceDateWithPerformanceDate()
    {
        $invoiceDate = Carbon::parse($this->invoice_date);
        $performanceDate = $invoiceDate->eq($this->delivery_performance_date);

        return $performanceDate ? 'entspricht Rechnungsdatum' : Carbon::parse($this->delivery_performance_date)->format('d.m.Y');
    }

    public function numberRanges($invoice = '', $order = '', $offer = '', $cashbook = '', $customer = '')
    {
        NumberRanges::updateOrCreate(['id' => 0], [
            'invoice_nr' => $invoice,
            'order_nr' => $order,
            'offer' => $offer,
            'cash_book_nr' => $cashbook,
            'customer_nr' => $customer,
        ]);
    }

    public function printPDF($type)
    {
        $settings = CompanySettings::latest()->first();
        $bank = BankSettings::where('id', $settings->id)->first();
        $rechnung = self::where('customer_id', $this->customer->id)->with('customer', 'vehicle', 'invoiceDetail')->first();

        $pdf = PDF::loadView('backend.buero.pdf.invoice', [
            'settings' => $settings,
            'rechnung' => $rechnung,
            'rechnungDetails' => $rechnung->invoiceDetail,
            'bank' => $bank,
            'type' => $type,
            'toPay' => $rechnung->invoice_payment !== 'Bar',
            'skonto' => invoiceTotalDiscount($rechnung),
        ])->setOption('isPhpEnabled', true)
            ->setPaper('a4', 'portrait');

        return $pdf->stream();
    }

    public function downloadPDF($type)
    {
        $settings = CompanySettings::latest()->first();
        $bank = BankSettings::where('id', $settings->id)->first();
        $rechnung = self::where('customer_id', $this->customer->id)->with('customer', 'vehicle', 'invoiceDetail')->first();

        $pdf = PDF::loadView('backend.buero.pdf.invoice', [
            'settings' => $settings,
            'rechnung' => $rechnung,
            'rechnungDetails' => $rechnung->invoiceDetail,
            'bank' => $bank,
            'type' => $type,
            'toPay' => $rechnung->invoice_payment !== 'Bar',
            'skonto' => invoiceTotalDiscount($rechnung),
        ])->setOption('isPhpEnabled', true)
            ->setPaper('a4', 'portrait');

        return $pdf->download('Rechnung-'.$rechnung->invoice_nr.'.pdf');
    }

    public function savePDF($type)
    {
        $settings = CompanySettings::latest()->first();
        $bank = BankSettings::where('id', $settings->id)->first();
        $rechnung = self::where('customer_id', $this->customer->id)->with('customer', 'vehicle', 'invoiceDetail')->first();

        $pdf = PDF::loadView('backend.buero.pdf.invoice', [
            'settings' => $settings,
            'rechnung' => $rechnung,
            'rechnungDetails' => $rechnung->invoiceDetail,
            'bank' => $bank,
            'type' => $type,
            'toPay' => $rechnung->invoice_payment !== 'Bar',
            'skonto' => invoiceTotalDiscount($rechnung),
        ])->setOption('isPhpEnabled', true)
            ->setPaper('a4', 'portrait');

        $path = 'dokumente/rechnungen';
        if (! File::isDirectory(public_path($path))) {
            File::makeDirectory(public_path($path), 0775, true, true);
        }

        return $pdf->save(public_path($path).'/Rechnung-'.$rechnung->invoice_nr.'.pdf');
    }
}
