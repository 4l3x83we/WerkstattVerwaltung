<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: InvoiceCreditController.php
 * User: ${USER}
 * Date: 07.${MONTH_NAME_FULL}.2023
 * Time: 14:42
 */

namespace App\Http\Controllers\Backend\Office\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Admin\Settings\BankSettings;
use App\Models\Admin\Settings\CompanySettings;
use App\Models\Backend\Office\Invoice\Invoice;
use App\Models\Backend\Office\Invoice\InvoiceDetails;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceCreditController extends Controller
{
    public function index()
    {
        return view('backend.buero.rechnung.storno.index');
    }

    public function show($id)
    {
        $show = Invoice::find($id);

        return view('backend.buero.rechnung.storno.show', compact('show'));
    }

    public function printPDF($id)
    {
        $settings = CompanySettings::latest()->first();
        $bank = BankSettings::where('id', $settings->id)->first();
        $rechnung = Invoice::where('id', $id)->with('customer', 'vehicle')->first();
        $rechnungDetails = InvoiceDetails::where('invoice_id', $rechnung->id)->with('product')->get();

        $pdf = PDF::loadView('backend.buero.pdf.workOrder', [
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

        //        return view('backend.buero.pdf.workOrder', compact('rechnungDetails', 'rechnung', 'settings'));
    }

    public function downloadPDF($id)
    {
        $settings = CompanySettings::latest()->first();
        $bank = BankSettings::where('id', $settings->id)->first();
        $rechnung = Invoice::where('id', $id)->with('customer', 'vehicle')->first();
        $rechnungDetails = InvoiceDetails::where('invoice_id', $rechnung->id)->with('product')->get();

        $pdf = PDF::loadView('backend.buero.pdf.workOrder', [
            'settings' => $settings,
            'rechnung' => $rechnung,
            'rechnungDetails' => $rechnungDetails,
            'bank' => $bank,
            'type' => 'Auftrag',
            'toPay' => $rechnung->invoice_payment !== 'Bar',
            'skonto' => invoiceTotalDiscount($rechnung),
        ])->setOption('isPhpEnabled', true)
            ->setPaper('a4', 'portrait');

        return $pdf->download('Arbeitsauftrag-'.$rechnung->order_nr.'.pdf');
    }
}
