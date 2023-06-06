<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: BankSettings.php
 * User: ${USER}
 * Date: 06.${MONTH_NAME_FULL}.2023
 * Time: 07:12
 */

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;

class BankSettings extends Component
{
    public $bank;

    public $bankDaten;

    public $settingsID;

    public $setting;

    public function rules()
    {
        return [
            'settingsID' => 'required',
            'bank.id' => 'nullable',
            'bank.bank_account_owner' => 'required',
            'bank.bank_bank_name' => 'required',
            'bank.bank_iban' => 'required',
            'bank.bank_bic' => 'required',
        ];
    }

    public function mount($id)
    {
        $this->settingsID = $id;
        $this->setting = \App\Models\Admin\Settings\CompanySettings::where('id', $id)->first();
        $this->bank = \App\Models\Admin\Settings\BankSettings::where('id', $id)->first();
    }

    public function store()
    {
        $validatedData = $this->validate()['bank'];
        $validatedData['id'] = $this->bank['id'] ?? '';
        $validatedData['company_setting_id'] = $this->settingsID;
        $bank = \App\Models\Admin\Settings\BankSettings::updateOrCreate(['id' => $validatedData['id']], $validatedData);
        $this->setting->update([
            'bank_id' => $bank->id,
        ]);
        session()->flash('success', 'Bankdaten wurden erfolgreich hinzugefügt.');

        return redirect(route('dashboard'));
    }

    public function render()
    {
        return view('livewire.admin.settings.bank-settings');
    }
}
