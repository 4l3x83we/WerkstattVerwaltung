<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: DraftController.php
 * User: ${USER}
 * Date: 05.${MONTH_NAME_FULL}.2023
 * Time: 15:16
 */

namespace App\Http\Controllers\Backend\Office\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Backend\Office\Invoice\Invoice;

class DraftController extends Controller
{
    public function index()
    {
        return view('backend.buero.entwurf.index');
    }

    public function create()
    {
        return view('backend.buero.entwurf.create');
    }

    public function show($id)
    {
        $draft = Invoice::find($id);

        return view('backend.buero.entwurf.show', compact('draft'));
    }

    public function edit($id)
    {
        $draft = Invoice::find($id);

        return view('backend.buero.entwurf.edit', compact('draft'));
    }
}
