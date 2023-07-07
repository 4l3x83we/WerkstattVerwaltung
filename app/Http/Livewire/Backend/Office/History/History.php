<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: History.php
 * User: ${USER}
 * Date: 02.${MONTH_NAME_FULL}.2023
 * Time: 09:14
 */

namespace App\Http\Livewire\Backend\Office\History;

use App\Models\Backend\Office\History\History as HistoryModel;
use Livewire\Component;
use Livewire\WithPagination;

class History extends Component
{
    use WithPagination;

    public $customerID;

    public $search = '';

    public function mount($history)
    {
        $this->customerID = $history;
    }

    public function render()
    {
        $history = HistoryModel::where('customer_id', $this->customerID)
            ->whereLike(['history_inv_nr', 'history_art_nr', 'history_art_name', 'history_inv_date', 'history_vehicle', 'history_subtotal', 'history_total', 'customer.customer_firstname', 'customer.customer_lastname'], $this->search)
            ->paginate(50);

        return view('livewire.backend.office.history.history', [
            'history' => $history,
        ]);
    }
}
