<?php

namespace App\Exports\Backend\Customer;

use App\Models\Backend\Invoice\Customers;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomerExport implements FromQuery, ShouldAutoSize, WithHeadings
{
    public function query()
    {
        return Customers::select([
            'name',
            'phone',
            'email',
            'address_1',
            'address_2',
            'city',
            'country',
            'post_code',
            'ship_name',
            'ship_phone',
            'ship_email',
            'ship_address_1',
            'ship_address_2',
            'ship_city',
            'ship_country',
            'ship_post_code',

        ]);
    }

    public function headings(): array
    {
        return [
            'Name',
            'E-Mail Adresse',
            'Telefon',
            'Adresse 1',
            'Adresse 2',
            'Stadt',
            'Land',
            'Postleitzahl',
            'Liefer Name',
            'Liefer E-Mail Adresse',
            'Liefer Telefon',
            'Liefer Adresse 1',
            'Liefer Adresse 2',
            'Liefer Stadt',
            'Liefer Land',
            'Liefer Postleitzahl',
        ];
    }
}
