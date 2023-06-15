<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: VehicleController.php
 * User: ${USER}
 * Date: 14.${MONTH_NAME_FULL}.2023
 * Time: 05:17
 */

namespace App\Http\Controllers\Backend\Vehicles;

use App\Http\Controllers\Controller;
use App\Imports\Backend\Vehicles\VehiclesImport;
use App\Models\Backend\Vehicles\Vehicles;
use Excel;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        return view('backend.fahrzeuge.index');
    }

    public function create()
    {
        return view('backend.fahrzeuge.create');
    }

    public function show(Vehicles $fahrzeuge)
    {
        return view('backend.fahrzeuge.show', compact('fahrzeuge'));
    }

    public function edit(Vehicles $fahrzeuge)
    {
        return view('backend.fahrzeuge.edit', compact('fahrzeuge'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'import' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new VehiclesImport, $request->file('import'));

        session()->flash('success', 'Fahrzeuge wurden importiert.');

        return redirect()->back();
    }
}
