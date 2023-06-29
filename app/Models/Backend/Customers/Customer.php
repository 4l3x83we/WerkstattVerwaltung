<?php

namespace App\Models\Backend\Customers;

use App\Models\Backend\Vehicles\Vehicles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'customer_kdnr',
        'customer_kdtype',
        'customer_salutation',
        'customer_firstname',
        'customer_lastname',
        'customer_additive',
        'customer_street',
        'customer_country',
        'customer_post_code',
        'customer_location',
        'customer_phone',
        'customer_phone_business',
        'customer_fax',
        'customer_mobil_phone',
        'customer_email',
        'customer_website',
        'customer_notes',
        'customer_birthday',
        'customer_since',
        'customer_vat_number',
        'customer_show_notes_issues',
        'customer_show_notes_appointments',
        'customer_net_invoice',
    ];

    protected $casts = ['customer_birthday' => 'date:Y-m-d', 'customer_since' => 'date:Y-m-d'];

    public function shippings(): HasOne
    {
        return $this->hasOne(Shipping::class);
    }

    public function financialAccountingConditions(): HasOne
    {
        return $this->hasOne(FinancialAccountingCondition::class);
    }

    public function dataProtection(): HasOne
    {
        return $this->hasOne(DataProtection::class);
    }

    public function vehicles(): BelongsToMany
    {
        return $this->belongsToMany(Vehicles::class, 'vehicle_customer');
    }

    public function fullname()
    {
        return $this->customer_firstname.' '.$this->customer_lastname;
    }
}
