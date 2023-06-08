<?php

namespace App\Models\Backend\Product;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Sluggable;

    protected $fillable = ['id', 'parent_id', 'category_title', 'category_keywords', 'category_desc', 'category_image', 'category_status', 'category_slug'];

    public function parentCategory()
    {
        return $this->belongsTo(__CLASS__, 'parent_id');
    }

    public function childCategories()
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }

    public function sluggable(): array
    {
        return [
            'category_slug' => [
                'source' => 'category_title',
            ],
        ];
    }

    public function categoryStatus()
    {
        if ($this->category_status == true) {
            $status = '<div class="inline-flex"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-green-500 dark:text-green-600">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg> <span class="ml-2 text-green-500 dark:text-green-600 font-bold">Aktiv</span></div>';
        } else {
            $status = '<div class="inline-flex"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-red-500 dark:text-red-600">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg> <span class="ml-2 text-red-500 dark:text-red-600 font-bold">Inaktiv</span></div>';
        }

        return $status;
    }
}
