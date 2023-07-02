<?php

namespace App\Http\Livewire\Backend\Customers;

use App\Models\Backend\Office\Invoice\Invoice;
use App\Models\Backend\Office\Offer\Offer;
use App\Models\Backend\Office\Order\Order;
use Carbon\Carbon;
use Livewire\Component;

class CustomerShow extends Component
{
    public $customers;

    public function mount($kunden)
    {
        $this->customers = $kunden;
    }

    public function showFahrzeuge($id)
    {
        return redirect(route('backend.fahrzeuge.show', $id));
    }

    public function render()
    {
        $dokumente = [];
        $termine = 0;
        $dateien = 0;
        $fahrzeuge = $this->customers->vehicles;
        $invoices = Invoice::where('customer_id', $this->customers->id)->with('invoiceDetail', 'vehicle')->orderBy('created_at', 'DESC')->get();
        $offers = Offer::where('customer_id', $this->customers->id)->with('offerDetail', 'vehicle')->orderBy('created_at', 'DESC')->get();
        $orders = Order::where('customer_id', $this->customers->id)->with('orderDetail', 'vehicle')->orderBy('created_at', 'DESC')->get();
        foreach ($offers as $offer) {
            $dokumente[] = [
                'status' => 'Angebot',
                'nummer' => $offer->offer_nr,
                'datum' => Carbon::parse($offer->offer_date)->format('d.m.Y'),
                'fahrzeug' => '<span class="font-bold">('.$offer->vehicle->vehicles_license_plate.'</span>) '.$offer->vehicle->vehicles_brand.' '.$offer->vehicle->vehicles_model,
                'total' => number_format($offer->offer_total, 2, ',', '.').' €',
            ];
        }
        foreach ($orders as $order) {
            $dokumente[] = [
                'status' => 'Auftrag',
                'nummer' => $order->order_nr,
                'datum' => Carbon::parse($order->order_date)->format('d.m.Y'),
                'fahrzeug' => '<span class="font-bold">('.$order->vehicle->vehicles_license_plate.'</span>) '.$order->vehicle->vehicles_brand.' '.$order->vehicle->vehicles_model,
                'total' => number_format($order->order_total, 2, ',', '.').' €',
            ];
        }
        foreach ($invoices as $invoice) {
            $dokumente[] = [
                'status' => $invoice->invoice_payment_status,
                'nummer' => $invoice->invoice_nr,
                'datum' => Carbon::parse($invoice->invoice_date)->format('d.m.Y'),
                'fahrzeug' => '<span class="font-bold">('.$invoice->vehicle->vehicles_license_plate.'</span>) '.$invoice->vehicle->vehicles_brand.' '.$invoice->vehicle->vehicles_model,
                'total' => number_format($invoice->invoice_total, 2, ',', '.').' €',
            ];
            $sales_volume = number_format($invoice->sum('invoice_total'), 2, ',', '.').' €';
            $outstanding_payments = number_format($invoice->where('invoice_payment_status', 'not_paid')->sum('invoice_total'), 2, ',', '.').' €';
        }

        return view('livewire.backend.customers.customer-show', [
            'fahrzeuge' => $fahrzeuge,
            'dokumente' => $dokumente,
            'sales_volume' => $sales_volume ?? 0,
            'outstanding_payments' => $outstanding_payments ?? 0,
            'termine' => $termine,
            'dateien' => $dateien,
        ]);
    }
}
