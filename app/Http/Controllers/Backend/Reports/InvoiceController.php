<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: InvoiceController.php
 * User: ${USER}
 * Date: 15.${MONTH_NAME_FULL}.2023
 * Time: 12:10
 */

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('backend.berichte.invoice');
    }
}
