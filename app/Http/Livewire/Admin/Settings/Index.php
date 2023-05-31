<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Index.php
 * User: ${USER}
 * Date: 31.${MONTH_NAME_FULL}.2023
 * Time: 07:34
 */

namespace App\Http\Livewire\Admin\Settings;

use App\Models\Backend\Invoice\Setting;
use File;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $settings;

    public $images;

    protected $messages = [
        'settings.company_name' => 'Firmenname muss ausgefüllt werden.',
        'settings.company_email' => 'E-Mail Adresse  muss ausgefüllt werden.',
        'settings.company_address_1' => 'Anschrift muss ausgefüllt werden.',
        'settings.company_city' => 'Ort muss ausgefüllt werden.',
        'settings.company_post_code' => 'Postleitzahl muss ausgefüllt werden.',
        'settings.company_country' => 'Land muss ausgefüllt werden.',
        'settings.invoice_prefix' => 'Rechnungsprefix muss ausgefüllt werden.',
        'settings.invoice_initial_value' => 'Anfangswert der Rechnungsnummer muss ausgefüllt werden.',
        'settings.enable_tax' => 'Steuer aktivieren muss ausgefüllt werden.',
        'settings.include_tax' => 'inklusive Steuer muss ausgefüllt werden.',
        'settings.currency' => 'Währung muss ausgefüllt werden.',
        'settings.tax_rate' => 'Steuersatz muss ausgefüllt werden.',
        'settings.company_logo' => 'Logo muss hochgeladen werden.',
    ];

    public function rules()
    {
        return [
            'settings.id' => 'nullable',
            'settings.company_name' => 'required',
            'settings.company_email' => 'required',
            'settings.company_phone' => 'nullable',
            'settings.company_address_1' => 'required',
            'settings.company_address_2' => 'nullable',
            'settings.company_city' => 'required',
            'settings.company_country' => 'required',
            'settings.company_post_code' => 'required',
            'settings.currency' => 'nullable',
            'settings.enable_tax' => 'required',
            'settings.include_tax' => 'required',
            'settings.tax_rate' => 'required',
            'settings.invoice_prefix' => 'required',
            'settings.invoice_initial_value' => 'required',
            'settings.invoice_theme' => 'nullable',
            'settings.company_logo' => 'nullable',
            'images' => 'nullable',
            'settings.company_logo_width' => 'nullable',
            'settings.company_logo_height' => 'nullable',
        ];
    }

    public function mount()
    {
        $this->settings = Setting::first();
        $this->settings['id'] = $this->settings['id'] ?? '';
        $this->settings['company_country'] = $this->settings['company_country'] ?? 'DE';
        if (isset($this->settings['company_logo'])) {
            $this->settings['logo'] = asset($this->settings['company_logo']);
        } else {
            $this->settings['logo'] = asset('images/default.png');
        }
        $this->settings['invoice_prefix'] = $this->settings['invoice_prefix'] ?? 'RE-';
        $this->settings['invoice_initial_value'] = $this->settings['invoice_initial_value'] ?? 10000;
        $this->settings['currency'] = $this->settings['currency'] ?? 'EUR';
        $this->settings['enable_tax'] = $this->settings['enable_tax'] ?? true;
        $this->settings['include_tax'] = $this->settings['include_tax'] ?? 0;
        $this->settings['tax_rate'] = $this->settings['tax_rate'] ?? 19;
    }

    public function store()
    {
        if ($this->images) {
            if (File::exists($this->settings['company_logo'])) {
                File::deleteDirectory(public_path('images/firma/'.replaceStrToLower($this->settings['company_name'])));
                session()->flash('successError', 'Das alte Logo wurde vom Server gelöscht.');
            }
            $image = uploadFirmenLogo($this->images, $this->settings['company_name']);
            $this->settings['company_logo'] = $image['image'];
            $this->settings['company_logo_width'] = $image['width'];
            $this->settings['company_logo_height'] = $image['height'];
        }
        $validatedData = $this->validate()['settings'];
        Setting::updateOrCreate(['id' => $validatedData['id']], $validatedData);

        session()->flash('success', 'Einstellung erfolgreich erstellt oder aktualisiert');

        return redirect(route('dashboard'));
    }

    public function render()
    {
        return view('livewire.admin.settings.index');
    }
}
