<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: NewCashBook.php
 * User: ${USER}
 * Date: 21.${MONTH_NAME_FULL}.2023
 * Time: 11:28
 */

namespace App\Http\Livewire\Backend\CashBook;

use App\Http\Livewire\Modal;
use App\Models\Backend\Office\NumberRanges;
use Carbon\Carbon;

class NewCashBook extends Modal
{
    public $cashBooks;

    public $cashBook;

    public $methodCashBook = false;

    public $saldo;

    public $cashBook_nr;

    public function mount()
    {
        $this->cashBook['cashBook_revenue_amount'] = number_format(0, 2);
        $this->cashBook['cashBook_output_amount'] = number_format(0, 2);
        $this->cashBook['cashBook_date'] = Carbon::now()->toDateString();
        $this->cashBook['cashBook_clerk'] = auth()->user()->name;
        $this->cashBook['cashBook_nr'] = $this->lastPaymentID();
        $this->cashBook_nr = $this->lastPaymentID();
        $this->saldo = $this->cashBooks->sum('cashBook_revenue_amount') + $this->cashBooks->sum('cashBook_output_amount');
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
        $output = ! $this->methodCashBook ? 'required' : 'nullable';
        $revenue = $this->methodCashBook ? 'required' : 'nullable';

        return [
            'methodCashBook' => 'required',
            'cashBook.cashBook_output_amount' => $output,
            'cashBook.cashBook_revenue_amount' => $revenue,
            'cashBook.cashBook_clerk' => 'nullable',
            'cashBook.cashBook_saldo' => 'nullable',
            'cashBook.cashBook_desc' => 'nullable',
            'cashBook.cashBook_date' => 'nullable',
            'cashBook.cashBook_nr' => 'nullable',
        ];
    }

    public function updatedCashBookCashBookOutputAmount()
    {
        $output = $this->cashBook['cashBook_output_amount'];
        $oldSaldo = $this->cashBooks->sum('cashBook_revenue_amount') + $this->cashBooks->sum('cashBook_output_amount');
        if (! empty($this->cashBook['cashBook_output_amount'])) {
            $this->saldo = $oldSaldo - $output;
            $this->cashBook['cashBook_saldo'] = number_format($this->saldo, 2);
        } else {
            $this->saldo = $oldSaldo;
        }
    }

    public function updatedCashBookCashBookRevenueAmount()
    {
        $revenue = $this->cashBook['cashBook_revenue_amount'];
        $oldSaldo = $this->cashBooks->sum('cashBook_revenue_amount') + $this->cashBooks->sum('cashBook_output_amount');
        if (! empty($this->cashBook['cashBook_revenue_amount'])) {
            $this->saldo = $oldSaldo + $revenue;
            $this->cashBook['cashBook_saldo'] = number_format($this->saldo, 2);
        } else {
            $this->saldo = $oldSaldo;
        }
    }

    public function updatedMethodCashBook()
    {
        if (! $this->methodCashBook) {
            $this->cashBook['cashBook_revenue_amount'] = number_format(0, 2);
            $this->saldo = $this->cashBooks->sum('cashBook_revenue_amount') + $this->cashBooks->sum('cashBook_output_amount');
        } else {
            $this->cashBook['cashBook_output_amount'] = number_format(0, 2);
            $this->saldo = $this->cashBooks->sum('cashBook_revenue_amount') + $this->cashBooks->sum('cashBook_output_amount');
        }
    }

    public function new()
    {
        $saldo = $this->cashBooks->sum('cashBook_revenue_amount') + $this->cashBooks->sum('cashBook_output_amount');
        $validatedData = $this->validate()['cashBook'];
        $validatedData['saldo'] = number_format($this->saldo, 2);
        $validatedData['cashBook_output_amount'] = -$this->cashBook['cashBook_output_amount'];
        if ($saldo != $this->saldo) {
            \App\Models\Backend\Reports\CashBook::create($validatedData);
            NumberRanges::updateOrCreate(['id' => 1],
                [
                    'cash_book_nr' => $this->lastPaymentID(),
                ]);

            session()->flash('success', 'Kassenbucheintrag erstellt.');

            return redirect(request()->header('Referer'));
        }

        session()->flash('successError', 'Es wurde nichts geändert oder angegeben.');

        return redirect(request()->header('Referer'));
    }

    public function render()
    {
        //        $this->saldo = $this->cashBooks->sum('cashBook_revenue_amount') + $this->cashBooks->sum('cashBook_output_amount');

        return view('livewire.backend.cash-book.new-cash-book');
    }
}
