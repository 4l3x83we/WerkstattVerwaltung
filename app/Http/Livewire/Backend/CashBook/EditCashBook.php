<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: EditCashBook.php
 * User: ${USER}
 * Date: 21.${MONTH_NAME_FULL}.2023
 * Time: 11:29
 */

namespace App\Http\Livewire\Backend\CashBook;

use App\Http\Livewire\Modal;
use App\Models\Backend\Office\NumberRanges;
use Carbon\Carbon;

class EditCashBook extends Modal
{
    public $cashBooks;

    public $cashBook;

    public $methodCashBook = false;

    public $saldo;

    public $cashBook_nr;

    public $correction;

    public function mount()
    {
        $this->cashBook['cashBook_revenue_amount'] = number_format(0, 2);
        $this->cashBook['cashBook_output_amount'] = number_format(0, 2);
        $this->cashBook['amount'] = $this->cashBooks['cashBook_saldo'];
        $this->cashBook['cashBook_date'] = Carbon::now()->toDateString();
        $this->cashBook['cashBook_clerk'] = auth()->user()->name;
        $this->cashBook['cashBook_nr'] = $this->lastPaymentID();
        $this->cashBook['cashBook_desc'] = 'Korrekturbuchung';
        $this->cashBook_nr = $this->lastPaymentID();
        $this->saldo = $this->cashBooks->sum('cashBook_revenue_amount') + $this->cashBooks->sum('cashBook_output_amount');
        $this->cashBook['cashBook_saldo'] = $this->saldo;
    }

    public function lastPaymentID()
    {
        $lastID = NumberRanges::withTrashed()->latest()->first()->cash_book_nr ?? 0;
        if (date('Y-01-01') === date('Y-m-d')) {
            $nextOrderNumber = 1;
        } else {
            $nextOrderNumber = $lastID + 1;
        }

        return $nextOrderNumber;
    }

    public function rules()
    {
        $revenue = ! $this->cashBook['cashBook_revenue_amount'] ? 'required' : 'nullable';
        $output = ! $this->cashBook['cashBook_output_amount'] ? 'required' : 'nullable';

        return [
            'methodCashBook' => 'required',
            'cashBook.cashBook_output_amount' => $revenue,
            'cashBook.cashBook_revenue_amount' => $output,
            'cashBook.cashBook_clerk' => 'nullable',
            'cashBook.cashBook_saldo' => 'nullable',
            'cashBook.cashBook_desc' => 'nullable',
            'cashBook.cashBook_date' => 'nullable',
            'cashBook.cashBook_nr' => 'nullable',
        ];
    }

    public function updatedCashBookAmount(): void
    {
        $amount = (int) $this->cashBook['amount'] - $this->saldo;
        if ($amount > 0) {
            $this->cashBook['cashBook_revenue_amount'] = (int) $this->cashBook['amount'] - $this->saldo;
            $this->cashBook['cashBook_saldo'] = $this->cashBook['cashBook_revenue_amount'] + $this->saldo;
            $this->correction = $this->cashBook['cashBook_revenue_amount'];
            $this->cashBook['cashBook_output_amount'] = null;
        } elseif ($amount < 0) {
            $this->cashBook['cashBook_output_amount'] = (int) $this->cashBook['amount'] - $this->saldo;
            $this->cashBook['cashBook_saldo'] = $this->cashBook['cashBook_output_amount'] + $this->saldo;
            $this->correction = $this->cashBook['cashBook_output_amount'];
            $this->cashBook['cashBook_revenue_amount'] = null;
        } else {
            $this->cashBook['cashBook_revenue_amount'] = 0.00;
            $this->cashBook['cashBook_output_amount'] = 0.00;
            $this->cashBook['cashBook_saldo'] = $this->cashBook['cashBook_output_amount'] + $this->saldo;
            $this->correction = $this->cashBook['cashBook_output_amount'] - $this->cashBook['cashBook_revenue_amount'];
        }
    }

    public function new()
    {
        dd($this->validate()['cashBook']);
    }

    public function render()
    {
        return view('livewire.backend.cash-book.edit-cash-book');
    }
}
