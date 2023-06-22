<?php

namespace App\Http\Controllers\Backend\Office;

use App\Http\Controllers\Controller;
use App\Models\Backend\Office\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        return Invoice::all();
    }

    public function store(Request $request)
    {
        $request->validate(['customer_id' => ['nullable', 'integer'], 'invoice_date' => ['nullable', 'date'], 'invoice_due_date' => ['nullable', 'date'], 'invoice_subtotal' => ['nullable', 'numeric'], 'invoice_shipping' => ['nullable', 'numeric'], 'invoice_discount' => ['nullable', 'numeric'], 'invoice_vat_19' => ['nullable', 'numeric'], 'invoice_vat_7' => ['nullable', 'numeric'], 'invoice_vat_at' => ['nullable', 'numeric'], 'invoice_total' => ['nullable', 'numeric'], 'invoice_notes_1' => ['nullable'], 'invoice_notes_2' => ['nullable'], 'invoice_status' => ['nullable'], 'invoice_external_service' => ['nullable']]);

        return Invoice::create($request->validated());
    }

    public function show(Invoice $invoice)
    {
        return $invoice;
    }

    public function update(Request $request, Invoice $invoice)
    {
        $request->validate(['customer_id' => ['nullable', 'integer'], 'invoice_date' => ['nullable', 'date'], 'invoice_due_date' => ['nullable', 'date'], 'invoice_subtotal' => ['nullable', 'numeric'], 'invoice_shipping' => ['nullable', 'numeric'], 'invoice_discount' => ['nullable', 'numeric'], 'invoice_vat_19' => ['nullable', 'numeric'], 'invoice_vat_7' => ['nullable', 'numeric'], 'invoice_vat_at' => ['nullable', 'numeric'], 'invoice_total' => ['nullable', 'numeric'], 'invoice_notes_1' => ['nullable'], 'invoice_notes_2' => ['nullable'], 'invoice_status' => ['nullable'], 'invoice_external_service' => ['nullable']]);

        $invoice->update($request->validated());

        return $invoice;
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return response()->json();
    }
}
