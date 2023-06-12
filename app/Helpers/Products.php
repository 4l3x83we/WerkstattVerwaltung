<?php

use App\Models\Backend\Product\Products;
use App\Models\Backend\Product\Stock;

function stockMovements($validate, $products)
{
    $validatedData = $validate;
    Stock::create($validatedData);
    $products->update([
        'product_qty' => $validatedData['stock_available'],
    ]);

    session()->flash('success', 'Der Lagerbestand wurde angepasst.');

    return redirect(route('backend.produkte.index'));
}

function stockMovementsQty($number, $available)
{
    if ($number > 0) {
        return $available + $number;
    } elseif ($number < 0) {
        return $available - str_replace('-', '', $number);
    } elseif ($number == 0) {
        return $available + $number;
    }
}

function generateRandomNumber()
{
    $number = random_int(000000000000, 9999999999999);

    if (randomNumberExists($number)) {
        return generateRandomNumber();
    }

    return $number;
}

function randomNumberExists($number)
{
    return Products::where('product_artnr', $number)->exists();
}
