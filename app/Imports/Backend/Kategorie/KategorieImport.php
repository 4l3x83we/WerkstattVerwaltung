<?php

namespace App\Imports\Backend\Kategorie;

use App\Models\Backend\Product\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KategorieImport implements ToModel, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    public function model(array $row)
    {
        return new Category([
            'parent_id' => $row['hauptkategorie'],
            'category_title' => $row['title'],
            'category_keywords' => $row['suchwoerter'],
            'category_desc' => $row['beschreibung'],
            'category_status' => $row['status'],
            'category_slug' => SlugService::createSlug(Category::class, 'category_slug', $row['title']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
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
