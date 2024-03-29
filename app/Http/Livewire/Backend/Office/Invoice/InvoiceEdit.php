<?php

/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: InvoiceEdit.php
 * User: ${USER}
 * Date: 23.${MONTH_NAME_FULL}.2023
 * Time: 06:16
 */

namespace App\Http\Livewire\Backend\Office\Invoice;

use App\Models\Admin\Settings\CompanySettings;
use App\Models\Backend\Customers\Customer;
use App\Models\Backend\Office\Invoice\invoiceDetails;
use App\Models\Backend\Office\Protocol;
use App\Models\Backend\Product\Products;
use App\Models\Backend\Vehicles\Mileage;
use App\Models\Backend\Vehicles\Vehicles;
use Carbon\Carbon;
use Livewire\Component;

class InvoiceEdit extends Component
{
    public $offen;

    public $invoiceDetails = [];

    public $customer;

    public $address = false;

    public $vehicles = [];

    public $fahrzeuge;

    public $fahrzeugSelect = false;

    public $product_art_nr = false;

    public $product;

    public $invoice_oldTotal;

    public $edit = true;

    protected $messages = [
        'customer.id' => 'Kundennummer muss ausgewählt werden.',
        'fahrzeuge.vehicles_internal_vehicle_number' => 'Fahrzeug muss ausgewählt werden.',
    ];

    public function rules()
    {
        return [
            'customer.id' => 'required',
            'customer.customer_kdnr' => 'nullable',

            'offen.customer_id' => 'nullable',
            'offen.invoice_nr' => 'nullable',
            'offen.invoice_date' => 'nullable',
            'offen.invoice_notes_1' => 'nullable',
            'offen.invoice_notes_2' => 'nullable',
            'offen.delivery_performance_date' => 'nullable',
            'offen.invoice_clerk' => 'nullable',
            'offen.invoice_subtotal' => 'nullable',
            'offen.invoice_vat_19' => 'nullable',
            'offen.invoice_vat_7' => 'nullable',
            'offen.invoice_vat_at' => 'nullable',
            'offen.invoice_total' => 'nullable',
            'offen.invoice_discount' => 'nullable',
            'offen.invoice_type' => 'nullable',
            'offen.invoice_status' => 'nullable',

            'fahrzeuge.vehicles_internal_vehicle_number' => 'required',
            'fahrzeuge.vehicles_mileage' => 'nullable',

            'vehicles.vehicles_license_plate' => 'nullable',
            'vehicles.vehicles_brand' => 'nullable',
            'vehicles.vehicles_model' => 'nullable',
            'vehicles.vehicles_type' => 'nullable',
            'vehicles.vehicles_first_registration' => 'nullable',

            'invoiceDetails.*.invoice_id' => 'nullable',
            'invoiceDetails.*.product_id' => 'nullable',
            'invoiceDetails.*.product_art_nr' => 'nullable',
            'invoiceDetails.*.product_name' => 'nullable',
            'invoiceDetails.*.product_desc' => 'nullable',
            'invoiceDetails.*.qty' => 'nullable',
            'invoiceDetails.*.tax' => 'nullable',
            'invoiceDetails.*.price' => 'nullable',
            'invoiceDetails.*.discountPercent' => 'nullable',
            'invoiceDetails.*.discount' => 'nullable',
            'invoiceDetails.*.subtotal' => 'nullable',
            'invoiceDetails.*.is_saved' => 'nullable',
        ];
    }

