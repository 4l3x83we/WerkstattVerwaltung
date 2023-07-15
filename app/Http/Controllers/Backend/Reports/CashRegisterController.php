<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: CashRegisterController.php
 * User: ${USER}
 * Date: 15.${MONTH_NAME_FULL}.2023
 * Time: 12:13
 */

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;

class CashRegisterController extends Controller
{
    public function index()
    {
        return view('backend.berichte.cashRegister');
    }
}
