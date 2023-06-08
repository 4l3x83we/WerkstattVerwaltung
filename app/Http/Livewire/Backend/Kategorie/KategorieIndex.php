<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: KategorieIndex.php
 * User: ${USER}
 * Date: 06.${MONTH_NAME_FULL}.2023
 * Time: 16:40
 */

namespace App\Http\Livewire\Backend\Kategorie;

use App\Models\Backend\Product\Category;
use File;
use Livewire\Component;
use Livewire\WithPagination;

class KategorieIndex extends Component
{
    use WithPagination;

    public $search = '';

    public $importMode = false;

    public $sortField = 'category_title';

    public $sortDirection = 'asc';

    public function sortBy($field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function swapSortDirection(): string
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function edit($id)
    {
        return redirect(route('backend.kategorie.edit', $id));
    }

    public function show($id)
    {
        return redirect(route('backend.kategorie.show', $id));
    }

    public function destroy($id)
    {
        $categories = Category::findOrFail($id);
        $path = 'kategorie/'.$categories['category_slug'];
        if (File::exists('images/'.$path)) {
            File::deleteDirectory('images/'.$path);
        }
        $categories->delete();

        session()->flash('success', 'Die Kategorie wurde erfolgreich gelöscht.');

        return redirect(route('backend.kategorie.index'));
    }

    public function import()
    {
        $this->importMode = true;
    }

    public function render()
    {
        $categories = Category::whereLike(['category_title', 'category_keywords', 'id', 'childCategories.category_title', 'childCategories.category_keywords', 'childCategories.id'], $this->search)
            ->whereNull('parent_id')
            ->with('childCategories.childCategories')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(50);

        return view('livewire.backend.kategorie.kategorie-index', ['categories' => $categories]);
    }
}
