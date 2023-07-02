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
use App\Models\Backend\Product\Products;
use App\Models\Backend\Vehicles\Vehicles;
use Livewire\Component;

class InvoiceEdit extends Component
{
    public $invoices;

    public $customers;

    public $fahrzeuge;

    public $invoiceDetails = [];

    public $changeKdType = false;

    public $whenKdNr = false;

    public $product_art_nr;

    public $settings;

    public $products;

    public $product;

    public $edit = true;

    public function rules()
    {
        $firstname = $this->customers['customer_salutation'] === 'Firma' ? 'nullable' : 'nullable';

        return [
            'invoices.invoice_nr' => 'nullable',
            'invoices.customer_id' => 'nullable',
            'invoices.vehicles_id' => 'nullable',
            'invoices.invoice_date' => 'required',
            'invoices.invoice_due_date' => 'nullable',
            'invoices.invoice_subtotal' => 'nullable',
            'invoices.invoice_shipping' => 'nullable',
            'invoices.invoice_discount' => 'nullable',
            //            'invoices.invoice_discountTotal' => 'nullable',
            'invoices.invoice_vat_19' => 'nullable',
            'invoices.invoice_vat_7' => 'nullable',
            'invoices.invoice_vat_at' => 'nullable',
            'invoices.invoice_total' => 'nullable',
            'invoices.invoice_notes_1' => 'nullable',
            'invoices.invoice_notes_2' => 'nullable',
            'invoices.invoice_type' => 'nullable',
            'invoices.invoice_status' => 'nullable',
            'invoices.invoice_external_service' => 'nullable',
            'invoices.invoice_payment' => 'required',
            'invoices.invoice_order_type' => 'required',
            'invoices.invoice_clerk' => 'required',
            'invoices.delivery_performance_date' => 'required',

            'invoiceDetails.*.id' => 'nullable',
            'invoiceDetails.*.invoice_id' => 'nullable',
            'invoiceDetails.*.product_id' => 'nullable',
            'invoiceDetails.*.qty' => 'nullable',
            'invoiceDetails.*.price' => 'nullable',
            'invoiceDetails.*.discountPercent' => 'nullable',
            'invoiceDetails.*.discount' => 'nullable',
            'invoiceDetails.*.subtotal' => 'nullable',
            'invoiceDetails.*.is_saved' => 'nullable',

            'customers.customer_kdnr' => 'required',
            'customers.customer_kdtype' => 'nullable',
            'customers.customer_salutation' => 'nullable',
            'customers.customer_firstname' => $firstname,
            'customers.customer_lastname' => 'nullable',
            'customers.customer_additive' => 'nullable',
            'customers.customer_street' => 'nullable',
            'customers.customer_country' => 'nullable',
            'customers.customer_post_code' => 'nullable',
            'customers.customer_location' => 'nullable',
            'customers.customer_phone' => 'nullable',
            'customers.customer_phone_business' => 'nullable',
            'customers.customer_fax' => 'nullable',
            'customers.customer_mobil_phone' => 'nullable',
            'customers.customer_email' => 'nullable',
            'customers.customer_website' => 'nullable',
            'customers.customer_notes' => 'nullable',
            'customers.customer_birthday' => 'nullable',
            'customers.customer_since' => 'nullable',
            'customers.customer_vat_number' => 'nullable',
            'customers.customer_show_notes_issues' => 'nullable',
            'customers.customer_show_notes_appointments' => 'nullable',
            'customers.customer_net_invoice' => 'nullable',

            /*'shipping.customer_id' => 'nullable',
            'shipping.shipping_salutation' => 'nullable',
            'shipping.shipping_firstname' => 'nullable',
            'shipping.shipping_lastname' => 'nullable',
            'shipping.shipping_additive' => 'nullable',
            'shipping.shipping_street' => 'nullable',
            'shipping.shipping_country' => 'nullable',
            'shipping.shipping_post_code' => 'nullable',
            'shipping.shipping_location' => 'nullable',*/

            'fahrzeuge.vehicles_internal_vehicle_number' => 'required',
            'fahrzeuge.vehicles_license_plate' => 'nullable',
            'fahrzeuge.vehicles_hsn' => 'nullable',
            'fahrzeuge.vehicles_tsn' => 'nullable',
            'fahrzeuge.vehicles_brand' => 'nullable',
            'fahrzeuge.vehicles_model' => 'nullable',
            'fahrzeuge.vehicles_type' => 'nullable',
            'fahrzeuge.vehicles_identification_number' => 'nullable',
            'fahrzeuge.vehicles_first_registration' => 'nullable',
            'fahrzeuge.vehicles_mileage' => 'nullable',
            'fahrzeuge.vehicles_hu' => 'nullable',
            'fahrzeuge.hu' => 'nullable',

            'product.id' => 'nullable',
            'product.product_art_nr' => 'nullable',
            'product.product_name' => 'nullable',
            'product.product_desc' => 'nullable',
            'product.price' => 'nullable',
            'product.subtotal' => 'nullable',
            'product.qty' => 'nullable',
            'product.tax' => 'nullable',
            'product.discountPercent' => 'nullable',
            'product.einheit' => 'nullable',
        ];
    }

