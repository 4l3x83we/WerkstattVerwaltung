<?php

namespace App\Http\Controllers\Backend\Office\Offer;

use App\Http\Controllers\Controller;
use App\Models\Admin\Settings\BankSettings;
use App\Models\Admin\Settings\CompanySettings;
use App\Models\Backend\Office\Offer\Offer;
use App\Models\Backend\Office\Offer\OfferDetails;
use Barryvdh\DomPDF\Facade\Pdf;
use File;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function pdf($id)
    {
        $settings = CompanySettings::latest()->first();
        $bank = BankSettings::where('id', $settings->id)->first();
        $offer = Offer::where('id', $id)->with('customer', 'vehicle')->first();
        $offerDetail = OfferDetails::where('offer_id', $offer->id)->with('product')->get();

        $pdf = PDF::loadView('backend.buero.angebote.invoiceTablePDF', [
            'settings' => $settings,
            'offer' => $offer,
            'offerDetails' => $offerDetail,
            'bank' => $bank,
            'type' => 'Angebot',
            'toPay' => $offer->offer_payment !== 'Barzahlung',
            'skonto' => invoiceTotalDiscount($offer),
        ])->setOption('isPhpEnabled', true)
            ->setPaper('a4', 'portrait');

        $path = 'dokumente/'.replaceStrToLower($offer->customer->fullname().'/angebote');
        if (! File::isDirectory(public_path($path))) {
            File::makeDirectory(public_path($path), 0775, true, true);
        }

        return $pdf->save(public_path($path).'/Angebote-'.$offer->offer_nr.'.pdf')->download('Angebote-'.$offer->offer_nr.'.pdf');
    }

    public function index()
    {
        return view('backend.buero.angebote.index');
    }

    public function create()
    {
        return view('backend.buero.angebote.create');
    }

    public function show(Offer $angebote)
    {
        return view('backend.buero.angebote.show', compact('angebote'));
    }

    public function edit(Request $request, Offer $angebote)
    {
        return view('backend.buero.angebote.edit', compact('angebote'));
    }

    public function destroy(Offer $angebote)
    {
        $angebote->delete();

        return response()->json();
    }

    public function import()
    {

    }
}
