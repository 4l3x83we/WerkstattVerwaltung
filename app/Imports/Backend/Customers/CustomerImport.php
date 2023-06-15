<?php

namespace App\Imports\Backend\Customers;

use App\Models\Backend\Customers\Customer;
use App\Models\Backend\Customers\DataProtection;
use App\Models\Backend\Customers\FinancialAccountingCondition;
use App\Models\Backend\Customers\Shipping;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class CustomerImport implements ToCollection, WithProgressBar, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    use Importable;

    public function collection(Collection $collection)
    {
        foreach ($collection as $item) {
            $customer = Customer::create([
                'customer_kdnr' => numberRanges(999 + 1),
                'customer_kdtype' => $item['kundenart'] ?? 0,
                'customer_salutation' => $item['anrede'] ?? null,
                'customer_firstname' => $item['vorname'] ?? null,
                'customer_lastname' => $item['name'] ?? null,
                'customer_additive' => $item['zusatz'] ?? null,
                'customer_street' => $item['strasse'] ?? null,
                'customer_post_code' => $item['plz'] ?? null,
                'customer_location' => $item['ort'] ?? null,
                'customer_country' => $item['land'] ?? null,
                'customer_phone' => $item['telefon'] ?? null,
                'customer_phone_business' => $item['telefon2'] ?? null,
                'customer_fax' => $item['fax'] ?? null,
                'customer_mobil_phone' => $item['mobil'] ?? null,
                'customer_email' => $item['email'] ?? null,
                'customer_website' => $item['internetseite'] ?? null,
                'customer_vat_number' => $item['ustid'] ?? null,
                'customer_birthday' => Carbon::parse($item['gebdatum'])->format('Y-m-d') ?? null,
                'customer_notes' => $item['anmerkung'] ?? null,
            ]);
            Shipping::create([
                'customer_id' => $customer->id,
                'shipping_salutation' => $item['anrede'] ?? null,
                'shipping_firstname' => $item['vorname'] ?? null,
                'shipping_lastname' => $item['name'] ?? null,
                'shipping_additive' => $item['zusatz'] ?? null,
                'shipping_street' => $item['strasse'] ?? null,
                'shipping_post_code' => $item['plz'] ?? null,
                'shipping_location' => $item['ort'] ?? null,
                'shipping_country' => $item['land'] ?? null,
            ]);
            FinancialAccountingCondition::create([
                'customer_id' => $customer->id,
                'conditions_discount_items' => $item['rabatart'] ?? 0,
                'conditions_discount_labor_values' => $item['rabattlohn'] ?? 0,
                'financial_terms_of_payment' => 'Barzahlung',
                'financial_price_group' => 'Normalpreis',
                'financial_debtor_number' => $customer->customer_kdnr,
            ]);
            DataProtection::create([
                'customer_id' => $customer->id,
                'issued_on' => Carbon::parse(now())->format('Y-m-d'),
                'fax' => 0,
                'letters' => 0,
                'email' => 0,
                'phone' => 0,
                'mobile_phone' => 0,
                'whatsapp' => 0,
                'text_message' => 0,
                'selectAll' => 0,
            ]);
        }
    }

    public function batchSize(): int
    {
        return 500;
    }

    public function chunkSize(): int
    {
        return 500;
    }
}