    public function mount($rechnung)
    {
        $this->invoices = $rechnung;
        $this->customers = Customer::find($rechnung->customer_id);
        $this->invoices['invoice_clerk'] = auth()->user()->name;
        $this->fahrzeuge = Vehicles::find($rechnung->vehicles_id);
        $this->products = Products::all();
        $this->fahrzeuge['hu'] = dateMonthCarbon($this->fahrzeuge->vehicles_hu);
        $this->fahrzeuge['vehicles_first_registration'] = dateCarbon($this->fahrzeuge->vehicles_first_registration);
        $invoiceDetails = invoiceDetails::where('invoice_id', '=', $rechnung->id)->with('product')->get();
        if ($invoiceDetails) {
            foreach ($invoiceDetails as $invoiceDetail) {
                $this->invoiceDetails[] = [
                    'id' => $invoiceDetail->id,
                    'product_id' => $invoiceDetail->product_id,
                    'product_artnr' => $invoiceDetail->product->product_artnr,
                    'product_name' => $invoiceDetail->product->product_name,
                    'product_desc' => $invoiceDetail->product->product_desc,
                    'einheit' => $invoiceDetail->product->product_einheit,
                    'tax' => $invoiceDetail->product->product_mwst,
                    'qty' => $invoiceDetail->qty,
                    'price' => $invoiceDetail->price,
                    'discountPercent' => $invoiceDetail->discountPercent,
                    'discount' => $invoiceDetail->discount,
                    'subtotal' => $invoiceDetail->subtotal,
                    'is_saved' => true,
                ];
                $this->edit = false;
            }
        }
        $this->settings = CompanySettings::latest()->first();
    }

    public function store()
    {
        $validatedData = $this->validate();
        $validatedData['invoices']['vehicles_id'] = $validatedData['fahrzeuge']['vehicles_internal_vehicle_number'];
        $invoice = $this->invoices->update($validatedData['invoices']);
        foreach ($validatedData['invoiceDetails'] as $key => $invoiceDetail) {
            invoiceDetails::updateOrCreate(
                ['id' => $this->invoiceDetails[$key]['id']],
                [
                    'invoice_id' => $this->invoices->id,
                    'product_id' => $invoiceDetail['product_id'],
                    'qty' => $invoiceDetail['qty'],
                    'price' => $invoiceDetail['price'],
                    'discountPercent' => $invoiceDetail['discountPercent'],
                    'discount' => $invoiceDetail['discount'],
                    'subtotal' => $invoiceDetail['subtotal'],
                ]);

        }
        session()->flash('success', 'Die Rechnung wurde geändert.');

        return redirect(route('backend.rechnung.index'));
    }

