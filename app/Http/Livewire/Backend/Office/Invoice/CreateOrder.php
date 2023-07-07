<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: CreateOrder.php
 * User: ${USER}
 * Date: 04.${MONTH_NAME_FULL}.2023
 * Time: 15:48
 */

namespace App\Http\Livewire\Backend\Office\Invoice;

use App\Models\Admin\Settings\CompanySettings;
use App\Models\Backend\Customers\Customer;
use App\Models\Backend\Office\Invoice\Invoice;
use App\Models\Backend\Office\Invoice\InvoiceDetails;
use App\Models\Backend\Office\Protocol;
use App\Models\Backend\Product\Products;
use App\Models\Backend\Vehicles\Mileage;
use App\Models\Backend\Vehicles\Vehicles;
use Carbon\Carbon;
use Livewire\Component;

class CreateOrder extends Component
{
    public $order;

    public $invoiceDetails = [];

    public $customer;

    public $address = false;

    public $vehicles = [];

    public $fahrzeuge;

    public $fahrzeugSelect = false;

    public $product_art_nr = false;

    public $product;

    protected $messages = [
        'customer.id' => 'Kundennummer muss ausgewählt werden.',
        'fahrzeuge.vehicles_internal_vehicle_number' => 'Fahrzeug muss ausgewählt werden.',
    ];

    public function rules()
    {
        return [
            'customer.id' => 'required',
            'customer.customer_kdnr' => 'nullable',

            'order.customer_id' => 'nullable',
            'order.order_nr' => 'nullable',
            'order.order_date' => 'nullable',
            'order.invoice_notes_1' => 'nullable',
            'order.invoice_notes_2' => 'nullable',
            'order.delivery_performance_date' => 'nullable',
            'order.invoice_clerk' => 'nullable',
            'order.invoice_subtotal' => 'nullable',
            'order.invoice_vat_19' => 'nullable',
            'order.invoice_vat_7' => 'nullable',
            'order.invoice_vat_at' => 'nullable',
            'order.invoice_total' => 'nullable',
            'order.invoice_discount' => 'nullable',
            'order.invoice_type' => 'nullable',
            'order.invoice_status' => 'nullable',

            'fahrzeuge.vehicles_internal_vehicle_number' => 'required',
            'fahrzeuge.vehicles_mileage' => 'nullable',

            'vehicles.vehicles_license_plate' => 'nullable',
            'vehicles.vehicles_brand' => 'nullable',
            'vehicles.vehicles_model' => 'nullable',
            'vehicles.vehicles_type' => 'nullable',
            'vehicles.vehicles_first_registration' => 'nullable',

            'invoiceDetails.*.invoice_id' => 'nullable',
            'invoiceDetails.*.product_id' => 'nullable',
            'invoiceDetails.*.qty' => 'nullable',
            'invoiceDetails.*.price' => 'nullable',
            'invoiceDetails.*.discountPercent' => 'nullable',
            'invoiceDetails.*.discount' => 'nullable',
            'invoiceDetails.*.subtotal' => 'nullable',
            'invoiceDetails.*.is_saved' => 'nullable',
        ];
    }

    public function mount()
    {
        $this->settings = CompanySettings::latest()->first();
        $this->customer['id'] = null;
        $this->order['order_nr'] = $this->lastOrderID();
        $this->order['order_date'] = date('Y-m-d');
        $this->order['delivery_performance_date'] = date('Y-m-d');
        $this->order['invoice_type'] = 'Auftrag';
        $this->order['invoice_status'] = 'auftrag';
        $this->order['invoice_clerk'] = auth()->user()->name;
        $this->invoiceDetails = [];
        $this->addProduct();
    }

    public function lastOrderID()
    {
        $lastID = Invoice::withTrashed()->latest()->first()->order_nr;
        if (date('Y-01-01') === date('Y-m-d')) {
            $nextOrderNumber = date('Y').'200001';
        } else {
            $nextOrderNumber = $lastID + 1;
        }

        return $nextOrderNumber;
    }

    public function addProduct()
    {
        $this->product_art_nr = null;
        $this->product = null;
        $this->product['qty'] = 1;
        $this->product['discount'] = null;
        $this->invoiceDetails[] = [
            'product_id' => '',
            'product_art_nr' => '',
            'qty' => 1,
            'einheit' => '',
            'price' => 0,
            'discountPercent' => null,
            'discount' => 0,
            'subtotal' => 0,
            'is_saved' => false,
        ];
    }

