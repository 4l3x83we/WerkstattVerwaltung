<?php

/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: InvoiceCreate.php
 * User: ${USER}
 * Date: 23.${MONTH_NAME_FULL}.2023
 * Time: 06:15
 */

namespace App\Http\Livewire\Backend\Office\Order;

use App\Models\Admin\Settings\CompanySettings;
use App\Models\Backend\Customers\Customer;
use App\Models\Backend\Office\Order\Order as OrderModel;
use App\Models\Backend\Office\Order\OrderDetails;
use App\Models\Backend\Product\Products;
use App\Models\Backend\Vehicles\Vehicles;
use Carbon\Carbon;
use Livewire\Component;

class OrderCreate extends Component
{
    public $orders = [
        'order_payment' => 'Barzahlung',
        'order_order_type' => 'keine Angaben',
    ];

    public $orderDetails;

    public $customers = [
        'customer_salutation' => 'Herr',
        'customer_kdtype' => 0,
        'customer_country' => 'DE',
    ];

    public $fahrzeuge;

    public $shipping;

    public $settings;

    public $changeKdType = false;

    public $customerNew = false;

    public $whenKdNr = false;

    public $vehicles;

    public $products;

    public $product;

    public $product_art_nr;

    public $edit = true;

    protected $messages = [];

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

            'shipping.customer_id' => 'nullable',
            'shipping.shipping_salutation' => 'nullable',
            'shipping.shipping_firstname' => 'nullable',
            'shipping.shipping_lastname' => 'nullable',
            'shipping.shipping_additive' => 'nullable',
            'shipping.shipping_street' => 'nullable',
            'shipping.shipping_country' => 'nullable',
            'shipping.shipping_post_code' => 'nullable',
            'shipping.shipping_location' => 'nullable',

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

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedCustomersCustomerKdtype()
    {
        if ($this->customers['customer_kdtype'] == 0) {
            $this->changeKdType = false;
            $this->customers['customer_salutation'] = null;
        } else {
            $this->changeKdType = true;
            $this->customers['customer_salutation'] = 'Firma';
        }
    }

    public function mount()
    {
        $this->settings = CompanySettings::latest()->first();
        $this->orders['order_nr'] = (numberRanges6(($this->lastID() + 1), $this->settings->order_prefix.'1'));
        $this->orders['order_date'] = Carbon::parse(now())->format('Y-m-d');
        $this->orders['delivery_performance_date'] = Carbon::parse(now())->format('Y-m-d');
        $this->orders['order_clerk'] = auth()->user()->name;
        $this->orderDetails = [];
        $this->products = Products::all();
        $this->updatedInvoicesInvoicePayment();
        //        $this->customers['customer_kdnr'] = (numberRanges(($this->lastCustomerID()), '1'));
    }

    public function lastID()
    {
        return OrderModel::withTrashed()->get()->last()->id ?? 0;
    }

    public function updatedInvoicesInvoicePayment()
    {
        if ($this->orders['order_payment'] === 'Barzahlung') {
            $this->orders['order_due_date'] = Carbon::parse($this->orders['order_date'])->format('Y-m-d');
        } else {
            $this->orders['order_due_date'] = Carbon::parse($this->orders['order_date'])->addDays(30)->format('Y-m-d');
        }
    }

    public function lastCustomerID()
    {
        return Customer::withTrashed()->get()->last()->id ?? 0;
    }

    public function updatedFahrzeugeVehiclesLicensePlate($id)
    {
        $fahrzeuge = Vehicles::where('vehicles_license_plate', $id)->with('customers')->first();
        if (! is_null($fahrzeuge)) {
            $this->fahrzeuge['vehicles_internal_vehicle_number'] = $fahrzeuge->vehicles_internal_vehicle_number;
            $this->extractedVehicles($fahrzeuge);
            $this->updatedCustomersCustomerKdnr($fahrzeuge->customers[0]->customer_kdnr);
            $this->customers['customer_kdnr'] = $fahrzeuge->customers[0]->customer_kdnr;
        } else {
            $this->fahrzeuge['vehicles_internal_vehicle_number'] = null;
            $this->extractedVehiclesNull();
            $this->updatedCustomersCustomerKdnr('');
            $this->customers['customer_kdnr'] = null;
        }
    }

    public function extractedVehicles(Vehicles $fahrzeuge): void
    {
        $this->fahrzeuge['vehicles_identification_number'] = $fahrzeuge->vehicles_identification_number;
        $this->fahrzeuge['vehicles_hsn'] = $fahrzeuge->vehicles_hsn;
        $this->fahrzeuge['vehicles_tsn'] = $fahrzeuge->vehicles_tsn;
        $this->fahrzeuge['vehicles_brand'] = $fahrzeuge->vehicles_brand;
        $this->fahrzeuge['vehicles_model'] = $fahrzeuge->vehicles_model.' '.$fahrzeuge->vehicles_type;
        $this->fahrzeuge['vehicles_first_registration'] = Carbon::parse($fahrzeuge->vehicles_first_registration)->format('Y-m-d');
        $this->fahrzeuge['hu'] = Carbon::parse($fahrzeuge->vehicles_hu)->format('Y-m');
        $this->fahrzeuge['vehicles_mileage'] = $fahrzeuge->vehicles_mileage;
    }

