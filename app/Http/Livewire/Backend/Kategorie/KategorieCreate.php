<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: KategorieCreate.php
 * User: ${USER}
 * Date: 06.${MONTH_NAME_FULL}.2023
 * Time: 16:59
 */

namespace App\Http\Livewire\Backend\Kategorie;

use App\Models\Backend\Product\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Livewire\Component;
use Livewire\WithFileUploads;

class KategorieCreate extends Component
{
    use WithFileUploads;

    public $categories = [
        'parent_id' => null,
        'category_status' => 'true',
    ];

    public $images;

    protected $rules = [
        'categories.id' => 'nullable',
        'categories.parent_id' => 'nullable',
        'categories.category_title' => 'required',
        'categories.category_keywords' => 'nullable',
        'categories.category_desc' => 'nullable',
        'categories.category_image' => 'nullable',
        'categories.category_status' => 'required',
        'categories.category_slug' => 'required',
    ];

    public function updatedCategoriesCategoryTitle()
    {
        $this->categories['category_slug'] = SlugService::createSlug(Category::class, 'category_slug', $this->categories['category_title']);
    }

    public function store()
    {
        if ($this->categories['parent_id'] == 'null') {
            $this->validate()['categories']['parent_id'] = null;
        }
        $path = 'kategorie/'.$this->categories['category_slug'];
        $this->categories['category_image'] = uploadImage($this->images, $path);
        $this->validate();
        Category::create($this->validate()['categories']);

        session()->flash('success', 'Die Kategorie wurde erfolgreich hinzugefügt');

        return redirect(route('backend.kategorie.index'));
    }

    public function render()
    {
        $categorie = Category::whereNull('parent_id')
            ->with('childCategories')
            ->get();

        return view('livewire.backend.kategorie.kategorie-create', ['categorie' => $categorie]);
    }
}
