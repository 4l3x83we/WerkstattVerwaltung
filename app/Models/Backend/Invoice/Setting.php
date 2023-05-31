<?php

namespace App\Models\Backend\Invoice;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use SoftDeletes;

    protected $fillable = ['company_name', 'company_email', 'company_phone', 'company_address_1', 'company_address_2', 'company_city', 'company_country', 'company_post_code', 'currency', 'enable_tax', 'include_tax', 'tax_rate', 'invoice_prefix', 'invoice_initial_value', 'invoice_theme', 'company_logo', 'company_logo_width', 'company_logo_height'];

    protected $guarded = [];
}
