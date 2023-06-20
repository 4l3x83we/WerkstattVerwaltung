<?php

namespace App\Imports\Backend\Vehicles;

use App\Models\Backend\Vehicles\Brands;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class VehiclesBrandImport implements ToCollection, WithProgressBar, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    use Importable;

    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $item) {
            Brands::create([
                'brands_brand_id' => $item['markeid'],
                'brands_brand_name' => $item['marke'],
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
