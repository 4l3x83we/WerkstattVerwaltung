<?php

namespace App\Models\Backend\Upload;

use App\Models\Backend\Product\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Upload extends Model
{
    protected $fillable = ['size', 'filename', 'folder', 'filepath', 'width', 'height'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Products::class, 'upload_product');
    }
}
