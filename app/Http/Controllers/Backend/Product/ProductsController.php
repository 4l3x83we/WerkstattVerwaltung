<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Backend\Product\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        //        $produkte = Products::all();

        return view('backend.produkte.index');
    }

    public function store(Request $request)
    {
        $request->validate(['product_artnr' => ['nullable'], 'product_name' => ['nullable'], 'product_name_zusatz' => ['nullable'], 'product_ean' => ['nullable'], 'product_erstzung' => ['nullable'], 'product_einheit_id' => ['nullable', 'integer'], 'product_warengruppe_id' => ['nullable', 'integer'], 'product_price_netto_ek' => ['nullable', 'numeric'], 'product_price_netto_vk' => ['nullable', 'numeric'], 'product_mwst' => ['nullable'], 'product_price_brutto_vk' => ['nullable'], 'product_notes' => ['nullable'], 'product_not_price_update' => ['nullable', 'integer'], 'product_qty' => ['nullable', 'integer'], 'product_desc' => ['nullable'], 'product_hersteller_id' => ['nullable', 'integer']]);

        return Products::create($request->validated());
    }

    public function create()
    {
        return view('backend.produkte.create');
    }

    public function edit(Products $produkte)
    {
        return view('backend.produkte.edit', compact('produkte'));
    }

    public function show(Products $produkte)
    {
        return view('backend.produkte.show', compact('produkte'));
    }

    public function update(Request $request, Products $produkte)
    {

    }

    public function destroy(Products $produkte)
    {

    }
}
