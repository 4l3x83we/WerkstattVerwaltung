<?php

namespace App\Http\Controllers\Backend\Office\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Admin\Settings\BankSettings;
use App\Models\Admin\Settings\CompanySettings;
use App\Models\Backend\Office\Invoice\Invoice;
use App\Models\Backend\Office\Invoice\invoiceDetails;
use File;
use PDF;

class InvoiceController extends Controller
{
    public function pdf($id)
    {
        $settings = CompanySettings::latest()->first();
        $bank = BankSettings::where('id', $settings->id)->first();
        $rechnung = Invoice::where('id', $id)->with('customer', 'vehicle')->first();
        $rechnungDetail = invoiceDetails::where('invoice_id', $rechnung->id)->with('product')->get();

        $pdf = PDF::loadView('backend.buero.rechnung.invoiceTablePDF', [
            'settings' => $settings,
            'rechnung' => $rechnung,
            'rechnungDetails' => $rechnungDetail,
            'bank' => $bank,
            'type' => 'Rechnung',
            'toPay' => $rechnung->invoice_payment !== 'Barzahlung',
            'skonto' => invoiceTotalDiscount($rechnung),
        ])->setOption('isPhpEnabled', true)
            ->setPaper('a4', 'portrait');

        $path = 'dokumente/'.replaceStrToLower($rechnung->customer->fullname().'/rechnungen');
        if (! File::isDirectory(public_path($path))) {
            File::makeDirectory(public_path($path), 0775, true, true);
        }

        return $pdf->save(public_path($path).'/Rechnung-'.$rechnung->invoice_nr.'.pdf')->download('Rechnung-'.$rechnung->invoice_nr.'.pdf');
    }

    public function index()
    {
        return view('backend.buero.rechnung.index');
    }

    public function indexOrder()
    {
        return view('backend.buero.rechnung.indexOrder');
    }

    public function create()
    {
        return view('backend.buero.rechnung.create');
    }

    public function createOrder()
    {
        return view('backend.buero.rechnung.createOrder');
    }

    public function show($id)
    {
        $offen = Invoice::where('invoice_nr', '=', $id)->first();

        return view('backend.buero.rechnung.show', compact('offen'));
    }

    public function showOrder($id)
    {
        $order = Invoice::where('order_nr', '=', $id)->first();

        return view('backend.buero.rechnung.showOrder', compact('order'));
    }

    public function edit($id)
    {
        $offen = Invoice::where('invoice_nr', '=', $id)->first();

        return view('backend.buero.rechnung.edit', compact('offen'));
    }

    public function destroy(Invoice $rechnung)
    {
        $rechnung->delete();

        return response()->json();
    }

    public function import()
    {

    }
}
