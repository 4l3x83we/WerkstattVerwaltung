<?php

namespace App\Imports\Backend\Producte;

use App\Models\Backend\Product\PriceGroup;
use App\Models\Backend\Product\Products;
use App\Models\Backend\Product\Stock;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;

class ProductImport implements ToCollection, WithProgressBar, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    use Importable;

    public function collection(Collection $collection)
    {
        foreach ($collection as $item) {
            $produkt = Products::create([
                'product_artnr' => $item['artikelnummer'] ?? generateRandomNumber(),
                'product_name' => $item['artikelname'],
                'product_name_zusatz' => $item['artikelname_zusatz'] ?? null,
                'product_ean' => $item['ean'] ?? null,
                'product_hersteller' => $item['hersteller'] ?? null,
                'product_einheit' => $item['einheit'] ?? null,
                'product_price_netto_ek' => $item['preis_netto_ek'],
                'product_price_netto_vk' => $item['preis_netto_vk'],
                'product_mwst' => $item['mwst'],
                'product_price_brutto_vk' => $item['preis_brutto_vk'] ?? $item['preis_netto_vk'] * mwst($item['mwst']),
                'product_qty' => $item['menge'] ?? null,
            ]);
            $produkt->category()->sync($item['kategorie']);
            PriceGroup::create([
                'product_id' => $produkt->id,
                'priceGroup_price_vk_1' => $item['preis_netto_vk'],
                'priceGroup_price_vk_2' => null,
                'priceGroup_price_vk_3' => null,
                'priceGroup_price_vk_4' => null,
                'priceGroup_price_vk_5' => null,
                'priceGroup_price_vk_brutto_1' => $item['preis_brutto_vk'] ?? $item['preis_netto_vk'] * mwst($item['mwst']),
                'priceGroup_price_vk_brutto_2' => null,
                'priceGroup_price_vk_brutto_3' => null,
                'priceGroup_price_vk_brutto_4' => null,
                'priceGroup_price_vk_brutto_5' => null,
                'priceGroup_marge_1' => $item['marge'] ?? ($item['preis_netto_vk'] === '0,00') ? (($item['preis_netto_vk'] - $item['preis_netto_ek']) / $item['preis_netto_ek']) * 100 : null,
                'priceGroup_marge_2' => null,
                'priceGroup_marge_3' => null,
                'priceGroup_marge_4' => null,
                'priceGroup_marge_5' => null,
            ]);
            Stock::create([
                'product_id' => $produkt->id,
                'stock_available' => $item['menge'] ?? null,
                'stock_movement_date' => Carbon::parse(now())->format('Y-m-d'),
                'stock_movement_qty' => $item['menge'] ?? null,
                'storage_location' => $item['lagerort'] ?? null,
                'stock_movement_note' => 'Import von Produktdaten',
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
