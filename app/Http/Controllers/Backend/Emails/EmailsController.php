<?php

namespace App\Http\Controllers\Backend\Emails;

use App\Http\Controllers\Controller;

class EmailsController extends Controller
{
    public function index()
    {
        return view('backend.emails.email');
    }
}
