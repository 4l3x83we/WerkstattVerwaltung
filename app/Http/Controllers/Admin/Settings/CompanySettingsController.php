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

class CompanySettingsController extends Controller
{
    public function index()
    {
        $settings = CompanySettings::latest()->first();

        return view('admin.einstellungen.index', compact('settings'));
    }

    public function importPage()
    {
        return view('admin.imports.index');
    }
}
