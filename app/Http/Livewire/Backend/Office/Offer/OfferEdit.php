<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: InvoiceEdit.php
 * User: ${USER}
 * Date: 23.${MONTH_NAME_FULL}.2023
 * Time: 06:16
 */

namespace App\Http\Livewire\Backend\Office\Offer;

use App\Models\Admin\Settings\CompanySettings;
use App\Models\Backend\Customers\Customer;
use App\Models\Backend\Office\Offer\OfferDetails;
use App\Models\Backend\Product\Products;
use App\Models\Backend\Vehicles\Vehicles;
use Livewire\Component;

class OfferEdit extends Component
{
    public $offers;

    public $customers;

    public $fahrzeuge;

    public $offerDetails = [];

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
            'offers.offer_nr' => 'nullable',
            'offers.customer_id' => 'nullable',
            'offers.vehicles_id' => 'nullable',
            'offers.offer_date' => 'required',
            'offers.offer_due_date' => 'nullable',
            'offers.offer_subtotal' => 'nullable',
            'offers.offer_shipping' => 'nullable',
            'offers.offer_discount' => 'nullable',
            //            'offers.offer_discountTotal' => 'nullable',
            'offers.offer_vat_19' => 'nullable',
            'offers.offer_vat_7' => 'nullable',
            'offers.offer_vat_at' => 'nullable',
            'offers.offer_total' => 'nullable',
            'offers.offer_notes_1' => 'nullable',
            'offers.offer_notes_2' => 'nullable',
            'offers.offer_type' => 'nullable',
            'offers.offer_status' => 'nullable',
            'offers.offer_external_service' => 'nullable',
            'offers.offer_payment' => 'required',
            'offers.offer_order_type' => 'required',
            'offers.offer_clerk' => 'required',
            'offers.delivery_performance_date' => 'required',

            'offerDetails.*.id' => 'nullable',
            'offerDetails.*.offer_id' => 'nullable',
            'offerDetails.*.product_id' => 'nullable',
            'offerDetails.*.qty' => 'nullable',
            'offerDetails.*.price' => 'nullable',
            'offerDetails.*.discountPercent' => 'nullable',
            'offerDetails.*.discount' => 'nullable',
            'offerDetails.*.subtotal' => 'nullable',
            'offerDetails.*.is_saved' => 'nullable',

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
            'customers.customer_net_offer' => 'nullable',

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

