<?php

namespace App\Http\Controllers\Backend\Office\History;

use App\Http\Controllers\Controller;

class HistoryController extends Controller
{
    public function index($id)
    {
        $history = $id;

        return view('backend.historie.index', compact('history'));
    }
}
