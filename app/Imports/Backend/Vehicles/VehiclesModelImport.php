<?php

namespace App\Imports\Backend\Vehicles;

use App\Models\Backend\Vehicles\Models;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class VehiclesModelImport implements ToCollection, WithProgressBar, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    use Importable;

    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $item) {
            Models::create([
                'brand_id' => $item['markeid'],
                'models_model_id' => $item['modelid'],
                'models_model_name' => $item['model'],
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