    public function mount($angebote)
    {
        $this->offers = $angebote;
        $this->customers = Customer::find($angebote->customer_id);
        $this->offers['offer_clerk'] = auth()->user()->name;
        $this->fahrzeuge = Vehicles::find($angebote->vehicles_id);
        $this->products = Products::all();
        $this->fahrzeuge['hu'] = dateMonthCarbon($this->fahrzeuge->vehicles_hu);
        $this->fahrzeuge['vehicles_first_registration'] = dateCarbon($this->fahrzeuge->vehicles_first_registration);
        $offerDetails = OfferDetails::where('offer_id', '=', $angebote->id)->with('product')->get();
        if ($offerDetails) {
            foreach ($offerDetails as $offerDetail) {
                $this->offerDetails[] = [
                    'id' => $offerDetail->id,
                    'product_id' => $offerDetail->product_id,
                    'product_artnr' => $offerDetail->product->product_artnr,
                    'product_name' => $offerDetail->product->product_name,
                    'product_desc' => $offerDetail->product->product_desc,
                    'einheit' => $offerDetail->product->product_einheit,
                    'tax' => $offerDetail->product->product_mwst,
                    'qty' => $offerDetail->qty,
                    'price' => $offerDetail->price,
                    'discountPercent' => $offerDetail->discountPercent,
                    'discount' => $offerDetail->discount,
                    'subtotal' => $offerDetail->subtotal,
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
        $validatedData['offers']['vehicles_id'] = $validatedData['fahrzeuge']['vehicles_internal_vehicle_number'];
        $offer = $this->offers->update($validatedData['offers']);
        foreach ($validatedData['offerDetails'] as $key => $offerDetail) {
            OfferDetails::updateOrCreate(
                ['id' => $this->offerDetails[$key]['id']],
                [
                    'offer_id' => $this->offers->id,
                    'product_id' => $offerDetail['product_id'],
                    'qty' => $offerDetail['qty'],
                    'price' => $offerDetail['price'],
                    'discountPercent' => $offerDetail['discountPercent'],
                    'discount' => $offerDetail['discount'],
                    'subtotal' => $offerDetail['subtotal'],
                ]);

        }
        session()->flash('success', 'Das Angebot wurde geändert.');

        return redirect(route('backend.angebote.index'));
    }

    public function addProduct()
    {
        foreach ($this->offerDetails as $key => $offerDetail) {
            if (! $offerDetail['is_saved']) {
                $this->addError('offerDetails.'.$key, 'Diese Zeile muss gespeichert werden, bevor eine neue erstellt werden kann.');

                return;
            }
        }

        $this->product_art_nr = null;
        $this->product = null;
        $this->product['qty'] = 1;
        $this->product['discount'] = null;
        $this->offerDetails[] = [
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
        foreach ($this->offerDetails as $key => $offerDetail) {
            if (! $offerDetail['is_saved']) {
                $this->addError('offerDetails.'.$key, 'Diese Zeile muss gespeichert werden, bevor eine andere bearbeitet werden kann');

                return;
            }
        }

        $this->offerDetails[$index]['is_saved'] = false;
        $this->product['id'] = $this->offerDetails[$index]['id'];
        $this->product['product_art_nr'] = $this->offerDetails[$index]['product_artnr'];
        $this->product['product_id'] = $this->offerDetails[$index]['product_id'];
        $this->product['product_name'] = $this->offerDetails[$index]['product_name'];
        $this->product['product_desc'] = $this->offerDetails[$index]['product_desc'];
        $this->product['qty'] = $this->offerDetails[$index]['qty'];
        $this->product['tax'] = $this->offerDetails[$index]['tax'];
        $this->product['einheit'] = $this->offerDetails[$index]['einheit'];
        $this->product['price'] = $this->offerDetails[$index]['price'];
        $this->product['discountPercent'] = $this->offerDetails[$index]['discountPercent'];
        $this->product['discount'] = $this->offerDetails[$index]['discount'];
        $this->product['subtotal'] = $this->offerDetails[$index]['subtotal'];
        $this->product_art_nr = true;
        if (! empty($this->offerDetails[$index]['product_artnr'])) {
            $produkt = Products::where('id', $this->offerDetails[$index]['product_id'])->first();
            $qty = $produkt->product_qty + $this->offerDetails[$index]['qty'];
            $produkt->update(['product_qty' => $qty]);
        }
    }

    public function saveProduct($index, $id)
    {
        $this->resetErrorBag();
        $artNr = $this->updatedProductProductArtnr();
        $produkt = $this->products->where('product_artnr', '=', $artNr)->first();
        $this->offerDetails[$index] = [
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
        if (! empty($this->offerDetails[$index]['product_artnr'])) {
            $produkt = Products::where('id', $this->offerDetails[$index]['product_id'])->first();
            $qty = $produkt->product_qty - $this->offerDetails[$index]['qty'];
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
        if (! empty($this->offerDetails[$index]['product_artnr'])) {
            $produkt = Products::where('id', $this->offerDetails[$index]['product_id'])->first();
            $qty = $produkt->product_qty + $this->offerDetails[$index]['qty'];
            $produkt->update(['product_qty' => $qty]);
        }
        OfferDetails::where('id', $this->offerDetails[$index]['id'])->first()->delete();
        unset($this->offerDetails[$index]);
        $this->offerDetails = array_values($this->offerDetails);
    }

    public function render()
    {
        $total19 = 0;
        $total7 = 0;
        $totalAT = 0;
        $subtotal = 0;
        $total = 0;
        $toPay = $this->offers['offer_payment'] !== 'Barzahlung';
        $skonto = false;
        $discount = 0;

        foreach ($this->offerDetails as $offerDetail) {
            if ($offerDetail['is_saved'] && $offerDetail['subtotal'] && $offerDetail['qty']) {
                $subtotal += $offerDetail['subtotal'];
            }
            if ($offerDetail['is_saved'] && $offerDetail['subtotal'] && $offerDetail['qty'] && $offerDetail['tax'] == 19) {
                $subtotal19 = $offerDetail['subtotal'];
                $total19 += $subtotal19 * mwst($offerDetail['tax']) - $subtotal19;
            }
            if ($offerDetail['is_saved'] && $offerDetail['subtotal'] && $offerDetail['qty'] && $offerDetail['tax'] == 7) {
                $subtotal7 = $offerDetail['subtotal'];
                $total7 += $subtotal7 * mwst($offerDetail['tax']) - $subtotal7;
            }
            if ($offerDetail['is_saved'] && $offerDetail['subtotal'] && $offerDetail['qty'] && $offerDetail['tax'] == 20.9) {
                $subtotalAT = $offerDetail['subtotal'];
                $totalAT += $subtotalAT * mwst($offerDetail['tax']) - $subtotalAT;
            }
            if ($offerDetail['discount']) {
                $discount += $offerDetail['discount'];
            }
        }

        if ($this->offers['offer_payment'] === 'Sofort Netto Kasse') {
            $total += $subtotal;
        } elseif ($this->offers['offer_payment'] === '30 Tage / 2% Skonto') {
            $totalSkonto = $subtotal + $total19 + $total7 + $totalAT;
            $skonto = $totalSkonto * 2 / 100;
            $total += $subtotal + $total19 + $total7 + $totalAT;
        } else {
            $total += $subtotal + $total19 + $total7 + $totalAT;
        }

        if ($total) {
            $this->offers['offer_subtotal'] = number_format($subtotal, 2);
            $this->offers['offer_vat_19'] = number_format($total19, 2);
            $this->offers['offer_vat_7'] = number_format($total7, 2);
            $this->offers['offer_vat_at'] = number_format($totalAT, 2);
            $this->offers['offer_total'] = number_format($total, 2);
            $this->offers['offer_discount'] = number_format($discount, 2);
        }

        return view('livewire.backend.office.offer.offer-edit', [
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
