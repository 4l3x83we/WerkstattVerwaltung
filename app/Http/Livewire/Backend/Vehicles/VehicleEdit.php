<?php

namespace App\Http\Livewire\Backend\Vehicles;

use App\Models\Backend\Customers\Customer;
use App\Models\Backend\Vehicles\EmissionClass;
use App\Models\Backend\Vehicles\VehicleFurtherData;
use App\Models\Backend\Vehicles\Vehicles_Hersteller_Model;
use Carbon\Carbon;
use Livewire\Component;

class VehicleEdit extends Component
{
    public $fahrzeuge;

    public $customers = [
        'id' => '',
        'customer_kdnr' => '',
        'customer_firstname' => '',
        'customer_lastname' => '',
        'customer_street' => '',
        'customer_post_code' => '',
        'customer_location' => '',
        'customer_kdtype' => 0,
    ];

    public $allCustomers;

    public $customerSearch = '1000';

    public $showFirma = true;

    public $customerNew = true;

    public $customerEdit = false;

    public $emissions;

    public $furtherData;

    public $image;

    public $age;

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

            'customers.id' => 'nullable',
            'customers.customer_kdtype' => 'nullable',
            'customers.customer_kdnr' => 'nullable',
            /*'customers.customer_firstname' => $vorname ?? 'required',
            'customers.customer_lastname' => $nachname ?? 'required',
            'customers.customer_street' => $strasse ?? 'required',
            'customers.customer_post_code' => $plz ?? 'required',
            'customers.customer_location' => $location ?? 'required',*/
            'customers.customer_firstname' => 'nullable',
            'customers.customer_lastname' => 'nullable',
            'customers.customer_street' => 'nullable',
            'customers.customer_post_code' => 'nullable',
            'customers.customer_location' => 'nullable',

            'customerSearch' => 'required|min:4',
        ];
    }

    public function mount()
    {
        $fahrzeuge = $this->fahrzeuge;
        $this->fahrzeuge = $fahrzeuge;
        $this->vehicles_hu = Carbon::parse($fahrzeuge['vehicles_hu'])->format('Y-m');
        $this->emissions = EmissionClass::all();
        $this->updatedFahrzeugeVehiclesFirstRegistration();
        $this->customers = $fahrzeuge->customers->first();
        $this->furtherData = VehicleFurtherData::where('vehicles_id', $fahrzeuge->id)->first();
    }

    public function updatedFahrzeugeVehiclesFirstRegistration()
    {
        $this->age = Carbon::parse($this->fahrzeuge['vehicles_first_registration'])->age;
    }

    public function updatedFahrzeugeVehiclesTsn()
    {
        $model = Vehicles_Hersteller_Model::where('vhm_hsn', '=', $this->fahrzeuge['vehicles_hsn'])->where('vhm_tsn', '=', $this->fahrzeuge['vehicles_tsn'])->first();
        if (! is_null($model)) {
            $this->fahrzeuge['vehicles_model'] = $model->vhm_model_name;
            $this->fahrzeuge['vehicles_type'] = $model->vhm_typ;
            $this->fahrzeuge['vehicles_cubic_capacity'] = $model->vhm_hubraum;
            $this->fahrzeuge['vehicles_hp'] = $model->vhm_ps;
            $this->fahrzeuge['vehicles_kw'] = $model->vhm_kw;
            $this->fahrzeuge['vehicles_fuel'] = $model->vhm_fuel;
        }
    }

    public function updatedFahrzeugeVehiclesHsn()
    {
        $marke = Vehicles_Hersteller_Model::where('vhm_hsn', '=', $this->fahrzeuge['vehicles_hsn'])->first();

        if (! is_null($marke)) {
            $this->fahrzeuge['vehicles_brand'] = $marke->vhm_hersteller_name;
        }
    }

    public function store()
    {
        $validatedData = $this->validate();
        $this->fahrzeuge['vehicles_license_plate'] = $this->fahrzeuge['vehicles_license_plate'] === 'SÖM XX000' ? null : $this->fahrzeuge['vehicles_license_plate'];
        $validatedData['fahrzeuge']['vehicles_hu'] = Carbon::parse($this->vehicles_hu)->endOfMonth()->format('Y-m-d');
        $this->fahrzeuge->update($validatedData['fahrzeuge']);
        $this->furtherData->update($validatedData['furtherData']);
        $this->customers->update($validatedData['customers']);
        session()->flash('success', 'Das Fahrzeugdaten wurden erfolgreich geändert.');

        return redirect(route('backend.fahrzeuge.index'));
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

    public function updatedFahrzeugeVehiclesTire1()
    {
        $this->fahrzeuge['vehicles_tire_2'] = $this->fahrzeuge['vehicles_tire_1'];
    }

    public function render()
    {

        return view('livewire.backend.vehicles.vehicle-edit');
    }
}
