<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: CompanySettings.php
 * User: ${USER}
 * Date: 05.${MONTH_NAME_FULL}.2023
 * Time: 09:44
 */

namespace App\Http\Livewire\Admin\Settings;

use File;
use Livewire\Component;
use Livewire\WithFileUploads;

class CompanySettings extends Component
{
    use WithFileUploads;

    public $settings;

    public $images;

    protected $messages = [
        'settings.company_name.required' => 'Firmenname muss ausgefüllt werden.',
        'settings.company_addition.required' => 'Firmenzusatz muss ausgefüllt werden.',
        'settings.company_street.required' => 'Straße muss ausgefüllt werden.',
        'settings.company_post_code.required' => 'Postleitzahl muss ausgefüllt werden.',
        'settings.company_city.required' => 'Ort muss ausgefüllt werden.',
        'settings.company_website.required' => 'Webseite muss ausgefüllt werden.',
        'settings.company_telefon.required' => 'Telefon oder Mobil muss ausgefüllt werden.',
        'settings.company_mobil.required' => 'Mobil oder Telefon muss ausgefüllt werden.',
        'settings.company_email.required' => 'E-Mail Adresse muss ausgefüllt werden.',
        'settings.company_country.required' => 'Land muss ausgefüllt werden.',
        'settings.invoice_prefix.required' => 'Rechnungspräfix muss ausgefüllt werden.',
        'settings.offer_prefix.required' => 'Angebotspräfix muss ausgefüllt werden.',
        'settings.order_prefix.required' => 'Auftragspräfix muss ausgefüllt werden.',
        'settings.delivery_note_prefix.required' => 'Lieferscheinpräfix muss ausgefüllt werden.',
        'settings.invoice_correction_prefix.required' => 'Rechnungskorrekturpräfix muss ausgefüllt werden.',
        'settings.cost_estimate_prefix.required' => 'Kostenvoranschlagpräfix muss ausgefüllt werden.',
        'settings.invoice_initial_value.required' => 'Anfangswert der Rechnungsnummer muss ausgefüllt werden.',
        'settings.currency.required' => 'Währung muss ausgefüllt werden.',
        'settings.enable_tax.required' => 'Steuer aktivieren muss ausgefüllt werden.',
        'settings.include_tax.required' => 'inklusive Steuer muss ausgefüllt werden.',
        'settings.tax_rate_full.required' => 'voller Steuersatz muss ausgefüllt werden.',
        'settings.tax_rate_reduced.required' => 'erm. Steuersatz muss ausgefüllt werden.',
        'settings.tax_rate_free.required' => 'kein Steuersatz muss ausgefüllt werden.',
        'settings.tax_rate_core.required' => 'Altteilsteuersatz muss ausgefüllt werden.',
        'settings.enable_19UStG.required' => 'Kleinunternehmer gem. § 19 UStG muss ausgefüllt werden.',
        'settings.company_tax_number.required' => 'Steuernummer muss ausgefüllt werden.',
        'settings.company_vat_number.required' => 'USt-IdNr.: muss ausgefüllt werden.',
        'settings.company_tax_number.regex' => 'Steuernummer Format ist ungültig. Es muss an der 4. und 8. stelle ein / sein.',
        'images.required' => 'Logo muss ausgefüllt werden.',
        'images.image' => 'Logo muss ein Bild sein.',
        'images.mimes' => 'Logo muss den Dateityp jpg, png, jpeg, gif, svg haben.',
        'images.dimensions' => 'Logo hat ungültige Bildabmessungen.',
        'images.max' => 'Logo darf maximal 2048 Kilobytes groß sein.',
        'settings.company_email.email' => 'E-Mail Adresse muss eine gültige E-Mail-Adresse sein.',
    ];

