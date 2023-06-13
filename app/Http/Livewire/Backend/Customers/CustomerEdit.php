<?php

namespace App\Http\Livewire\Backend\Customers;

use Livewire\Component;

class CustomerEdit extends Component
{
    public $customers;

    public $kunden;

    public $data;

    public $selectAll;

    public $financialAccountingConditions;

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

    public function mount()
    {
        $this->customers = $this->kunden;
        $this->data = $this->kunden->dataProtection;
        $this->financialAccountingConditions = $this->kunden->financialAccountingConditions;
        $this->selectAll = $this->data['selectAll'];
    }

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
            'data.selectAll' => 'nullable',

            'financialAccountingConditions.conditions_discount_items' => 'nullable',
            'financialAccountingConditions.conditions_discount_labor_values' => 'nullable',
            'financialAccountingConditions.financial_terms_of_payment' => 'nullable',
            'financialAccountingConditions.financial_price_group' => 'nullable',
            'financialAccountingConditions.financial_debtor_number' => 'nullable',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function store()
    {
        $validatedData = $this->validate();
        $this->customers->update($validatedData['customers']);
        $this->data->update($validatedData['data']);
        $this->financialAccountingConditions->update($validatedData['financialAccountingConditions']);

        session()->flash('success', 'Kundendaten wurden geändert.');

        return redirect(route('backend.kunden.index'));
    }

    public function render()
    {
        $this->json = json();

        return view('livewire.backend.customers.customer-edit');
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
}
