<?php

namespace App\Models\Admin\Settings;

use Illuminate\Database\Eloquent\Model;

class BankSettings extends Model
{
    protected $fillable = ['company_setting_id', 'bank_account_owner', 'bank_iban', 'bank_bic', 'bank_bank_name'];
}
