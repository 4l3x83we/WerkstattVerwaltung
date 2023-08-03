<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: CashBookController.php
 * User: ${USER}
 * Date: 21.${MONTH_NAME_FULL}.2023
 * Time: 09:50
 */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class CashBookController extends Controller
{
    public function index()
    {
        return view('backend.cashBook.index');
    }
}
