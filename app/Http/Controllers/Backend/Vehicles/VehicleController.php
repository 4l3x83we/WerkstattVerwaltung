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
use App\Imports\Backend\Vehicles\VehiclesBrandImport;
use App\Imports\Backend\Vehicles\VehiclesBrandModelImport;
use App\Imports\Backend\Vehicles\VehiclesImport;
use App\Imports\Backend\Vehicles\VehiclesModelImport;
use App\Models\Admin\Settings\BankSettings;
use App\Models\Admin\Settings\CompanySettings;
use App\Models\Backend\Vehicles\Vehicles;
use Excel;
use Illuminate\Http\Request;
use PDF;

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

    public function brandsImport(Request $request)
    {
        $request->validate([
            'import' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new VehiclesBrandImport, $request->file('import'));

        session()->flash('success', 'Fahrzeughersteller wurden importiert.');

        return redirect()->back();
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

    public function modelsImport(Request $request)
    {
        $request->validate([
            'import' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new VehiclesModelImport, $request->file('import'));

        session()->flash('success', 'Fahrzeugmodell wurden importiert.');

        return redirect()->back();
    }

    public function brandsModelsImport(Request $request)
    {
        $request->validate([
            'import' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new VehiclesBrandModelImport, $request->file('import'));

        session()->flash('success', 'Fahrzeughersteller und Modelle wurden importiert.');

        return redirect()->back();
    }

    public function pdf()
    {
        $settings = CompanySettings::latest()->first();
        $bank = BankSettings::where('id', $settings->id)->first();

        /*return PDF::loadView('backend.fahrzeuge.pdf', [
            'settings' => $settings,
            'bank' => $bank,
        ])
            ->setOption(['defaultFont' => 'sans-serif', 'enable_php' => true])
            ->setOption('isPhpEnabled', true)
            ->setPaper('a4', 'portrait')
            ->download('document.pdf');*/

        /*return PDF::loadView('backend.fahrzeuge.pdf', compact('settings'))
            ->setPaper('a4')
            ->setOption('paperOrientation', 'portrait')
            ->stream('invoice.pdf');*/

        return view('backend.fahrzeuge.pdf', compact('settings', 'bank'));
    }
}
