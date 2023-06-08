<?php

/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: CategoryController.php
 * User: ${USER}
 * Date: 06.${MONTH_NAME_FULL}.2023
 * Time: 16:13
 */

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Imports\Backend\Kategorie\KategorieImport;
use App\Models\Backend\Product\Category;
use Excel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search ?? '';
        $categories = Category::whereLike(['category_title', 'category_keywords', 'id'], $search)
            ->whereNull('parent_id')
            ->with('childCategories.childCategories')
            ->paginate(50);

        return view('backend.kategorie.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.kategorie.create');
    }

    public function show(Category $kategorie)
    {
        return view('backend.kategorie.show', compact('kategorie'));
    }

    public function edit(Category $kategorie)
    {
        return view('backend.kategorie.edit', compact('kategorie'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'import' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new KategorieImport, $request->file('import'));

        session()->flash('success', 'Kategorien wurden importiert.');

        return redirect()->back();
    }
}
