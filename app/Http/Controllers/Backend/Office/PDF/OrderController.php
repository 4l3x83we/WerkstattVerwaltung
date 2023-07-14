<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: OrderController.php
 * User: ${USER}
 * Date: 12.${MONTH_NAME_FULL}.2023
 * Time: 11:16
 */

namespace App\Http\Controllers\Backend\Office\PDF;

use App\Http\Controllers\Controller;
use App\Models\Admin\Settings\BankSettings;
use App\Models\Admin\Settings\CompanySettings;
use App\Models\Backend\Office\Invoice\Invoice;
use App\Models\Backend\Office\Invoice\InvoiceDetails;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function printPDF($id)
    {
        $settings = CompanySettings::latest()->first();
        $bank = BankSettings::where('id', $settings->id)->first();
        $rechnung = Invoice::where('id', $id)->with('customer', 'vehicle')->first();
        $rechnungDetails = InvoiceDetails::where('invoice_id', $rechnung->id)->with('product')->get();

        $pdf = PDF::loadView('backend.buero.pdf.invoice', [
            'settings' => $settings,
            'rechnung' => $rechnung,
            'rechnungDetails' => $rechnungDetails,
            'bank' => $bank,
            'type' => 'Auftrag',
            'toPay' => $rechnung->invoice_payment !== 'Bar',
            'skonto' => invoiceTotalDiscount($rechnung),
        ])->setOption('isPhpEnabled', true)
            ->setPaper('a4', 'portrait');

        return $pdf->stream();
    }

    public function downloadPDF($id)
    {
        $settings = CompanySettings::latest()->first();
        $bank = BankSettings::where('id', $settings->id)->first();
        $rechnung = Invoice::where('id', $id)->with('customer', 'vehicle')->first();
        $rechnungDetails = InvoiceDetails::where('invoice_id', $rechnung->id)->with('product')->get();

        $pdf = PDF::loadView('backend.buero.pdf.invoice', [
            'settings' => $settings,
            'rechnung' => $rechnung,
            'rechnungDetails' => $rechnungDetails,
            'bank' => $bank,
            'type' => 'Auftrag',
            'toPay' => $rechnung->invoice_payment !== 'Bar',
            'skonto' => invoiceTotalDiscount($rechnung),
        ])->setOption('isPhpEnabled', true)
            ->setPaper('a4', 'portrait');

        return $pdf->download('Auftrag-'.$rechnung->order_nr.'.pdf');
    }
}
