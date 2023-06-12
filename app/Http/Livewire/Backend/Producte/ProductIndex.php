<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: ProductIndex.php
 * User: ${USER}
 * Date: 06.${MONTH_NAME_FULL}.2023
 * Time: 14:19
 */

namespace App\Http\Livewire\Backend\Producte;

use App\Models\Backend\Product\Products;
use App\Models\Backend\Product\Stock;
use File;
use Livewire\Component;
use Livewire\WithPagination;

class ProductIndex extends Component
{
    use WithPagination;

    public $search = '';

    public $importMode = false;

    public $sortField = 'product_name';

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

    public function import()
    {
        $this->importMode = true;
    }

    public function edit($id)
    {
        return redirect(route('backend.produkte.edit', $id));
    }

    public function show($id)
    {
        return redirect(route('backend.produkte.show', $id));
    }

    public function destroy($products)
    {
        $product = Products::where('id', $products)->first();
        foreach ($product->category as $category) {
            $product->category()->detach($category->id);
            session()->flash('successError', 'Kategorie zuweisung wurde gelöscht.');
        }
        $product->priceGroups->forceDelete();
        session()->flash('successError', 'Preise wurden gelöscht.');
        $stocks = Stock::where('product_id', $products)->get();
        foreach ($stocks as $stock) {
            $stock->forceDelete();
            session()->flash('successError', 'Lagerbestand wurde gelöscht.');
        }
        $path = 'images/produkte/'.$products;
        if (File::exists($path)) {
            File::deleteDirectory($path);
            foreach ($product->uploads as $upload) {
                $product->uploads()->detach($upload->id);
                $upload->delete();
            }
            session()->flash('successError', 'Bilder wurden gelöscht.');
        }
        $product->forceDelete();

        session()->flash('successError', 'Produkt wurde gelöscht.');

        return redirect()->back();
    }

    public function render()
    {
        $produkte = Products::whereLike(['product_name', 'product_name_zusatz', 'product_ean', 'product_artnr', 'product_desc', 'product_price_netto_ek', 'product_price_netto_vk', 'product_price_brutto_vk'], $this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(50);

        return view('livewire.backend.producte.product-index', ['produkte' => $produkte]);
    }
}
