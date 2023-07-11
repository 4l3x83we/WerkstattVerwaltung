<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Show.php
 * User: ${USER}
 * Date: 07.${MONTH_NAME_FULL}.2023
 * Time: 14:57
 */

namespace App\Http\Livewire\Backend\Office\Invoice\All;

use App\Models\Admin\Settings\CompanySettings;
use App\Models\Backend\Customers\Customer;
use App\Models\Backend\Office\Invoice\Payment;
use App\Models\Backend\Vehicles\Vehicles;
use Carbon\Carbon;
use Livewire\Component;

class Show extends Component
{
    public $invoice;

    public $invoiceDetails = [];

    public $customer;

    public $invoice_oldTotal;

    public $paymentTotal;

    public $payment_in_percent;

    public function mount($invoice)
    {
        $this->settings = CompanySettings::latest()->first();
        $this->updatedCustomerId($invoice->customer_id);
        $this->updatedFahrzeugeVehiclesInternalVehicleNumber($invoice->vehicles_id);
        $invoiceDetails = $invoice->invoiceDetail;
        if ($invoiceDetails) {
            foreach ($invoiceDetails as $invoiceDetail) {
                $this->invoiceDetails[] = [
                    'id' => $invoiceDetail->id,
                    'product_id' => $invoiceDetail->product_id,
                    'product_id' => $invoiceDetail->product_id,
                    'product_artnr' => $invoiceDetail->product_art_nr,
                    'product_name' => $invoiceDetail->product_name,
                    'product_desc' => $invoiceDetail->product_desc,
                    'tax' => $invoiceDetail->tax,
                    'qty' => $invoiceDetail->qty,
                    'price' => $invoiceDetail->price,
                    'discountPercent' => $invoiceDetail->discountPercent,
                    'discount' => $invoiceDetail->discount,
                    'subtotal' => $invoiceDetail->subtotal,
                    'is_saved' => true,
                ];
            }
        }
        $this->invoice_oldTotal = $invoice->invoice_total;
        $this->paymentTotal = $this->invoice->payment->sum('payment_amount');
        $this->payment_in_percent = $this->invoice->payment->sum('payment_amount') ? abs(round((($this->invoice->invoice_total - $this->invoice->calculatePayment($this->paymentTotal)) / $this->invoice->invoice_total) * 100, 2)) : 0;
        //        dd($this->payment_in_percent);
    }

    public function updatedCustomerId($id)
    {
        $this->fahrzeugSelect = false;
        $this->fahrzeuge = null;
        $customer = Customer::find($id);
        if (! is_null($customer)) {
            $this->customer['id'] = $id;
            $this->address = 'Kd-Nr. '.$customer->customer_kdnr.'<br> '.$customer->customer_salutation.' '.$customer->customer_firstname.' '.$customer->customer_lastname.'<br> '.$customer->customer_street.'<br> '.$customer->customer_post_code.' '.$customer->customer_location;
            $this->vehicles = $customer->vehicles;
        } else {
            $this->address = false;
            $this->customer = null;
        }
    }

    public function updatedFahrzeugeVehiclesInternalVehicleNumber($id)
    {
        $vehicles = Vehicles::where('id', $id)->first();
        if (! is_null($vehicles)) {
            $this->fahrzeuge['vehicles_internal_vehicle_number'] = $id;
            $kennzeichen = $vehicles->vehicles_license_plate ?: 'nicht angegeben';
            $this->fahrzeugSelect['fahrzeug'] = 'Kennzeichen: '.$kennzeichen.'<br> Marke: '.$vehicles->vehicles_brand.'<br> Model: '.$vehicles->vehicles_model;
            $this->fahrzeuge['vehicles_mileage'] = $vehicles->vehicles_mileage;
            $this->fahrzeugSelect['tuev'] = Carbon::parse($vehicles->vehicles_hu)->format('d.m.Y');
        } else {
            $this->fahrzeugSelect = false;
            $this->fahrzeuge = null;
        }
    }

    public function render()
    {
        $payments = $this->invoice->payment;
        $payment = Payment::where('invoice_id', $this->invoice->id)->latest()->first();
        $total19 = 0;
        $total7 = 0;
        $totalAT = 0;
        $subtotal = 0;
        $total = 0;
        $discount = 0;

        foreach ($this->invoiceDetails as $invoiceDetail) {
            if ($invoiceDetail['is_saved'] && $invoiceDetail['subtotal']) {
                $subtotal += $invoiceDetail['subtotal'];
            }
            if ($invoiceDetail['is_saved'] && $invoiceDetail['subtotal'] && $invoiceDetail['tax'] == 19) {
                $total19 += $invoiceDetail['subtotal'] * mwst($invoiceDetail['tax']) - $invoiceDetail['subtotal'];
            }
            if ($invoiceDetail['is_saved'] && $invoiceDetail['subtotal'] && $invoiceDetail['tax'] == 7) {
                $total7 += $invoiceDetail['subtotal'] * mwst($invoiceDetail['tax']) - $invoiceDetail['subtotal'];
            }
            if ($invoiceDetail['is_saved'] && $invoiceDetail['subtotal'] && $invoiceDetail['tax'] == 20.9) {
                $totalAT += $invoiceDetail['subtotal'] * mwst($invoiceDetail['tax']) - $invoiceDetail['subtotal'];
            }
            if ($invoiceDetail['is_saved'] && $invoiceDetail['discount']) {
                $discount += $invoiceDetail['discount'];
            }
        }

        $total += $subtotal + $total19 + $total7 + $totalAT;

        if ($total) {
            $this->invoice['invoice_subtotal'] = number_format($subtotal, 2);
            $this->invoice['invoice_vat_19'] = number_format($total19, 2);
            $this->invoice['invoice_vat_7'] = number_format($total7, 2);
            $this->invoice['invoice_vat_at'] = number_format($totalAT, 2);
            $this->invoice['invoice_total'] = number_format($total, 2);
            $this->invoice['invoice_discount'] = number_format($discount, 2);
        }

        return view('livewire.backend.office.invoice.all.show', [
            'subtotals' => $subtotal ?? 0,
            'total19' => $total19 ?? 0,
            'total7' => $total7 ?? 0,
            'totalAT' => $totalAT ?? 0,
            'total' => $total ?? 0,
            'discountTotal' => $discount ?? 0,
            'payments' => $payments,
            'payment' => $payment,
        ]);
    }
}
