<?php

namespace App\Imports\Backend\Vehicles;

use App\Models\Backend\Vehicles\VehicleFurtherData;
use App\Models\Backend\Vehicles\Vehicles;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class VehiclesImport implements ToCollection, WithProgressBar, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    use Importable;

    public function collection(Collection $collection)
    {
        foreach ($collection as $item) {
            $fahrzeuge = Vehicles::create([
                'vehicles_internal_vehicle_number' => $item['fahrzeugnummer'] ?? null,
                'vehicles_license_plate' => $item['kennzeichen'] ?? null,
                'vehicles_hsn' => $item['hsn'] ?? null,
                'vehicles_tsn' => $item['tsn'] ?? null,
                'vehicles_brand' => $item['marke'] ?? null,
                'vehicles_model' => $item['modell'] ?? null,
                'vehicles_identification_number' => $item['fzidentnr'] ?? null,
                'vehicles_first_registration' => Carbon::parse($item['erstzulassung'])->format('Y-m-d') ?? null,
                'vehicles_cubic_capacity' => $item['hubraum'] ?? null,
                'vehicles_hp' => kw_ps($item['kw'])['kw'] ?? null,
                'vehicles_kw' => $item['kw'] ?? null,
                'vehicles_mileage' => $item['tatsaetlichekmstand'] ?? null,
                'vehicles_hu' => Carbon::parse($item['datumhu'])->format('Y-m-d') ?? null,
                'vehicles_tire_1' => $item['bereifung1'] ?? null,
                'vehicles_tire_2' => $item['bereifung2'] ?? null,
                'vehicles_engine_code' => $item['motonummer'] ?? null,
                'vehicles_fuel' => $item['kraftstoff'] ?? null,
                'vehicles_cat' => $item['katalysator'] ?? null,
                'vehicles_plaque' => $item['umweltplatte'] ?? null,
                'vehicles_transmission' => $item['getriebe'] ?? null,
            ]);
            VehicleFurtherData::create([
                'vehicles_id' => $fahrzeuge->id,
                'vehicles_color' => $item['farbe'] ?? null,
                'vehicles_color_code' => $item['farbcode'] ?? null,
                'vehicles_upholstery_type' => $item['polster'] ?? null,
                'vehicles_upholstery_color' => $item['polsterfarbe'] ?? null,
                'vehicles_radio_code' => $item['radiocode'] ?? null,
                'vehicles_key_number' => $item['schluesselnr'] ?? null,
                'vehicles_seats' => $item['sitze'] ?? null,
                'vehicles_doors' => $item['tueren'] ?? null,
                'vehicles_number_of_gears' => $item['gange'] ?? null,
                'vehicles_cylinder' => $item['zylinder'] ?? null,
                'vehicles_curb_weight' => $item['leergewicht'] ?? null,
                'vehicles_payload' => $item['nutzlast'] ?? null,
                'vehicles_total_weight' => $item['gesamtgewicht'] ?? null,
            ]);
            $fahrzeuge->customers()->sync($item['kundennummer']);
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
