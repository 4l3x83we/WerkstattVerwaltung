<?php

namespace App\Exports\Backend\Product;

use App\Models\Backend\Invoice\Product;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromQuery, ShouldAutoSize, WithHeadings
{
    public function query()
    {
        return Product::select([
            'product_name',
            'product_qty',
            'product_price',
            'product_desc',
            'created_at',
        ]);
    }

    public function headings(): array
    {
        return [
            'Name',
            'Menge',
            'Preis',
            'Beschreibung',
            'Angelegt am',
        ];
    }
}
