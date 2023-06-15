<?php

namespace App\Http\Livewire\Backend\Vehicles;

use App\Models\Backend\Customers\Customer;
use App\Models\Backend\Vehicles\EmissionClass;
use App\Models\Backend\Vehicles\VehicleFurtherData;
use App\Models\Backend\Vehicles\Vehicles;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class VehicleCreate extends Component
{
    use WithFileUploads;

    public $fahrzeuge = [
        'vehicles_license_plate' => 'SÖM XX000',
        'vehicles_mileage' => null,
        'vehicles_class' => 7,
    ];

    public $furtherData = [
        'vehicles_seats' => 5,
        'vehicles_doors' => 3,
        'vehicles_sleeping_places' => 0,
        'vehicles_axles' => 2,
        'vehicles_number_of_gears' => 5,
        'vehicles_cylinder' => 4,
    ];

    public $customers = [
        'customer_id' => '',
        'customer_firstname' => '',
        'customer_lastname' => '',
        'customer_street' => '',
        'customer_post_code' => '',
        'customer_location' => '',
        'customer_kdtype' => 0,
    ];

    public $allCustomers;

    public $customerSearch = '1000';

    public $customerNew = false;

    public $customerEdit = true;

    public $emissions;

    public $age;

    public $image;

    public $vehicles_hu;

    protected $messages = [
        'fahrzeuge.vehicles_license_plate.required' => 'Kennzeichen muss ausgefüllt werden.',
        'fahrzeuge.vehicles_brand.required' => 'Bitte wähle einen Fahrzeughersteller aus.',
        'fahrzeuge.vehicles_model.required' => 'Bitte wähle dein Fahrzeug Model aus',
        'fahrzeuge.vehicles_type.required' => 'Bitte wähle deinen Fahrzeug Type aus',
        'fahrzeuge.vehicles_engine_code.required' => 'Bitte gib deinen Hubraum an P.1 im Fahrzeugschein',
        'fahrzeuge.vehicles_identification_number.required' => 'Bitte gib eine Fahrzeug-Identifizierungsnummer an E im Fahrzeugschein',
        'fahrzeuge.vehicles_identification_number.max' => 'Fz.-Ident.-Nr. darf maximal 17 Zeichen haben.',
        'fahrzeuge.vehicles_hsn.required' => 'Bitte gib deine HSN an 2.1 im Fahrzeugschein',
        'fahrzeuge.vehicles_hsn.max' => 'Die HSN darf nur 4 Zahlen enthalten',
        'fahrzeuge.vehicles_tsn.required' => 'Bitte gib deine TSN an 2.2 im Fahrzeugschein',
        'fahrzeuge.vehicles_tsn.max' => 'Die TSN darf maximal 9 Zeichen enthalten',
        'fahrzeuge.vehicles_hu.required' => 'Bitte gib den Termin für die nächste Hauptuntersuchung an',
        'fahrzeuge.vehicles_hu.date_format' => 'HU entspricht nicht dem gültigen Format (Monat Jahr).',
        'vehicles_hu.required' => 'Bitte gib den Termin für die nächste Hauptuntersuchung an',
        'vehicles_hu.date_format' => 'HU entspricht nicht dem gültigen Format (Monat Jahr).',
        'customers.customer_lastname.required' => 'Name muss ausgefüllt werden.',
        'customers.customer_firstname.required' => 'Vorname muss ausgefüllt werden.',
        'customers.customer_street.required' => 'Strasse muss ausgefüllt werden.',
        'customers.customer_post_code.required' => 'PLZ muss ausgefüllt werden.',
        'customers.customer_location.required' => 'Ort muss ausgefüllt werden.',
    ];

    public function rules()
    {
        if ($this->customers['customer_lastname'] === 'Barkasse') {
            $vorname = $this->customers['customer_firstname'] ? 'required' : 'nullable';
            $nachname = $this->customers['customer_lastname'] ? 'required' : 'nullable';
            $strasse = $this->customers['customer_street'] ? 'required' : 'nullable';
            $plz = $this->customers['customer_post_code'] ? 'required' : 'nullable';
            $location = $this->customers['customer_location'] ? 'required' : 'nullable';
        } elseif ($this->customers['customer_kdtype'] === 1) {
            $vorname = $this->customers['customer_firstname'] ? 'required' : 'nullable';
            $nachname = $this->customers['customer_lastname'] ? 'nullable' : 'required';
            $strasse = $this->customers['customer_street'] ? 'nullable' : 'required';
            $plz = $this->customers['customer_post_code'] ? 'nullable' : 'required';
            $location = $this->customers['customer_location'] ? 'nullable' : 'required';
        } else {
            $vorname = $this->customers['customer_firstname'] ? 'nullable' : 'required';
            $nachname = $this->customers['customer_lastname'] ? 'nullable' : 'required';
            $strasse = $this->customers['customer_street'] ? 'nullable' : 'required';
            $plz = $this->customers['customer_post_code'] ? 'nullable' : 'required';
            $location = $this->customers['customer_location'] ? 'nullable' : 'required';
        }

        return [
            'fahrzeuge.vehicles_internal_vehicle_number' => 'nullable',
            'fahrzeuge.vehicles_license_plate' => 'nullable',
            'fahrzeuge.vehicles_hsn' => 'required|max:4',
            'fahrzeuge.vehicles_tsn' => 'required|max:9',
            'fahrzeuge.vehicles_brand' => 'required',
            'fahrzeuge.vehicles_model' => 'required',
            'fahrzeuge.vehicles_type' => 'nullable',
            'fahrzeuge.vehicles_class' => 'nullable',
            'fahrzeuge.vehicles_category' => 'nullable',
            'fahrzeuge.vehicles_identification_number' => 'required|max:17',
            'fahrzeuge.vehicles_first_registration' => 'nullable',
            'fahrzeuge.vehicles_cubic_capacity' => 'nullable',
            'fahrzeuge.vehicles_hp' => 'nullable',
            'fahrzeuge.vehicles_kw' => 'nullable',
            'fahrzeuge.vehicles_mileage' => 'nullable',
            'fahrzeuge.vehicles_hu' => 'required',
            'vehicles_hu' => 'required',
            'fahrzeuge.vehicles_tire_1' => 'nullable',
            'fahrzeuge.vehicles_tire_2' => 'nullable',
            'fahrzeuge.vehicles_tpms' => 'nullable',
            'fahrzeuge.vehicles_engine_code' => 'nullable',
            'fahrzeuge.vehicles_fuel' => 'nullable',
            'fahrzeuge.vehicles_cat' => 'nullable',
            'fahrzeuge.vehicles_plaque' => 'nullable',
            'fahrzeuge.vehicles_emission_class' => 'nullable',
            'fahrzeuge.vehicles_transmission' => 'nullable',
            'fahrzeuge.vehicles_note' => 'nullable',

            'furtherData.vehicles_id' => 'nullable',
            'furtherData.vehicles_color' => 'nullable',
            'furtherData.vehicles_color_code' => 'nullable',
            'furtherData.vehicles_upholstery_type' => 'nullable',
            'furtherData.vehicles_upholstery_color' => 'nullable',
            'furtherData.vehicles_radio_code' => 'nullable',
            'furtherData.vehicles_key_number' => 'nullable',
            'furtherData.vehicles_seats' => 'nullable',
            'furtherData.vehicles_doors' => 'nullable',
            'furtherData.vehicles_sleeping_places' => 'nullable',
            'furtherData.vehicles_axles' => 'nullable',
            'furtherData.vehicles_number_of_gears' => 'nullable',
            'furtherData.vehicles_cylinder' => 'nullable',
            'furtherData.vehicles_curb_weight' => 'nullable',
            'furtherData.vehicles_payload' => 'nullable',
            'furtherData.vehicles_total_weight' => 'nullable',
            'furtherData.vehicles_length' => 'nullable',
            'furtherData.vehicles_broad' => 'nullable',
            'furtherData.vehicles_height' => 'nullable',

            'image' => 'nullable',

            'customers.customer_id' => 'nullable',
            'customers.customer_kdtype' => 'nullable',
            'customers.customer_firstname' => $vorname ?? 'required',
            'customers.customer_lastname' => $nachname ?? 'required',
            'customers.customer_street' => $strasse ?? 'required',
            'customers.customer_post_code' => $plz ?? 'required',
            'customers.customer_location' => $location ?? 'required',

            'customerSearch' => 'required|min:4',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedFahrzeugeVehiclesKw($field)
    {
        $this->fahrzeuge['vehicles_hp'] = kw_ps($field)['kw'];
    }

    public function updatedFahrzeugeVehiclesEmissionClass($field)
    {
        if (! is_null($field)) {
            $this->fahrzeuge['vehicles_cat'] = EmissionClass::where('id', $field)->first()->kat_id;
        }
    }

    public function mount()
    {
        $this->fahrzeuge['vehicles_internal_vehicle_number'] = $this->lastID() + 1;
        $this->fahrzeuge['vehicles_first_registration'] = Carbon::parse(now())->subYears(10)->format('Y-m-d');
        $this->vehicles_hu = Carbon::parse(now())->addYears(2)->format('Y-m');
        $this->emissions = EmissionClass::all();
    }

    public function lastID()
    {
        return Vehicles::latest()->withTrashed()->first()->id ?? 0;
    }

    public function updatedFahrzeugeVehiclesFirstRegistration()
    {
        $this->age = Carbon::parse($this->fahrzeuge['vehicles_first_registration'])->age;
    }

    public function updatedCustomerNew()
    {
        if ($this->customerNew) {
            $this->customerSearch = '1000';
            $this->updatedCustomerSearch($this->customerSearch);
        } else {
            $this->customers = [
                'customer_id' => '',
                'customer_firstname' => '',
                'customer_lastname' => '',
                'customer_street' => '',
                'customer_post_code' => '',
                'customer_location' => '',
                'customer_kdtype' => 0,
            ];
        }
    }

    public function updatedCustomerSearch($id)
    {
        $customer = Customer::whereLike(['customer_kdnr'], $id)->first();
        if (! is_null($customer)) {
            $this->customers['customer_id'] = $customer->id;
            $this->customers['customer_kdnr'] = $customer->customer_kdnr;
            $this->customers['customer_firstname'] = $customer->customer_firstname;
            $this->customers['customer_lastname'] = $customer->customer_lastname;
            $this->customers['customer_street'] = $customer->customer_street;
            $this->customers['customer_post_code'] = $customer->customer_post_code;
            $this->customers['customer_location'] = $customer->customer_location;
            $this->customers['customer_kdtype'] = $customer->customer_kdtype;
        } else {
            $this->customerNew = false;
            $this->customers = [
                'customer_id' => '',
                'customer_firstname' => '',
                'customer_lastname' => '',
                'customer_street' => '',
                'customer_post_code' => '',
                'customer_location' => '',
                'customer_kdtype' => 0,
            ];
        }
    }

    public function updatedFahrzeugeVehiclesTire1()
    {
        $this->fahrzeuge['vehicles_tire_2'] = $this->fahrzeuge['vehicles_tire_1'];
    }

    public function store()
    {
        $this->fahrzeuge['vehicles_license_plate'] = $this->fahrzeuge['vehicles_license_plate'] === 'SÖM XX000' ? null : $this->fahrzeuge['vehicles_license_plate'];
        $validatedData = $this->validate();
        $validatedData['fahrzeuge']['vehicles_hu'] = Carbon::parse($this->vehicles_hu)->endOfMonth()->format('Y-m-d');
        $fahrzeuge = Vehicles::create($validatedData['fahrzeuge']);
        $validatedData['furtherData']['vehicles_id'] = $fahrzeuge->id;
        VehicleFurtherData::create($validatedData['furtherData']);
        if ($this->customerNew) {
            $fahrzeuge->customers()->sync($validatedData['customers']['customer_id']);
        } else {
            $kunde = Customer::create($validatedData['customers']);
            $kunde->vehicles()->sync([$fahrzeuge->id]);
        }
        session()->flash('success', 'Das Fahrzeug wurde erfolgreich angelegt.');

        return redirect(route('backend.fahrzeuge.index'));
    }

    public function render()
    {
        /*if ($this->customerNew) {
            $this->customers = Customer::whereLike(['customer_kdnr'], $this->customerSearch)->first();
        }*/

        return view('livewire.backend.vehicles.vehicle-create');
    }
}
