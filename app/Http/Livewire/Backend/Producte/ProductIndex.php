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
use Livewire\Component;
use Livewire\WithPagination;

class ProductIndex extends Component
{
    use WithPagination;

    public $search = '';

    public $sortField = 'product_artnr';

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
        return redirect(route('backend.produkte.edit', $id));
    }

    public function show($id)
    {
        return redirect(route('backend.produkte.show', $id));
    }

    public function destroy($id)
    {

    }

    public function render()
    {
        $produkte = Products::whereLike(['product_name', 'product_ean', 'product_artnr', 'product_desc', 'product_price_netto_ek', 'product_price_netto_vk', 'product_price_brutto_vk'], $this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(50);

        return view('livewire.backend.producte.product-index', ['produkte' => $produkte]);
    }
}
