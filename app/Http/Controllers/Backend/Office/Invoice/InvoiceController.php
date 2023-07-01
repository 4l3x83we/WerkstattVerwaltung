<?php

namespace App\Http\Controllers\Backend\Office\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Admin\Settings\BankSettings;
use App\Models\Admin\Settings\CompanySettings;
use App\Models\Backend\Office\Invoice\Invoice;
use App\Models\Backend\Office\Invoice\OrderDetails;
use File;
use Illuminate\Http\Request;
use PDF;

class InvoiceController extends Controller
{
    public function pdf($id)
    {
        $settings = CompanySettings::latest()->first();
        $bank = BankSettings::where('id', $settings->id)->first();
        $rechnung = Invoice::where('id', $id)->with('customer', 'vehicle')->first();
        $rechnungDetail = OrderDetails::where('invoice_id', $rechnung->id)->with('product')->get();

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

    public function create()
    {
        return view('backend.buero.rechnung.create');
    }

    public function show(Invoice $rechnung)
    {
        return view('backend.buero.rechnung.show', compact('rechnung'));
    }

    public function edit(Request $request, Invoice $rechnung)
    {
        return view('backend.buero.rechnung.edit', compact('rechnung'));
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