    public function addProduct()
    {
        foreach ($this->invoiceDetails as $key => $invoiceDetail) {
            if (! $invoiceDetail['is_saved']) {
                $this->addError('invoiceDetails.'.$key, 'Diese Zeile muss gespeichert werden, bevor eine neue erstellt werden kann.');

                return;
            }
        }

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
            'discountPercent' => 0,
            'discount' => 0,
            'subtotal' => 0,
            'is_saved' => false,
        ];
    }

    public function editProduct($index)
    {
        foreach ($this->invoiceDetails as $key => $invoiceDetail) {
            if (! $invoiceDetail['is_saved']) {
                $this->addError('invoiceDetails.'.$key, 'Diese Zeile muss gespeichert werden, bevor eine andere bearbeitet werden kann');

                return;
            }
        }

        $this->invoiceDetails[$index]['is_saved'] = false;
        $this->product['id'] = $this->invoiceDetails[$index]['id'];
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
        $this->product_art_nr = true;
        if (! empty($this->invoiceDetails[$index]['product_artnr'])) {
            $produkt = Products::where('id', $this->invoiceDetails[$index]['product_id'])->first();
            $qty = $produkt->product_qty + $this->invoiceDetails[$index]['qty'];
            $produkt->update(['product_qty' => $qty]);
        }
    }

    public function saveProduct($index, $id)
    {
        $this->resetErrorBag();
        $artNr = $this->updatedProductProductArtnr();
        $produkt = $this->products->where('product_artnr', '=', $artNr)->first();
        $this->invoiceDetails[$index] = [
            'id' => $id,
            'product_id' => $produkt->id,
            'product_artnr' => $produkt->product_artnr,
            'product_name' => $produkt->product_name,
            'product_desc' => $produkt->product_desc,
            'qty' => $this->product['qty'],
            'price' => $produkt->product_price_netto_vk,
            'tax' => $produkt->product_mwst,
            'einheit' => $produkt->product_einheit,
            'discountPercent' => $this->product['discountPercent'] ?? 0,
            'discount' => $this->updatedProductDiscountPercent() ?? 0,
            'subtotal' => (! is_null($this->product['discountPercent'])) ? $produkt->product_price_netto_vk * $this->product['qty'] - $this->product['discount'] - $this->updatedProductDiscount() : $produkt->product_price_netto_vk * $this->product['qty'],
            'is_saved' => true,

        ];
        if (! empty($this->invoiceDetails[$index]['product_artnr'])) {
            $produkt = Products::where('id', $this->invoiceDetails[$index]['product_id'])->first();
            $qty = $produkt->product_qty - $this->invoiceDetails[$index]['qty'];
            $produkt->update(['product_qty' => $qty]);
        }
        $this->product = null;
    }

    public function updatedProductProductArtnr()
    {
        $products = Products::where('product_artnr', '=', $this->product['product_art_nr'])->first();
        if (! is_null($products)) {
            $this->product['product_name'] = $products->product_name;
            $this->product['product_desc'] = $products->product_desc;
            $this->product['price'] = $products->product_price_netto_vk;
            $this->product['tax'] = $products->product_mwst;
            $this->product['einheit'] = $products->product_einheit;
            $this->product['subtotal'] = $products->product_price_netto_vk * $this->product['qty'];
            $this->product_art_nr = true;

            return $products->product_artnr;
        }
        $this->product_art_nr = false;

        return null;
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
        $qty = empty($this->product['qty']) ? 1 : $this->product['qty'];
        $this->product['qty'] = $qty;
        $subtotal = $this->product['price'] * $this->product['qty'];
        if (! is_null($subtotal)) {
            $this->product['subtotal'] = $subtotal;
        }
        $this->updatedProductDiscount();
    }

    public function removeProduct($index)
    {
        if (! empty($this->invoiceDetails[$index]['product_artnr'])) {
            $produkt = Products::where('id', $this->invoiceDetails[$index]['product_id'])->first();
            $qty = $produkt->product_qty + $this->invoiceDetails[$index]['qty'];
            $produkt->update(['product_qty' => $qty]);
        }
        invoiceDetails::where('id', $this->invoiceDetails[$index]['id'])->first()->delete();
        unset($this->invoiceDetails[$index]);
        $this->invoiceDetails = array_values($this->invoiceDetails);
    }

    public function render()
    {
        $total19 = 0;
        $total7 = 0;
        $totalAT = 0;
        $subtotal = 0;
        $total = 0;
        $toPay = $this->invoices['invoice_payment'] !== 'Barzahlung';
        $skonto = false;
        $discount = 0;

        foreach ($this->invoiceDetails as $invoiceDetail) {
            if ($invoiceDetail['is_saved'] && $invoiceDetail['subtotal'] && $invoiceDetail['qty']) {
                $subtotal += $invoiceDetail['subtotal'];
            }
            if ($invoiceDetail['is_saved'] && $invoiceDetail['subtotal'] && $invoiceDetail['qty'] && $invoiceDetail['tax'] == 19) {
                $subtotal19 = $invoiceDetail['subtotal'];
                $total19 += $subtotal19 * mwst($invoiceDetail['tax']) - $subtotal19;
            }
            if ($invoiceDetail['is_saved'] && $invoiceDetail['subtotal'] && $invoiceDetail['qty'] && $invoiceDetail['tax'] == 7) {
                $subtotal7 = $invoiceDetail['subtotal'];
                $total7 += $subtotal7 * mwst($invoiceDetail['tax']) - $subtotal7;
            }
            if ($invoiceDetail['is_saved'] && $invoiceDetail['subtotal'] && $invoiceDetail['qty'] && $invoiceDetail['tax'] == 20.9) {
                $subtotalAT = $invoiceDetail['subtotal'];
                $totalAT += $subtotalAT * mwst($invoiceDetail['tax']) - $subtotalAT;
            }
            if ($invoiceDetail['discount']) {
                $discount += $invoiceDetail['discount'];
            }
        }

        if ($this->invoices['invoice_payment'] === 'Sofort Netto Kasse') {
            $total += $subtotal;
        } elseif ($this->invoices['invoice_payment'] === '30 Tage / 2% Skonto') {
            $totalSkonto = $subtotal + $total19 + $total7 + $totalAT;
            $skonto = $totalSkonto * 2 / 100;
            $total += $subtotal + $total19 + $total7 + $totalAT;
        } else {
            $total += $subtotal + $total19 + $total7 + $totalAT;
        }

        if ($total) {
            $this->invoices['invoice_subtotal'] = number_format($subtotal, 2);
            $this->invoices['invoice_vat_19'] = number_format($total19, 2);
            $this->invoices['invoice_vat_7'] = number_format($total7, 2);
            $this->invoices['invoice_vat_at'] = number_format($totalAT, 2);
            $this->invoices['invoice_total'] = number_format($total, 2);
            $this->invoices['invoice_discount'] = number_format($discount, 2);
        }

        return view('livewire.backend.office.invoice.invoice-edit', [
            'subtotals' => $subtotal ?? 0,
            'total19' => $total19 ?? 0,
            'total7' => $total7 ?? 0,
            'totalAT' => $totalAT ?? 0,
            'total' => $total ?? 0,
            'toPay' => $toPay ?? false,
            'skonto' => $skonto ?? false,
            'discountTotal' => $discount ?? 0,
        ]);
    }
}
