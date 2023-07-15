<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: SalesVolumeController.php
 * User: ${USER}
 * Date: 15.${MONTH_NAME_FULL}.2023
 * Time: 12:12
 */

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Controllers\Controller;

class SalesVolumeController extends Controller
{
    public function index()
    {
        return view('backend.berichte.salesVolumes');
    }
}
