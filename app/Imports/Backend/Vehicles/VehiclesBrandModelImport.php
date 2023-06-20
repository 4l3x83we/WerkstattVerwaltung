<?php

namespace App\Imports\Backend\Vehicles;

use App\Models\Backend\Vehicles\Vehicles_Hersteller_Model;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class VehiclesBrandModelImport implements ToCollection, WithProgressBar, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    use Importable;

    public function __construct()
    {
        set_time_limit(1000);
    }

    public function collection(Collection $collection)
    {
        foreach ($collection as $key => $item) {
            Vehicles_Hersteller_Model::create([
                'brand_id' => $item['markeid'],
                'vhm_hersteller_name' => $item['marke'],
                'model_id' => $item['modelid'],
                'vhm_model_name' => $item['model'],
                'vehicles_id' => $item['fahrzeugid'],
                'vhm_typ' => str_replace(',', '.', $item['typ']),
                'vhm_prod_month_von' => null,
                'vhm_prod_month_bis' => $item['baujahr_von'],
                'vhm_prod_year_von' => null,
                'vhm_prod_year_bis' => $item['baujahr_bis'],
                'vhm_ps' => $item['ps'],
                'vhm_kw' => $item['kw'],
                'vhm_hubraum' => $item['hubraum'],
                'vhm_fuel' => $item['kraftstoff'],
                'vhm_hsn' => sprintf('%04d', $item['hsn']),
                'vhm_tsn' => $item['tsn'],
            ]);
        }
    }

    public function batchSize(): int
    {
        return 5000;
    }

    public function chunkSize(): int
    {
        return 5000;
    }
}
