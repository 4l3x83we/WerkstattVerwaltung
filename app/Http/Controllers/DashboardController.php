<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: DashboardController.php
 * User: ${USER}
 * Date: 22.${MONTH_NAME_FULL}.2023
 * Time: 14:56
 */

namespace App\Http\Controllers;

use App\Models\Backend\Customers\Customer;
use App\Models\Backend\Office\Invoice\Invoice;
use App\Models\Backend\Product\Category;
use App\Models\Backend\Product\Products;
use App\Models\Backend\Vehicles\Vehicles;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Products::count();
        $totalUsers = User::count();
        $totalCustomers = Customer::count();
        $totalInvoices = Invoice::count();
        $totalPaidBill = Invoice::where('invoice_payment_status', 'paid')->count();
        $totalPendingBill = Invoice::where('invoice_payment_status', 'pending')->count();
        $totalDueBill = Invoice::where('invoice_due_date', '<', now())->count();
        $totalAmount = Invoice::sum('invoice_total');
        $totalCars = Vehicles::count();
        $totalCategory = Category::count();

        return view('dashboard', compact('totalUsers', 'totalCustomers', 'totalProducts', 'totalCars', 'totalCategory', 'totalInvoices', 'totalPaidBill', 'totalPendingBill', 'totalDueBill', 'totalAmount'));
    }
}
