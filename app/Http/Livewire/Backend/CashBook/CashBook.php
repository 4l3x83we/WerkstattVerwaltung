<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: CashBook.php
 * User: ${USER}
 * Date: 21.${MONTH_NAME_FULL}.2023
 * Time: 09:58
 */

namespace App\Http\Livewire\Backend\CashBook;

use Livewire\Component;

class CashBook extends Component
{
    public function render()
    {
        $cashBooks = \App\Models\Backend\Reports\CashBook::get();
        $saldo = $cashBooks->sum('cashBook_revenue_amount') + $cashBooks->sum('cashBook_output_amount');

        return view('livewire.backend.cash-book.cash-book', [
            'cashBooks' => $cashBooks,
            'saldo' => $saldo,
        ]);
    }
}
