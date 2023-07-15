<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: RevenueController.php
 * User: ${USER}
 * Date: 15.${MONTH_NAME_FULL}.2023
 * Time: 12:12
 */

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;

class RevenueController extends Controller
{
    public function index()
    {
        return view('backend.berichte.revenue');
    }
}
