<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: CompanySettingsController.php
 * User: ${USER}
 * Date: 05.${MONTH_NAME_FULL}.2023
 * Time: 09:06
 */

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Admin\Settings\CompanySettings;
use Illuminate\Http\Request;

class CompanySettingsController extends Controller
{
    public function index()
    {
        $settings = CompanySettings::latest()->first();

        return view('admin.einstellungen.index', compact('settings'));
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(CompanySettings $companySettings)
    {
    }

    public function edit(CompanySettings $companySettings)
    {
    }

    public function update(Request $request, CompanySettings $companySettings)
    {
    }

    public function destroy(CompanySettings $companySettings)
    {
    }
}
