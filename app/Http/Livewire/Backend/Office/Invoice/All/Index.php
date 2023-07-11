<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Index.php
 * User: ${USER}
 * Date: 07.${MONTH_NAME_FULL}.2023
 * Time: 14:56
 */

namespace App\Http\Livewire\Backend\Office\Invoice\All;

use App\Models\Backend\Office\Invoice\Invoice as InvoiceModel;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $importMode = false;

    public $search = '';

    public $sortField = 'id';

    public $sortDirection = 'desc';

    public $invoiceNummer = true;

    public function sortBy($field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function swapSortDirection(): string
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function import()
    {
        $this->importMode = true;
    }

    public function show($id)
    {
        return redirect(route('backend.invoice.alle.show', $id));
    }

    public function render()
    {
        $invoices = InvoiceModel::whereLike(['invoice_nr', 'order_nr', 'customer.customer_firstname', 'customer.customer_lastname', 'vehicle.vehicles_license_plate', 'vehicle.vehicles_brand'], $this->search)
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(50);

        $this->invoiceNummer = 'Auftrags/Rechnungs-Nr.';

        return view('livewire.backend.office.invoice.all.index', [
            'invoices' => $invoices,
        ]);
    }
}