    public function mount()
    {
        $this->settings['id'] = $this->settings['id'] ?? '';
        $this->settings['company_country'] = 'DE';
        $this->settings['company_telefon'] = $this->settings['company_telefon'] ?? null;
        $this->settings['company_mobil'] = $this->settings['company_mobil'] ?? null;
        $this->settings['include_tax'] = false;
        $this->settings['enable_tax'] = true;
        if (isset($this->settings['company_logo'])) {
            $this->settings['logo'] = asset($this->settings['company_logo']);
        } else {
            $this->settings['logo'] = asset('images/default.png');
            $this->settings['company_logo'] = false;
        }
        $this->settings['invoice_prefix'] = $this->settings['invoice_prefix'] ?? 'RE-';
        $this->settings['offer_prefix'] = $this->settings['offer_prefix'] ?? 'AN-';
        $this->settings['order_prefix'] = $this->settings['order_prefix'] ?? 'AF-';
        $this->settings['delivery_note_prefix'] = $this->settings['delivery_note_prefix'] ?? 'LS-';
        $this->settings['invoice_correction_prefix'] = $this->settings['invoice_correction_prefix'] ?? 'REK-';
        $this->settings['cost_estimate_prefix'] = $this->settings['cost_estimate_prefix'] ?? 'KV-';
        $this->settings['invoice_initial_value'] = $this->settings['invoice_initial_value'] ?? '100000';
        $this->settings['currency'] = $this->settings['currency'] ?? ' €';
        $this->settings['tax_rate_full'] = $this->settings['tax_rate_full'] ?? 19;
        $this->settings['tax_rate_reduced'] = $this->settings['tax_rate_reduced'] ?? 7;
        $this->settings['tax_rate_free'] = $this->settings['tax_rate_free'] ?? 0;
        $this->settings['tax_rate_core'] = $this->settings['tax_rate_core'] ?? 20.9;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedSettingsCompanyTaxNumber($number)
    {
        $this->settings['company_tax_number'] = preg_replace('/^(\d{3})(\d{3})(\d{5})$/i', '$1/$2/$3', $number);
    }

    public function rules()
    {
        $telefon = $this->settings['company_mobil'] ? 'nullable' : 'required';
        $mobil = $this->settings['company_telefon'] ? 'nullable' : 'required';
        $ustg19 = $this->settings['enable_tax'] ? 'nullable' : 'required';

        return [
            'settings.id' => 'nullable',
            'settings.company_name' => 'required',
            'settings.company_addition' => 'nullable',
            'settings.company_street' => 'required',
            'settings.company_post_code' => 'required',
            'settings.company_city' => 'required',
            'settings.company_country' => 'required',
            'settings.company_email' => 'required|email:rfc,dns',
            'settings.company_website' => 'required',
            'settings.company_tax_number' => 'required',
            'settings.company_vat_number' => 'required',
            'settings.company_telefon' => $telefon,
            'settings.company_mobil' => $mobil,
            'settings.invoice_prefix' => 'required',
            'settings.offer_prefix' => 'required',
            'settings.order_prefix' => 'required',
            'settings.delivery_note_prefix' => 'required',
            'settings.invoice_correction_prefix' => 'required',
            'settings.cost_estimate_prefix' => 'required',
            'settings.currency' => 'required',
            'settings.enable_tax' => 'required',
            'settings.include_tax' => 'required',
            'settings.tax_rate_full' => 'required',
            'settings.tax_rate_reduced' => 'required',
            'settings.tax_rate_free' => 'required',
            'settings.tax_rate_core' => 'required',
            'settings.enable_19UStG' => $ustg19,
            'settings.invoice_initial_value' => 'nullable',
            'images' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=150,min_height=45,max_width=15360,max_height=8640',
            'settings.company_logo' => 'nullable',
            'settings.company_logo_width' => 'nullable',
            'settings.company_logo_height' => 'nullable',
        ];
    }

    public function store()
    {
        $validatedData = $this->validate();
        if ($validatedData['images']) {
            if (File::exists($validatedData['settings']['company_logo'])) {
                File::deleteDirectory(public_path('images/firma/'.replaceStrToLower($validatedData['settings']['company_name'])));
                session()->flash('successError', 'Das alte Logo wurde vom Server gelöscht.');
            }
            $image = uploadFirmenLogo($validatedData['images'], $validatedData['settings']['company_name']);
            $validatedData['settings']['company_logo'] = $image['image'];
            $validatedData['settings']['company_logo_width'] = $image['width'];
            $validatedData['settings']['company_logo_height'] = $image['height'];
        }
        $settings = $validatedData['settings'];
        \App\Models\Admin\Settings\CompanySettings::updateOrCreate(['id' => $settings['id']], $settings);
        session()->flash('success', 'Einstellung erfolgreich erstellt oder aktualisiert');

        return redirect(route('dashboard'));
    }

    public function render()
    {

        return view('livewire.admin.settings.company-settings');
    }
}
