<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: CustomerController.php
 * User: ${USER}
 * Date: 13.${MONTH_NAME_FULL}.2023
 * Time: 07:14
 */

namespace App\Http\Controllers\Backend\Customers;

use App\Http\Controllers\Controller;
use App\Models\Backend\Customers\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return view('backend.customer.index');
    }

    public function create()
    {
        return view('backend.customer.create');
    }

    public function show(Customer $kunden)
    {
        return view('backend.customer.show', compact('kunden'));
    }

    public function edit(Customer $kunden)
    {
        return view('backend.customer.edit', compact('kunden'));
    }

    public function import(Request $request)
    {
    }
}
