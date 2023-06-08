<?php

namespace App\Models\Backend\Product;

use App\Models\Admin\Settings\CompanySettings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_artnr',
        'product_name',
        'product_name_zusatz',
        'product_ean',
        'product_ersetzung',
        'einheit_id',
        'category_id',
        'hersteller_id',
        'product_price_netto_ek',
        'product_price_netto_vk',
        'product_mwst',
        'product_price_brutto_vk',
        'product_notes',
        'product_not_price_update',
        'product_qty',
        'product_desc',
    ];

    public function priceGroups(): HasOne
    {
        return $this->hasOne(PriceGroup::class);
    }

    public function nettoEK()
    {
        return number_format($this->product_price_netto_ek, 2, ',', '.').CompanySettings::latest()->first()->currency;
    }

    public function nettoVK()
    {
        return number_format($this->product_price_netto_vk, 2, ',', '.').CompanySettings::latest()->first()->currency;
    }

    public function bruttoVK()
    {
        return number_format($this->product_price_brutto_vk, 2, ',', '.').CompanySettings::latest()->first()->currency;
    }
}
