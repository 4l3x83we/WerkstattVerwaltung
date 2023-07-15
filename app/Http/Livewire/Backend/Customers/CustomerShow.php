<?php

namespace App\Http\Livewire\Backend\Customers;

use App\Models\Backend\Office\History\History;
use App\Models\Backend\Office\Invoice\Invoice;
use App\Models\Backend\Office\Offer\Offer;
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

    public function showInvoice($id)
    {
        $item = Invoice::where('id', $id)->first();
        if ($item->invoice_status == 'open') {
            return redirect(route('backend.invoice.offen.show', $id));
        } elseif ($item->invoice_status == 'order') {
            return redirect(route('backend.auftraege.show', $id));
        } elseif ($item->invoice_status == 'entwurf') {
            return redirect(route('backend.invoice.entwurf.edit', $id));
        } elseif ($item->invoice_status == 'paid') {
            return redirect(route('backend.invoice.bezahlt.show', $id));
        } elseif ($item->invoice_status == 'storno') {
            return redirect(route('backend.invoice.storno.show', $id));
        }
    }

    public function createOrder($id)
    {
        return redirect(route('backend.auftraege.create-id', $id));
    }

    public function history($id)
    {
        return redirect(route('backend.history.index', $id));
    }

    public function render()
    {
        $dokumente = [];
        $termine = 0;
        $dateien = 0;
        $history = History::where('customer_id', $this->customers->id)->first();
        $fahrzeuge = $this->customers->vehicles;
        $invoices = Invoice::where('customer_id', $this->customers->id)->with('invoiceDetail', 'vehicle')->orderBy('created_at', 'DESC')->take(3)->get();
        $offers = Offer::where('customer_id', $this->customers->id)->with('offerDetail', 'vehicle')->orderBy('created_at', 'DESC')->take(1)->get();
        foreach ($offers as $offer) {
            $dokumente[] = [
                'status' => 'Angebot',
                'id' => $offer->id,
                'nummer' => $offer->offer_nr,
                'datum' => Carbon::parse($offer->offer_date)->format('d.m.Y'),
                'fahrzeug' => '<span class="font-bold">('.$offer->vehicle->vehicles_license_plate.'</span>) '.$offer->vehicle->vehicles_brand.' '.$offer->vehicle->vehicles_model,
                'total' => number_format($offer->offer_total, 2, ',', '.').' €',
            ];
        }
        foreach ($invoices as $invoice) {
            $dokumente[] = [
                'status' => $invoice->invoice_payment_status,
                'id' => $invoice->id,
                'nummer' => $invoice->invoice_nr,
                'datum' => Carbon::parse($invoice->invoice_date)->format('d.m.Y'),
                'fahrzeug' => '<span class="font-bold">('.$invoice->vehicle->vehicles_license_plate.'</span>) '.$invoice->vehicle->vehicles_brand.' '.$invoice->vehicle->vehicles_model,
                'total' => number_format($invoice->invoice_total, 2, ',', '.').' €',
            ];
            $sales_volume = number_format($invoice->where('customer_id', $invoice->customer_id)->sum('invoice_total'), 2, ',', '.').' €';
            $outstanding_payments = number_format($invoice->where('customer_id', $invoice->customer_id)->where('invoice_payment_status', '!=', 'paid')
                ->sum('invoice_total'), 2, ',', '.').' €';
        }

        return view('livewire.backend.customers.customer-show', [
            'fahrzeuge' => $fahrzeuge,
            'dokumente' => $dokumente,
            'sales_volume' => $sales_volume ?? 0,
            'outstanding_payments' => $outstanding_payments ?? 0,
            'termine' => $termine,
            'dateien' => $dateien,
            'history' => $history,
        ]);
    }
}
