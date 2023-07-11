<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: InvoicePaidController.php
 * User: ${USER}
 * Date: 07.${MONTH_NAME_FULL}.2023
 * Time: 04:25
 */

namespace App\Http\Controllers\Backend\Office\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Backend\Office\Invoice\Invoice;

class InvoicePaidController extends Controller
{
    public function index()
    {
        return view('backend.buero.rechnung.bezahlt.index');
    }

    public function show($id)
    {
        $paid = Invoice::find($id);

        return view('backend.buero.rechnung.bezahlt.show', compact('paid'));
    }
}
