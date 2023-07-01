<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: InvoiceEdit.php
 * User: ${USER}
 * Date: 23.${MONTH_NAME_FULL}.2023
 * Time: 06:16
 */

namespace App\Http\Livewire\Backend\Office\Order;

use App\Models\Admin\Settings\CompanySettings;
use App\Models\Backend\Customers\Customer;
use App\Models\Backend\Office\Order\OrderDetails;
use App\Models\Backend\Product\Products;
use App\Models\Backend\Vehicles\Vehicles;
use Livewire\Component;

class OrderEdit extends Component
{
    public $orders;

    public $customers;

    public $fahrzeuge;

    public $orderDetails = [];

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
            'orders.order_nr' => 'nullable',
            'orders.customer_id' => 'nullable',
            'orders.vehicles_id' => 'nullable',
            'orders.order_date' => 'required',
            'orders.order_due_date' => 'nullable',
            'orders.order_subtotal' => 'nullable',
            'orders.order_shipping' => 'nullable',
            'orders.order_discount' => 'nullable',
            //            'orders.order_discountTotal' => 'nullable',
            'orders.order_vat_19' => 'nullable',
            'orders.order_vat_7' => 'nullable',
            'orders.order_vat_at' => 'nullable',
            'orders.order_total' => 'nullable',
            'orders.order_notes_1' => 'nullable',
            'orders.order_notes_2' => 'nullable',
            'orders.order_type' => 'nullable',
            'orders.order_status' => 'nullable',
            'orders.order_external_service' => 'nullable',
            'orders.order_payment' => 'required',
            'orders.order_order_type' => 'required',
            'orders.order_clerk' => 'required',
            'orders.delivery_performance_date' => 'required',

            'orderDetails.*.id' => 'nullable',
            'orderDetails.*.order_id' => 'nullable',
            'orderDetails.*.product_id' => 'nullable',
            'orderDetails.*.qty' => 'nullable',
            'orderDetails.*.price' => 'nullable',
            'orderDetails.*.discountPercent' => 'nullable',
            'orderDetails.*.discount' => 'nullable',
            'orderDetails.*.subtotal' => 'nullable',
            'orderDetails.*.is_saved' => 'nullable',

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
            'customers.customer_net_order' => 'nullable',

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

