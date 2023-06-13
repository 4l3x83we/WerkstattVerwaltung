<?php

namespace App\Http\Livewire\Backend\Customers;

use App\Models\Backend\Customers\Customer;
use App\Models\Backend\Customers\DataProtection;
use App\Models\Backend\Customers\FinancialAccountingCondition;
use App\Models\Backend\Customers\Shipping;
use Carbon\Carbon;
use Livewire\Component;

class CustomerCreate extends Component
{
    public $customers = [
        'customer_salutation' => 'Herr',
        'customer_country' => 'DE',
        'customer_net_invoice' => false,
        'customer_show_notes_issues' => false,
        'customer_show_notes_appointments' => false,
    ];

    public $data = [
        'letters' => false,
        'phone' => false,
        'fax' => false,
        'mobile_phone' => false,
        'text_message' => false,
        'whatsapp' => false,
        'email' => false,
    ];

    public $financialAccountingConditions = [
        'financial_terms_of_payment' => 'Barzahlung',
        'financial_price_group' => 'Normalpreis',
        'conditions_discount_items' => 0.00,
        'conditions_discount_labor_values' => 0.00,
    ];

    public $shippings;

    public $json;

    public $selectAll;

    public $changeKdType = false;

    protected $messages = [
        'customers.customer_salutation.required' => 'Anrede muss ausgewählt werden.',
        'customers.customer_firstname.required' => 'Vorname muss ausgefüllt werden.',
        'customers.customer_lastname.required' => 'Nachname/Firma muss ausgefüllt werden.',
        'customers.customer_street.required' => 'Straße muss ausgefüllt werden.',
        'customers.customer_country.required' => 'Land muss ausgefüllt werden.',
        'customers.customer_post_code.required' => 'Postleitzahl muss ausgefüllt werden.',
        'customers.customer_post_code.min' => 'Postleitzahl muss mindestens 5 Zeichen lang sein.',
        'customers.customer_post_code.max' => 'Postleitzahl darf maximal 5 Zeichen haben.',
        'customers.customer_post_code.numeric' => 'Postleitzahl muss eine Zahl sein.',
        'customers.customer_location.required' => 'Wohnort muss ausgefüllt werden.',
        'data.issued_on.required' => 'Erteilt am muss ausgefüllt werden.',
    ];

    public function rules()
    {
        $firstname = $this->customers['customer_salutation'] === 'Firma' ? 'nullable' : 'required';

        return [
            'customers.customer_kdnr' => 'nullable',
            'customers.customer_kdtype' => 'nullable',
            'customers.customer_salutation' => 'nullable',
            'customers.customer_firstname' => $firstname,
            'customers.customer_lastname' => 'required',
            'customers.customer_additive' => 'nullable',
            'customers.customer_street' => 'required',
            'customers.customer_country' => 'required',
            'customers.customer_post_code' => 'required|numeric',
            'customers.customer_location' => 'required',
            'customers.customer_phone' => 'nullable',
            'customers.customer_phone_business' => 'nullable',
            'customers.customer_fax' => 'nullable',
            'customers.customer_mobil_phone' => 'nullable',
            'customers.customer_email' => 'nullable|email',
            'customers.customer_website' => 'nullable',
            'customers.customer_notes' => 'nullable',
            'customers.customer_birthday' => 'nullable',
            'customers.customer_since' => 'nullable',
            'customers.customer_vat_number' => 'nullable',
            'customers.customer_show_notes_issues' => 'nullable',
            'customers.customer_show_notes_appointments' => 'nullable',
            'customers.customer_net_invoice' => 'nullable',

            'data.issued_on' => 'required',
            'data.letters' => 'nullable',
            'data.phone' => 'nullable',
            'data.fax' => 'nullable',
            'data.mobile_phone' => 'nullable',
            'data.text_message' => 'nullable',
            'data.whatsapp' => 'nullable',
            'data.email' => 'nullable',

            'financialAccountingConditions.conditions_discount_items' => 'nullable',
            'financialAccountingConditions.conditions_discount_labor_values' => 'nullable',
            'financialAccountingConditions.financial_terms_of_payment' => 'nullable',
            'financialAccountingConditions.financial_price_group' => 'nullable',
            'financialAccountingConditions.financial_debtor_number' => 'nullable',

            'shippings.shipping_salutation' => 'nullable',
            'shippings.shipping_firstname' => 'nullable',
            'shippings.shipping_lastname' => 'nullable',
            'shippings.shipping_additive' => 'nullable',
            'shippings.shipping_street' => 'nullable',
            'shippings.shipping_country' => 'nullable',
            'shippings.shipping_post_code' => 'nullable',
            'shippings.shipping_location' => 'nullable',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->data['letters'] = true;
            $this->data['phone'] = true;
            $this->data['fax'] = true;
            $this->data['mobile_phone'] = true;
            $this->data['text_message'] = true;
            $this->data['whatsapp'] = true;
            $this->data['email'] = true;
        } elseif (! $value) {
            $this->data['letters'] = false;
            $this->data['phone'] = false;
            $this->data['fax'] = false;
            $this->data['mobile_phone'] = false;
            $this->data['text_message'] = false;
            $this->data['whatsapp'] = false;
            $this->data['email'] = false;
        }
    }

    public function mount()
    {
        $this->customers['customer_kdnr'] = (numberRanges(($this->lastID() + 1), '1'));
        $this->financialAccountingConditions['financial_debtor_number'] = $this->customers['customer_kdnr'];
        $this->customers['customer_kdtype'] = false;
        $this->customers['customer_since'] = Carbon::parse(now())->format('d.m.Y');
    }

    public function lastID()
    {
        return Customer::latest()->withTrashed()->first()->id;
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

    public function store()
    {
        $validatedData = $this->validate();
        $validatedData['customers']['customer_since'] = Carbon::parse(now())->format('Y-m-d');
        $customer = Customer::create($validatedData['customers']);
        Shipping::create([
            'customer_id' => $customer->id,
            'shipping_salutation' => $customer->customer_salutation ?? null,
            'shipping_firstname' => $customer->customer_firstname ?? null,
            'shipping_lastname' => $customer->customer_lastname ?? null,
            'shipping_additive' => $customer->customer_additive ?? null,
            'shipping_street' => $customer->customer_street ?? null,
            'shipping_country' => $customer->customer_country ?? null,
            'shipping_post_code' => $customer->customer_post_code ?? null,
            'shipping_location' => $customer->customer_location ?? null,
        ]);
        $validatedData['financialAccountingConditions']['customer_id'] = $customer->id;
        $validatedData['data']['customer_id'] = $customer->id;
        FinancialAccountingCondition::create($validatedData['financialAccountingConditions']);
        DataProtection::create($validatedData['data']);

        session()->flash('success', 'Kunde wurde angelegt.');

        return redirect(route('backend.kunden.index'));
    }

    public function render()
    {
        $this->json = json();
        $this->data['issued_on'] = Carbon::parse(now())->format('Y-m-d');

        return view('livewire.backend.customers.customer-create');
    }
}