    public function updatedFahrzeugeVehiclesInternalVehicleNumber($id)
    {
        $vehicles = Vehicles::where('id', $id)->first();
        if (! is_null($vehicles)) {
            $kennzeichen = $vehicles->vehicles_license_plate ?: 'nicht angegeben';
            $this->fahrzeugSelect['fahrzeug'] = 'Kennzeichen: '.$kennzeichen.'<br> Marke: '.$vehicles->vehicles_brand.'<br> Model: '.$vehicles->vehicles_model;
            $this->fahrzeuge['vehicles_mileage'] = $vehicles->vehicles_mileage;
            $this->fahrzeugSelect['tuev'] = Carbon::parse($vehicles->vehicles_hu)->format('d.m.Y');
        } else {
            $this->fahrzeugSelect = false;
            $this->fahrzeuge = null;
        }
    }

    public function editProduct($index)
    {
        $lastArray = array_key_last($this->invoiceDetails);
        $this->removeProduct($lastArray);
        $this->product_art_nr = true;
        $this->invoiceDetails[$index]['is_saved'] = false;
        $this->product['product_art_nr'] = $this->invoiceDetails[$index]['product_artnr'];
        $this->product['product_id'] = $this->invoiceDetails[$index]['product_id'];
        $this->product['product_name'] = $this->invoiceDetails[$index]['product_name'];
        $this->product['product_desc'] = $this->invoiceDetails[$index]['product_desc'];
        $this->product['qty'] = $this->invoiceDetails[$index]['qty'];
        $this->product['tax'] = $this->invoiceDetails[$index]['tax'];
        $this->product['einheit'] = $this->invoiceDetails[$index]['einheit'];
        $this->product['price'] = $this->invoiceDetails[$index]['price'];
        $this->product['discountPercent'] = $this->invoiceDetails[$index]['discountPercent'];
        $this->product['discount'] = $this->invoiceDetails[$index]['discount'];
        $this->product['subtotal'] = $this->invoiceDetails[$index]['subtotal'];
    }

    public function removeProduct($index)
    {
        unset($this->invoiceDetails[$index]);
        $this->invoiceDetails = array_values($this->invoiceDetails);
    }

    public function saveProduct($index, $id = '')
    {
        $this->resetErrorBag();
        $artNr = $this->updatedProductProductArtnr()['artNr'];
        $ean = $this->updatedProductProductArtnr()['ean'];
        $produkt = Products::where('product_artnr', '=', $artNr)
            ->where('product_ean', '=', $ean)
            ->first();
        $this->invoiceDetails[$index] = [
            'product_id' => $produkt->id,
            'product_artnr' => $produkt->product_artnr,
            'product_name' => $produkt->product_name,
            'product_desc' => $produkt->product_desc,
            'qty' => $this->product['qty'],
            'price' => $produkt->product_price_netto_vk,
            'tax' => $produkt->product_mwst,
            'einheit' => $produkt->product_einheit,
            'discountPercent' => $this->product['discountPercent'] ?? null,
            'discount' => $this->updatedProductDiscountPercent() ?? null,
            'subtotal' => (! is_null($this->product['discountPercent'])) ? $produkt->product_price_netto_vk * $this->product['qty'] - $this->product['discount'] : $produkt->product_price_netto_vk * $this->product['qty'],
            'is_saved' => true,
        ];
        $this->addProduct();
    }

    public function updatedProductProductArtnr()
    {
        $products = Products::where('product_artnr', '=', $this->product['product_art_nr'])
            ->orWhere('product_ean', '=', $this->product['product_art_nr'])
            ->first();
        if (! is_null($products)) {
            $this->product['product_name'] = $products->product_name;
            $this->product['product_desc'] = $products->product_desc;
            $this->product['price'] = $products->product_price_netto_vk;
            $this->product['tax'] = $products->product_mwst;
            $this->product['einheit'] = $products->product_einheit;
            $this->product['subtotal'] = $products->product_price_netto_vk * $this->product['qty'];
            $this->product_art_nr = true;

            return [
                'artNr' => $products->product_artnr,
                'ean' => $products->product_ean,
            ];
        }

        return [
            'artNr' => null,
            'ean' => null,
        ];
    }

    public function updatedProductDiscountPercent()
    {
        $discount = empty($this->product['discountPercent']) ? null : $this->product['discountPercent'];
        $this->product['discountPercent'] = $discount;
        $price = $this->product['price'] * $this->product['qty'];
        $rabatt = $this->product['discountPercent'] ?? 0;
        $discountPrice = $price * $rabatt / 100;
        $this->product['subtotal'] = $price - $discountPrice;

        return $discountPrice;
    }