    public function updatedCustomersCustomerKdnr($id)
    {
        $customer = Customer::where('customer_kdnr', $id)->first();
        if (! is_null($customer)) {
            $this->orders['customer_id'] = $customer->id;
            $this->customers['customer_salutation'] = $customer->customer_salutation;
            $this->customers['customer_kdtype'] = $customer->customer_kdtype;
            $this->customers['customer_firstname'] = $customer->customer_firstname;
            $this->customers['customer_lastname'] = $customer->customer_lastname;
            $this->customers['customer_additive'] = $customer->customer_additive;
            $this->customers['customer_street'] = $customer->customer_street;
            $this->customers['customer_country'] = $customer->customer_country;
            $this->customers['customer_post_code'] = $customer->customer_post_code;
            $this->customers['customer_location'] = $customer->customer_location;
            $this->vehicles = Customer::find($customer->id)->vehicles;
            $this->whenKdNr = true;
        } else {
            $this->orders['customer_id'] = null;
            $this->customers['customer_salutation'] = 'Herr';
            $this->customers['customer_kdtype'] = 0;
            $this->customers['customer_firstname'] = null;
            $this->customers['customer_lastname'] = null;
            $this->customers['customer_additive'] = null;
            $this->customers['customer_street'] = null;
            $this->customers['customer_country'] = 'DE';
            $this->customers['customer_post_code'] = null;
            $this->customers['customer_location'] = null;
            $this->fahrzeuge['vehicles_internal_vehicle_number'] = '';
            $this->fahrzeuge['vehicles_license_plate'] = null;
            $this->extractedVehiclesNull();
            $this->whenKdNr = false;
        }
        if ($this->customers['customer_kdtype'] == 0) {
            $this->changeKdType = false;
            $this->customers['customer_salutation'] = $this->customers['customer_salutation'] ?? null;
        } else {
            $this->changeKdType = true;
            $this->customers['customer_salutation'] = 'Firma';
        }
    }

    public function extractedVehiclesNull(): void
    {
        $this->fahrzeuge['vehicles_identification_number'] = null;
        $this->fahrzeuge['vehicles_hsn'] = null;
        $this->fahrzeuge['vehicles_tsn'] = null;
        $this->fahrzeuge['vehicles_brand'] = null;
        $this->fahrzeuge['vehicles_model'] = null;
        $this->fahrzeuge['vehicles_first_registration'] = null;
        $this->fahrzeuge['hu'] = null;
        $this->fahrzeuge['vehicles_mileage'] = null;
    }

    public function updatedCustomersCustomerFirstname()
    {
        $customer = Customer::where('customer_firstname', $this->customers['customer_firstname'])->first();
        if (! is_null($customer)) {
            $this->customers = null;
            $this->fahrzeuge['vehicles_internal_vehicle_number'] = '';
            $this->fahrzeuge['vehicles_license_plate'] = null;
            $this->extractedVehiclesNull();
            $this->whenKdNr = false;
            $this->customers['customer_kdnr'] = $customer->customer_kdnr;
            $this->updatedCustomersCustomerKdnr($customer->customer_kdnr);
        }
    }

    public function updatedCustomersCustomerLastname()
    {
        $customer = Customer::where('customer_lastname', $this->customers['customer_lastname'])->first();
        if (! is_null($customer)) {
            $this->customers = null;
            $this->fahrzeuge['vehicles_internal_vehicle_number'] = '';
            $this->fahrzeuge['vehicles_license_plate'] = null;
            $this->extractedVehiclesNull();
            $this->whenKdNr = false;
            $this->customers['customer_kdnr'] = $customer->customer_kdnr;
            $this->updatedCustomersCustomerKdnr($customer->customer_kdnr);
        }
    }

    public function updatedFahrzeugeVehiclesInternalVehicleNumber($id)
    {
        $fahrzeuge = Vehicles::where('vehicles_internal_vehicle_number', $id)->with('customers')->first();
        if (! is_null($fahrzeuge)) {
            $this->fahrzeuge['vehicles_license_plate'] = $fahrzeuge->vehicles_license_plate;
            $this->extractedVehicles($fahrzeuge);
            $this->updatedCustomersCustomerKdnr($fahrzeuge->customers[0]->customer_kdnr);
            $this->customers['customer_kdnr'] = $fahrzeuge->customers[0]->customer_kdnr;
            $this->customers['vehicles_id'] = $fahrzeuge->id;
        } else {
            $this->fahrzeuge['vehicles_license_plate'] = null;
            $this->extractedVehiclesNull();
            $this->updatedCustomersCustomerKdnr('');
            $this->customers['customer_kdnr'] = null;
            $this->customers['vehicles_id'] = null;
        }
    }

    public function store()
    {
        $validatedData = $this->validate();
        $validatedData['orders']['vehicles_id'] = $validatedData['fahrzeuge']['vehicles_internal_vehicle_number'];
        $order = OrderModel::create($validatedData['orders']);
        foreach ($validatedData['orderDetails'] as $orderDetail) {
            OrderDetails::create([
                'order_id' => $order->id,
                'product_id' => $orderDetail['product_id'],
                'qty' => $orderDetail['qty'],
                'price' => $orderDetail['price'],
                'discountPercent' => $orderDetail['discountPercent'],
                'discount' => $orderDetail['discount'],
                'subtotal' => $orderDetail['subtotal'],
            ]);
            $product = Products::where('id', $orderDetail['product_id'])->first();
            $qty = $product->product_qty - $orderDetail['qty'];
            $product->update([
                'product_qty' => $qty,
            ]);
        }

        session()->flash('success', 'Der Auftrag wurde erstellt.');

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
    }

    public function saveProduct($index, $id = '')
    {
        $this->resetErrorBag();
        $artNr = $this->updatedProductProductArtnr();
        $produkt = $this->products->where('product_artnr', '=', $artNr)->first();
        $this->orderDetails[$index] = [
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
        $subtotal = mwst($this->product['tax']) * $this->product['price'] * $this->product['qty'];
        if (! is_null($subtotal)) {
            $this->product['subtotal'] = $subtotal;
        }
        $this->updatedProductDiscount();
    }

    public function removeProduct($index)
    {
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

        return view('livewire.backend.office.order.order-create', [
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
