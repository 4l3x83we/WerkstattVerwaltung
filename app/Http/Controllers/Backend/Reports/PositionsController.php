<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: PositionsController.php
 * User: ${USER}
 * Date: 15.${MONTH_NAME_FULL}.2023
 * Time: 12:13
 */

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;

class PositionsController extends Controller
{
    public function index()
    {
        return view('backend.berichte.positions');
    }
}