    public function updatedProductQty()
    {
        $this->product['qty'] = (empty($this->product['qty']) ? 1 : $this->product['qty']);
        $subtotal = mwst($this->product['tax']) * $this->product['price'] * $this->product['qty'];
        if (! is_null($subtotal)) {
            $this->product['subtotal'] = $subtotal;
        }
        $this->updatedProductDiscountPercent();
    }

    public function store()
    {
        $validatedData = $this->validate();
        $lastArray = array_key_last($validatedData['invoiceDetails']);
        unset($validatedData['invoiceDetails'][$lastArray]);
        $this->mileage();
        $validatedData['order']['customer_id'] = $this->customer['id'];
        $validatedData['order']['vehicles_id'] = $this->fahrzeuge['vehicles_internal_vehicle_number'] ?? null;
        $validatedData['order']['invoice_notes_1'] = ! empty($this->order['invoice_notes_1']) ? nl2br(e($this->order['invoice_notes_1'])) : null;
        $validatedData['order']['invoice_notes_2'] = ! empty($this->order['invoice_notes_2']) ? nl2br(e($this->order['invoice_notes_2'])) : null;
        $order = Invoice::create($validatedData['order']);
        foreach ($validatedData['invoiceDetails'] as $invoiceDetail) {
            InvoiceDetails::create([
                'invoice_id' => $order->id,
                'product_id' => $invoiceDetail['product_id'],
                'qty' => $invoiceDetail['qty'],
                'price' => $invoiceDetail['price'],
                'discountPercent' => $invoiceDetail['discountPercent'],
                'discount' => $invoiceDetail['discount'],
                'subtotal' => $invoiceDetail['subtotal'],
            ]);
        }
        $this->protocol($order);
        session()->flash('success', 'Auftrag erstellt.');

        return redirect(route('backend.invoice.order.index-order'));
    }

    public function mileage()
    {
        $vehicle = Vehicles::where('id', $this->fahrzeuge['vehicles_internal_vehicle_number'])->first();
        if ($vehicle->vehicles_mileage !== $this->fahrzeuge['vehicles_mileage']) {
            $vehicle->update(['vehicles_mileage' => $this->fahrzeuge['vehicles_mileage']]);
            Mileage::create([
                'vehicle_id' => $vehicle->id,
                'mileage' => $this->fahrzeuge['vehicles_mileage'],
                'date' => date('Y-m-d'),
            ]);
        }
    }

    public function protocol($order)
    {
        Protocol::create([
            'protocol_type_nr' => $order->order_nr,
            'protocol_type' => $this->order['invoice_type'],
            'protocol_text' => 'Auftrag erstellt (Summe exkl. Steuer: '.number_format($order->invoice_subtotal, 2, ',', '.').'€)',
            'protocol_status' => 'created',
        ]);
    }

    public function updatedCustomerId($id)
    {
        $this->fahrzeugSelect = false;
        $this->fahrzeuge = null;
        $customer = Customer::find($id);
        if (! is_null($customer)) {
            $this->address = 'Kd-Nr. '.$customer->customer_kdnr.'<br> '.$customer->customer_salutation.' '.$customer->customer_firstname.' '.$customer->customer_lastname.'<br> '.$customer->customer_street.'<br> '.$customer->customer_post_code.' '.$customer->customer_location;
            $this->vehicles = $customer->vehicles;
        } else {
            $this->address = false;
            $this->customer = null;
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        $customers = Customer::all();
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
            $this->order['invoice_subtotal'] = number_format($subtotal, 2);
            $this->order['invoice_vat_19'] = number_format($total19, 2);
            $this->order['invoice_vat_7'] = number_format($total7, 2);
            $this->order['invoice_vat_at'] = number_format($totalAT, 2);
            $this->order['invoice_total'] = number_format($total, 2);
            $this->order['invoice_discount'] = number_format($discount, 2);
        }

        return view('livewire.backend.office.invoice.create-order', [
            'customers' => $customers,
            'subtotals' => $subtotal ?? 0,
            'total19' => $total19 ?? 0,
            'total7' => $total7 ?? 0,
            'totalAT' => $totalAT ?? 0,
            'total' => $total ?? 0,
            'discountTotal' => $discount ?? 0,
        ]);
    }
}
