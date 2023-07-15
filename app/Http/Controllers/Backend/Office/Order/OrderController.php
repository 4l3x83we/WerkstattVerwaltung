<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: OrderController.php
 * User: ${USER}
 * Date: 08.${MONTH_NAME_FULL}.2023
 * Time: 05:05
 */

namespace App\Http\Controllers\Backend\Office\Order;

use App\Http\Controllers\Controller;
use App\Models\Backend\Office\Invoice\Invoice;

class OrderController extends Controller
{
    public function index()
    {
        return view('backend.buero.auftraege.index');
    }

    public function create()
    {
        return view('backend.buero.auftraege.create');
    }

    public function createID($id)
    {
        return view('backend.buero.auftraege.create', compact('id'));
    }

    public function show($id)
    {
        $order = Invoice::find($id);

        return view('backend.buero.auftraege.show', compact('order'));
    }
}