    public function mount($offen)
    {
        $this->settings = CompanySettings::latest()->first();
        $this->updatedCustomerId($offen->customer_id);
        $this->updatedFahrzeugeVehiclesInternalVehicleNumber($offen->vehicles_id);
        $invoiceDetails = $offen->invoiceDetail;
        if ($invoiceDetails) {
            foreach ($invoiceDetails as $invoiceDetail) {
                $this->invoiceDetails[] = [
                    'invoice_id' => $invoiceDetail->id,
                    'product_id' => $invoiceDetail->product_id,
                    'product_art_nr' => $invoiceDetail->product_art_nr,
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
        $this->addProduct();
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

    public function addProduct()
    {
        $this->product_art_nr = null;
        $this->product = null;
        $this->product['qty'] = 1;
        $this->product['discount'] = null;
        $this->product['product_desc'] = null;
        $this->product['tax'] = 19;
        $this->invoiceDetails[] = [
            'product_id' => '',
            'product_art_nr' => '',
            'product_name' => '',
            'product_desc' => '',
            'qty' => 1,
            'tax' => 19,
            'price' => 0,
            'discountPercent' => null,
            'discount' => 0,
            'subtotal' => 0,
            'is_saved' => false,
        ];
    }

    public function store()
    {
        $validatedData = $this->validate();
        $lastArray = array_key_last($validatedData['invoiceDetails']);
        unset($validatedData['invoiceDetails'][$lastArray]);
        $this->mileage();
        $validatedData['order']['customer_id'] = $this->customer['id'];
        $validatedData['order']['vehicles_id'] = $this->fahrzeuge['vehicles_internal_vehicle_number'] ?? null;
        $validatedData['order']['invoice_notes_1'] = ! empty($this->offen['invoice_notes_1']) ? nl2br(e($this->offen['invoice_notes_1'])) : null;
        $validatedData['order']['invoice_notes_2'] = ! empty($this->offen['invoice_notes_2']) ? nl2br(e($this->offen['invoice_notes_2'])) : null;
        $this->offen->update($validatedData['order']);
        $this->offen->nr = $this->offen->id;
        foreach ($validatedData['invoiceDetails'] as $key => $invoiceDetail) {
            InvoiceDetails::updateOrCreate(
                ['invoice_id' => $this->invoiceDetails[$key]['invoice_id']],
                [
                    'invoice_id' => $this->offen->id,
                    'product_id' => $invoiceDetail['product_id'],
                    'product_art_nr' => $invoiceDetail['product_art_nr'],
                    'product_name' => $invoiceDetail['product_name'],
                    'product_desc' => $invoiceDetail['product_desc'],
                    'qty' => $invoiceDetail['qty'],
                    'tax' => $invoiceDetail['tax'],
                    'price' => $invoiceDetail['price'],
                    'discountPercent' => $invoiceDetail['discountPercent'],
                    'discount' => $invoiceDetail['discount'],
                    'subtotal' => $invoiceDetail['subtotal'],
                ]
            );
            $this->offen->history($this->offen, $invoiceDetail);
        }
        $invoice = [
            'protocol_text' => 'Bearbeitet (Summe exkl. Steuer: '.number_format($this->offen->invoice_subtotal, 2, ',', '.').'€)',
            'protocol_status' => 'edited',
        ];
        $this->protocol($this->offen);
        session()->flash('success', 'Rechnung wurde geändert.');

        return redirect(route('backend.invoice.offen.index'));
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

    public function protocol($offen)
    {
        if ($this->invoice_oldTotal !== $offen->invoice_total) {
            Protocol::create([
                'protocol_type_nr' => $offen->id,
                'protocol_type' => $this->offen['invoice_type'],
                'protocol_text' => 'Bearbeitet (Summe exkl. Steuer: '.number_format($offen->invoice_subtotal, 2, ',', '.').'€)',
                'protocol_status' => 'edited',
            ]);
        }
    }

    public function editProduct($index)
    {
        $lastArray = array_key_last($this->invoiceDetails);
        $this->removeProduct($lastArray);
        $this->product_art_nr = true;
        $this->invoiceDetails[$index]['is_saved'] = false;
        $this->product['invoice_id'] = $this->invoiceDetails[$index]['invoice_id'];
        $this->product['product_art_nr'] = $this->invoiceDetails[$index]['product_art_nr'];
        $this->product['product_id'] = $this->invoiceDetails[$index]['product_id'];
        $this->product['product_name'] = $this->invoiceDetails[$index]['product_name'];
        $this->product['product_desc'] = $this->invoiceDetails[$index]['product_desc'];
        $this->product['qty'] = $this->invoiceDetails[$index]['qty'];
        $this->product['tax'] = $this->invoiceDetails[$index]['tax'];
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
            'invoice_id' => $this->offen->id,
            'product_id' => $produkt->id ?? null,
            'product_art_nr' => $produkt->product_artnr ?? $this->product['product_art_nr'],
            'product_name' => $produkt->product_name ?? $this->product['product_name'],
            'product_desc' => $produkt->product_desc ?? $this->product['product_desc'],
            'qty' => $this->product['qty'],
            'price' => $produkt->product_price_netto_vk ?? $this->product['price'],
            'tax' => $produkt->product_mwst ?? $this->product['tax'],
            'discountPercent' => $this->product['discountPercent'] ?? null,
            'discount' => $this->updatedProductDiscountPercent() ?? null,
            'subtotal' => (! is_null($this->product['discountPercent'])) ? $produkt->product_price_netto_vk ?? $this->product['price'] * $this->product['qty'] - $this->product['discount'] : $produkt->product_price_netto_vk ?? $this->product['price'] * $this->product['qty'],
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
            $this->product['product_art_nr'] = $products->product_artnr;
            $this->product['product_name'] = $products->product_name;
            $this->product['product_desc'] = $products->product_desc;
            $this->product['price'] = number_format($products->product_price_netto_vk, 2);
            $this->product['tax'] = $products->product_mwst;
            $this->product['subtotal'] = number_format($products->product_price_netto_vk * $this->product['qty'], 2);
            $this->product_art_nr = true;

            return [
                'artNr' => $products->product_art_nr,
                'ean' => $products->product_ean,
            ];
        }
        $this->product_art_nr = true;

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
        $subtotal = number_format(mwst($this->product['tax'] ?? 19) * $this->product['price'] * $this->product['qty'], 2);
        if (! is_null($subtotal)) {
            $this->product['subtotal'] = $subtotal;
        }
        $this->updatedProductDiscountPercent();
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
            $this->offen['invoice_subtotal'] = number_format($subtotal, 2);
            $this->offen['invoice_vat_19'] = number_format($total19, 2);
            $this->offen['invoice_vat_7'] = number_format($total7, 2);
            $this->offen['invoice_vat_at'] = number_format($totalAT, 2);
            $this->offen['invoice_total'] = number_format($total, 2);
            $this->offen['invoice_discount'] = number_format($discount, 2);
        }

        $protocols = Protocol::where('protocol_type_nr', '=', $this->offen->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('livewire.backend.office.invoice.invoice-edit', [
            'customers' => $customers,
            'subtotals' => $subtotal ?? 0,
            'total19' => $total19 ?? 0,
            'total7' => $total7 ?? 0,
            'totalAT' => $totalAT ?? 0,
            'total' => $total ?? 0,
            'discountTotal' => $discount ?? 0,
            'protocols' => $protocols,
            'mwsts' => $this->mwstWerte(),
        ]);
    }

    public function mwstWerte()
    {
        $tax = CompanySettings::select(['tax_rate_full', 'tax_rate_reduced', 'tax_rate_free', 'tax_rate_core'])->latest()->first();

        return [
            [
                'wert' => $tax->tax_rate_full,
                'name' => 'volle MwSt',
            ],
            [
                'wert' => $tax->tax_rate_reduced,
                'name' => 'verm. MwSt',
            ],
            [
                'wert' => $tax->tax_rate_free,
                'name' => 'MwSt frei',
            ],
            [
                'wert' => $tax->tax_rate_core,
                'name' => 'AT.-MwSt',
            ],
        ];
    }
}
