<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: StockModalTable.php
 * User: ${USER}
 * Date: 11.${MONTH_NAME_FULL}.2023
 * Time: 07:18
 */

namespace App\Http\Livewire\Backend\Stock;

use App\Http\Livewire\Modal;
use App\Models\Backend\Product\Stock;
use Carbon\Carbon;

class StockModalTable extends Modal
{
    public $newForm = false;

    public $products;

    public $stockMovements;

    public $stockMovement;

    public $stockMovementTotal;

    protected $messages = [
        'stockMovement.stock_movement_date.required' => 'Datum muss ausgefüllt werden.',
        'stockMovement.stock_movement_qty.required' => 'Menge muss ausgefüllt werden.',
        'stockMovement.stock_movement_note.max' => 'Anmerkung darf maximal 55 Zeichen haben.',
    ];

    protected $rules = [
        'stockMovement.product_id' => 'required',
        'stockMovement.stock_movement_date' => 'required|date',
        'stockMovement.stock_movement_qty' => 'required',
        'stockMovement.stock_movement_note' => 'nullable|max:55',
        'stockMovement.stock_available' => 'nullable',
        'stockMovement.stock_reserved' => 'nullable',
        'stockMovement.no_warehouse_management' => 'nullable',
        'stockMovement.storage_location' => 'nullable',
        'stockMovement.minimum_amount' => 'nullable',
        'stockMovement.maximum_amount' => 'nullable',
    ];

    public function mount()
    {
        $productID = $this->products->id;
        $this->stockMovements = Stock::where('product_id', $productID)->get();
        if (! $this->stockMovements) {
            $this->stockMovement = Stock::where('product_id', $productID)->latest()->first();
            $this->stockMovement['stock_movement_date'] = Carbon::parse(now())->format('Y-m-d');
            $this->stockMovement['stock_movement_note'] = null;
            $this->stockMovement['stock_movement_qty'] = null;
            $this->stockMovementTotal = $this->stockMovement->stock_available;
        }
    }

    public function updatedStockMovementStockMovementQty()
    {
        $number = $this->stockMovement['stock_movement_qty'];
        $available = $this->stockMovement['stock_available'];
        $this->stockMovement['stock_available'] = stockMovementsQty($number, $available);
    }

    public function new()
    {
        $this->newForm = true;
    }

    public function newStock()
    {
        $validatedData = $this->validate()['stockMovement'];
        stockMovements($validatedData, $this->products);
    }

    public function render()
    {
        return view('livewire.backend.stock.stock-modal-table');
    }
}
