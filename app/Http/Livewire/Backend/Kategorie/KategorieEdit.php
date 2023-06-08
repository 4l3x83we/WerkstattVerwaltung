<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: KategorieEdit.php
 * User: ${USER}
 * Date: 07.${MONTH_NAME_FULL}.2023
 * Time: 10:34
 */

namespace App\Http\Livewire\Backend\Kategorie;

use App\Models\Backend\Product\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use File;
use Livewire\Component;
use Livewire\WithFileUploads;

class KategorieEdit extends Component
{
    use WithFileUploads;

    public $categorie;

    public $categories;

    public $images;

    public $imageChange = false;

    public $imageLoad = false;

    public $productCategory;

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

    public function mount($kategorie)
    {
        $this->categorie = Category::whereNull('parent_id')
            ->with('childCategories')
            ->get();
        $this->categories = Category::find($kategorie->id);
        $this->productCategory = $kategorie->load('parentCategory');
    }

    public function editImage()
    {
        $this->imageChange = true;
    }

    public function updatedImages()
    {
        $this->imageLoad = true;
        if ($this->images) {
            $path = 'kategorie/'.$this->categories['category_slug'];
            if (File::exists('images/'.$path)) {
                File::deleteDirectory('images/'.$path);
                session()->flash('successError', 'Das alte Kategoriebild wurde vom Server gelöscht.');
            }
            $this->categories['category_image'] = uploadImage($this->images, $path);
        }
        $this->categories->update([
            'category_image' => $this->categories['category_image'],
        ]);
        $this->imageChange = false;
        $this->imageLoad = false;
        session()->flash('success', 'Das Bild wurde geändert.');

        return redirect(route('backend.kategorie.index'));
    }

    public function destroyPicture(Category $category)
    {
        $this->imageLoad = true;
        $path = 'kategorie/'.$category->category_slug;
        if (File::exists('images/'.$path)) {
            File::deleteDirectory('images/'.$path);
        }
        $category->update([
            'category_image' => null,
        ]);
        $this->imageLoad = false;
        session()->flash('successError', 'Das Bild wurde gelöscht.');

        return redirect(request()->header('Referer'));
    }

    public function updatedCategoriesCategoryTitle()
    {
        $this->categories['category_slug'] = SlugService::createSlug(Category::class, 'category_slug', $this->categories['category_title']);
    }

    public function store()
    {
        if ($this->categories['parent_id'] === 'null') {
            $this->validate()['categories']['parent_id'] = null;
        }
        if ($this->images) {
            $path = 'kategorie/'.$this->categories['category_slug'];
            if (File::exists('images/'.$path)) {
                File::deleteDirectory('images/'.$path);
                session()->flash('successError', 'Das alte Kategoriebild wurde vom Server gelöscht.');
            }
            $this->categories['category_image'] = uploadImage($this->images, $path);
        }
        $this->validate();
        $this->categories->update($this->validate()['categories']);

        session()->flash('success', 'Die Kategorie wurde erfolgreich bearbeitet.');

        return redirect(route('backend.kategorie.index'));
    }

    public function render()
    {
        return view('livewire.backend.kategorie.kategorie-edit');
    }
}
