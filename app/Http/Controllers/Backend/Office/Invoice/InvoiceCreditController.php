<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: InvoiceCreditController.php
 * User: ${USER}
 * Date: 07.${MONTH_NAME_FULL}.2023
 * Time: 14:42
 */

namespace App\Http\Controllers\Backend\Office\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Backend\Office\Invoice\Invoice;

class InvoiceCreditController extends Controller
{
    public function index()
    {
        return view('backend.buero.rechnung.storno.index');
    }

    public function show($id)
    {
        $show = Invoice::find($id);

        return view('backend.buero.rechnung.storno.show', compact('show'));
    }
}
