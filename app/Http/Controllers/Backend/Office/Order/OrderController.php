<?php

namespace App\Http\Controllers\Backend\Office\Order;

use App\Http\Controllers\Controller;
use App\Models\Admin\Settings\BankSettings;
use App\Models\Admin\Settings\CompanySettings;
use App\Models\Backend\Office\Order\Order;
use App\Models\Backend\Office\Order\OrderDetails;
use Barryvdh\DomPDF\Facade\Pdf;
use File;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function pdf($id)
    {
        $settings = CompanySettings::latest()->first();
        $bank = BankSettings::where('id', $settings->id)->first();
        $order = Order::where('id', $id)->with('customer', 'vehicle')->first();
        $orderDetail = OrderDetails::where('order_id', $order->id)->with('product')->get();

        $pdf = PDF::loadView('backend.buero.auftraege.invoiceTablePDF', [
            'settings' => $settings,
            'order' => $order,
            'orderDetails' => $orderDetail,
            'bank' => $bank,
            'type' => 'Auftrag',
            'toPay' => $order->order_payment !== 'Barzahlung',
            'skonto' => invoiceTotalDiscount($order),
        ])->setOption('isPhpEnabled', true)
            ->setPaper('a4', 'portrait');

        $path = 'dokumente/'.replaceStrToLower($order->customer->fullname().'/auftraege');
        if (! File::isDirectory(public_path($path))) {
            File::makeDirectory(public_path($path), 0775, true, true);
        }

        return $pdf->save(public_path($path).'/Auftrag-'.$order->order_nr.'.pdf')->download('Auftrag-'.$order->order_nr.'.pdf');
    }

    public function index()
    {
        return view('backend.buero.auftraege.index');
    }

    public function create()
    {
        return view('backend.buero.auftraege.create');
    }

    public function show(Order $auftraege)
    {
        return view('backend.buero.auftraege.show', compact('auftraege'));
    }

    public function edit(Request $request, Order $auftraege)
    {
        return view('backend.buero.auftraege.edit', compact('auftraege'));
    }

    public function destroy(Order $auftraege)
    {
        $auftraege->delete();

        return response()->json();
    }

    public function import()
    {

    }
}
