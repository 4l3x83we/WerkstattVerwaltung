<?php

namespace App\Http\Controllers\Backend\Office;

use App\Http\Controllers\Controller;
use App\Models\Admin\Settings\BankSettings;
use App\Models\Admin\Settings\CompanySettings;
use App\Models\Backend\Office\Invoice;
use App\Models\Backend\Office\InvoiceDetails;
use Illuminate\Http\Request;
use PDF;

class InvoiceController extends Controller
{
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

    public function pdf($id)
    {
        $settings = CompanySettings::latest()->first();
        $bank = BankSettings::where('id', $settings->id)->first();
        $rechnung = Invoice::where('id', $id)->with('customer', 'vehicle')->first();
        $rechnungDetail = InvoiceDetails::where('id', $rechnung->id)->with('product')->get();

        return PDF::loadView('backend.buero.rechnung.invoiceTablePDF', [
            'settings' => $settings,
            'rechnung' => $rechnung,
            'rechnungDetails' => $rechnungDetail,
            'bank' => $bank,
            'type' => 'Rechnung',
            'toPay' => $rechnung->invoice_payment !== 'Barzahlung',
            'skonto' => invoiceTotalDiscount($rechnung),
        ])
            ->setOption(['defaultFont' => 'sans-serif', 'enable_php' => true])
            ->setOption('isPhpEnabled', true)
            ->setPaper('a4', 'portrait')
            ->download('Rechnung-'.$rechnung->invoice_nr.'.pdf');
    }
}