    public function mount($auftraege)
    {
        $this->orders = $auftraege;
        $this->customers = Customer::find($auftraege->customer_id);
        $this->orders['order_clerk'] = auth()->user()->name;
        $this->fahrzeuge = Vehicles::find($auftraege->vehicles_id);
        $this->products = Products::all();
        $this->fahrzeuge['hu'] = dateMonthCarbon($this->fahrzeuge->vehicles_hu);
        $this->fahrzeuge['vehicles_first_registration'] = dateCarbon($this->fahrzeuge->vehicles_first_registration);
        $orderDetails = OrderDetails::where('order_id', '=', $auftraege->id)->with('product')->get();
        if ($orderDetails) {
            foreach ($orderDetails as $orderDetail) {
                $this->orderDetails[] = [
                    'id' => $orderDetail->id,
                    'product_id' => $orderDetail->product_id,
                    'product_artnr' => $orderDetail->product->product_artnr,
                    'product_name' => $orderDetail->product->product_name,
                    'product_desc' => $orderDetail->product->product_desc,
                    'einheit' => $orderDetail->product->product_einheit,
                    'tax' => $orderDetail->product->product_mwst,
                    'qty' => $orderDetail->qty,
                    'price' => $orderDetail->price,
                    'discountPercent' => $orderDetail->discountPercent,
                    'discount' => $orderDetail->discount,
                    'subtotal' => $orderDetail->subtotal,
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
        $validatedData['orders']['vehicles_id'] = $validatedData['fahrzeuge']['vehicles_internal_vehicle_number'];
        $order = $this->orders->update($validatedData['orders']);
        foreach ($validatedData['orderDetails'] as $key => $orderDetail) {
            OrderDetails::updateOrCreate(
                ['id' => $this->orderDetails[$key]['id']],
                [
                    'order_id' => $this->orders->id,
                    'product_id' => $orderDetail['product_id'],
                    'qty' => $orderDetail['qty'],
                    'price' => $orderDetail['price'],
                    'discountPercent' => $orderDetail['discountPercent'],
                    'discount' => $orderDetail['discount'],
                    'subtotal' => $orderDetail['subtotal'],
                ]);

        }
        session()->flash('success', 'Der Auftrag wurde geändert.');

        return redirect(route('backend.auftraege.index'));
    }

    public function addProduct()
    {
        foreach ($this->orderDetails as $key => $orderDetail) {
            if (! $orderDetail['is_saved']) {
                $this->addError('orderDetails.'.$key, 'Diese Zeile muss gespeichert werden, bevor eine neue erstellt werden kann.');

                return;
            }
        }

        $this->product_art_nr = null;
        $this->product = null;
        $this->product['qty'] = 1;
        $this->product['discount'] = null;
        $this->orderDetails[] = [
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
        foreach ($this->orderDetails as $key => $orderDetail) {
            if (! $orderDetail['is_saved']) {
                $this->addError('orderDetails.'.$key, 'Diese Zeile muss gespeichert werden, bevor eine andere bearbeitet werden kann');

                return;
            }
        }

        $this->orderDetails[$index]['is_saved'] = false;
        $this->product['id'] = $this->orderDetails[$index]['id'];
        $this->product['product_art_nr'] = $this->orderDetails[$index]['product_artnr'];
        $this->product['product_id'] = $this->orderDetails[$index]['product_id'];
        $this->product['product_name'] = $this->orderDetails[$index]['product_name'];
        $this->product['product_desc'] = $this->orderDetails[$index]['product_desc'];
        $this->product['qty'] = $this->orderDetails[$index]['qty'];
        $this->product['tax'] = $this->orderDetails[$index]['tax'];
        $this->product['einheit'] = $this->orderDetails[$index]['einheit'];
        $this->product['price'] = $this->orderDetails[$index]['price'];
        $this->product['discountPercent'] = $this->orderDetails[$index]['discountPercent'];
        $this->product['discount'] = $this->orderDetails[$index]['discount'];
        $this->product['subtotal'] = $this->orderDetails[$index]['subtotal'];
        $this->product_art_nr = true;
        if (! empty($this->orderDetails[$index]['product_artnr'])) {
            $produkt = Products::where('id', $this->orderDetails[$index]['product_id'])->first();
            $qty = $produkt->product_qty + $this->orderDetails[$index]['qty'];
            $produkt->update(['product_qty' => $qty]);
        }
    }

    public function saveProduct($index, $id)
    {
        $this->resetErrorBag();
        $artNr = $this->updatedProductProductArtnr();
        $produkt = $this->products->where('product_artnr', '=', $artNr)->first();
        $this->orderDetails[$index] = [
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
        if (! empty($this->orderDetails[$index]['product_artnr'])) {
            $produkt = Products::where('id', $this->orderDetails[$index]['product_id'])->first();
            $qty = $produkt->product_qty - $this->orderDetails[$index]['qty'];
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
        if (! empty($this->orderDetails[$index]['product_artnr'])) {
            $produkt = Products::where('id', $this->orderDetails[$index]['product_id'])->first();
            $qty = $produkt->product_qty + $this->orderDetails[$index]['qty'];
            $produkt->update(['product_qty' => $qty]);
        }
        OrderDetails::where('id', $this->orderDetails[$index]['id'])->first()->delete();
        unset($this->orderDetails[$index]);
        $this->orderDetails = array_values($this->orderDetails);
    }

    public function render()
    {
        $total19 = 0;
        $total7 = 0;
        $totalAT = 0;
        $subtotal = 0;
        $total = 0;
        $toPay = $this->orders['order_payment'] !== 'Barzahlung';
        $skonto = false;
        $discount = 0;

        foreach ($this->orderDetails as $orderDetail) {
            if ($orderDetail['is_saved'] && $orderDetail['subtotal'] && $orderDetail['qty']) {
                $subtotal += $orderDetail['subtotal'];
            }
            if ($orderDetail['is_saved'] && $orderDetail['subtotal'] && $orderDetail['qty'] && $orderDetail['tax'] == 19) {
                $subtotal19 = $orderDetail['subtotal'];
                $total19 += $subtotal19 * mwst($orderDetail['tax']) - $subtotal19;
            }
            if ($orderDetail['is_saved'] && $orderDetail['subtotal'] && $orderDetail['qty'] && $orderDetail['tax'] == 7) {
                $subtotal7 = $orderDetail['subtotal'];
                $total7 += $subtotal7 * mwst($orderDetail['tax']) - $subtotal7;
            }
            if ($orderDetail['is_saved'] && $orderDetail['subtotal'] && $orderDetail['qty'] && $orderDetail['tax'] == 20.9) {
                $subtotalAT = $orderDetail['subtotal'];
                $totalAT += $subtotalAT * mwst($orderDetail['tax']) - $subtotalAT;
            }
            if ($orderDetail['discount']) {
                $discount += $orderDetail['discount'];
            }
        }

        if ($this->orders['order_payment'] === 'Sofort Netto Kasse') {
            $total += $subtotal;
        } elseif ($this->orders['order_payment'] === '30 Tage / 2% Skonto') {
            $totalSkonto = $subtotal + $total19 + $total7 + $totalAT;
            $skonto = $totalSkonto * 2 / 100;
            $total += $subtotal + $total19 + $total7 + $totalAT;
        } else {
            $total += $subtotal + $total19 + $total7 + $totalAT;
        }

        if ($total) {
            $this->orders['order_subtotal'] = number_format($subtotal, 2);
            $this->orders['order_vat_19'] = number_format($total19, 2);
            $this->orders['order_vat_7'] = number_format($total7, 2);
            $this->orders['order_vat_at'] = number_format($totalAT, 2);
            $this->orders['order_total'] = number_format($total, 2);
            $this->orders['order_discount'] = number_format($discount, 2);
        }

        return view('livewire.backend.office.order.order-edit', [
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
