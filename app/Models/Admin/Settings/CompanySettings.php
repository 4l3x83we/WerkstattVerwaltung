<?php

namespace App\Models\Admin\Settings;

use Illuminate\Database\Eloquent\Model;

class CompanySettings extends Model
{
    protected $fillable = [
        'company_name',
        'company_street',
        'company_post_code',
        'company_city',
        'company_telefon',
        'company_mobil',
        'company_fax',
        'company_tax_number',
        'company_vat_number',
        'company_addition',
        'company_country',
        'company_website',
        'company_email',
        'bank_id',
        'invoice_prefix',
        'offer_prefix',
        'order_prefix',
        'delivery_note_prefix',
        'invoice_correction_prefix',
        'cost_estimate_prefix',
        'currency',
        'enable_tax',
        'include_tax',
        'tax_rate_full',
        'tax_rate_reduced',
        'tax_rate_free',
        'tax_rate_core',
        'enable_19UStG',
        'invoice_initial_value',
        'company_logo',
        'company_logo_width',
        'company_logo_height',
    ];
}
