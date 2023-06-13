<?php

namespace App\Models\Backend\Customers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinancialAccountingCondition extends Model
{
    use SoftDeletes;

    protected $fillable = ['customer_id', 'conditions_discount_items', 'conditions_discount_labor_values', 'financial_terms_of_payment', 'financial_price_group', 'financial_debtor_number'];

    public function customers(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
