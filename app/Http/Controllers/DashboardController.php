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
        //$totalInvoices = Invoice::count();
        //$totalPaidBill = Invoice::where('status', 'paid')->count();
        //$totalPendingBill = Invoice::where('status', 'open')->count();
        //$totalDueBill = Invoice::whereDate('invoice_due_date', '<', now())->count();
        //$totalAmount = Invoice::sum('subtotal');
        $totalCars = Vehicles::count();
        $totalCategory = Category::count();

        return view('dashboard', compact('totalUsers', 'totalCustomers', 'totalProducts', 'totalCars', 'totalCategory'));
    }
}
