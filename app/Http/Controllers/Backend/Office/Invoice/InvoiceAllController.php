<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: InvoiceAllController.php
 * User: ${USER}
 * Date: 07.${MONTH_NAME_FULL}.2023
 * Time: 14:44
 */

namespace App\Http\Controllers\Backend\Office\Invoice;

use App\Http\Controllers\Controller;
use App\Models\Backend\Office\Invoice\Invoice;

class InvoiceAllController extends Controller
{
    public function index()
    {
        return view('backend.buero.rechnung.alle.index');
    }

    public function show($id)
    {
        $show = Invoice::find($id);
        if ($show->invoice_payment_status === 'order') {
            $order = $show;

            return view('backend.buero.auftraege.show', compact('order'));
        }

        if ($show->invoice_payment_status === 'draft') {
            $draft = $show;

            return view('backend.buero.entwurf.edit', compact('draft'));
        }

        if ($show->invoice_status === 'storno') {
            return view('backend.buero.rechnung.storno.show', compact('show'));
        }

        if ($show->invoice_status === 'open') {
            $offen = $show;

            return view('backend.buero.rechnung.show', compact('offen'));
        }

        return view('backend.buero.rechnung.alle.show', compact('show'));
    }
}
