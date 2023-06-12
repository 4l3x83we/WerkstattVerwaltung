<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Imports\Backend\Producte\ProductImport;
use App\Models\Backend\Product\Products;
use Excel;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        return view('backend.produkte.index');
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

    public function import(Request $request)
    {
        $request->validate([
            'import' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new ProductImport, $request->file('import'));

        session()->flash('success', 'Produkte wurden importiert.');

        return redirect()->back();
    }
}
