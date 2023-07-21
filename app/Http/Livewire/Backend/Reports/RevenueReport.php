<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Revenue.php
 * User: ${USER}
 * Date: 15.${MONTH_NAME_FULL}.2023
 * Time: 19:30
 */

namespace App\Http\Livewire\Backend\Reports;

use App\Models\Backend\Office\Invoice\Payment;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class RevenueReport extends Component
{
    use WithPagination;

    public $sortField = 'payment_nr';

    public $sortDirection = 'desc';

    public $selectedRange = 'Dieser Monat';

    public $payments;

    public $total;

    public $bar;

    public $ueberweisung;

    public $kartenzahlung;

    public $paypal;

    public function mount()
    {
        $this->updatedSelectedRange();
    }

    public function updatedSelectedRange()
    {
        $this->payments = $this->updateEntry();
        $payment = Payment::query();
        $selectRange = $this->selectedRange;
        if ($selectRange === 'Heute') {
            $this->total = $payment->whereDay('date_of_payment', Carbon::today())->get()->sum('payment_amount');
            $this->bar = $payment->where('payment_method', '=', 'Bar')
                ->whereDay('date_of_payment', Carbon::today())
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Gestern') {
            $this->total = $payment->whereDay('date_of_payment', Carbon::yesterday())->get()->sum('payment_amount');
            $this->bar = $payment->where('payment_method', '=', 'Bar')
                ->whereDay('date_of_payment', Carbon::yesterday())
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Diese Woche') {
            $this->total = $payment->whereBetween('date_of_payment', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get()->sum('payment_amount');
            $this->bar = $payment->where('payment_method', '=', 'Bar')
                ->whereBetween('date_of_payment', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Letzte Woche') {
            $this->total = $payment->whereBetween('date_of_payment', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])->get()->sum('payment_amount');
            $this->bar = $payment->where('payment_method', '=', 'Bar')
                ->whereBetween('date_of_payment', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Dieser Monat') {
            $this->total = $payment->whereBetween('date_of_payment', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->get()->sum('payment_amount');
            $this->bar = $payment->where('payment_method', '=', 'Bar')
                ->whereBetween('date_of_payment', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Letzter Monat') {
            $this->total = $payment->whereBetween('date_of_payment', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])->get()->sum('payment_amount');
            $this->bar = $payment->where('payment_method', '=', 'Bar')
                ->whereBetween('date_of_payment', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Dieses Quartal') {
            $this->total = $payment->whereBetween('date_of_payment', [Carbon::now()->startOfQuarter(), Carbon::now()->endOfQuarter()])->get()->sum('payment_amount');
            $this->bar = $payment->where('payment_method', '=', 'Bar')
                ->whereBetween('date_of_payment', [Carbon::now()->startOfQuarter(), Carbon::now()->endOfQuarter()])
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Letztes Quartal') {
            $this->total = $payment->whereBetween('date_of_payment', [Carbon::now()->subQuarter()->startOfQuarter(), Carbon::now()->subQuarter()->endOfQuarter()])->get()->sum('payment_amount');
            $this->bar = $payment->where('payment_method', '=', 'Bar')
                ->whereBetween('date_of_payment', [Carbon::now()->subQuarter()->startOfQuarter(), Carbon::now()->subQuarter()->endOfQuarter()])
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Dieses Jahr') {
            $this->total = $payment->whereYear('date_of_payment', Carbon::now()->year)->get()->sum('payment_amount');
            $this->bar = $payment->where('payment_method', '=', 'Bar')
                ->whereYear('date_of_payment', Carbon::now()->year)
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Letztes Jahr') {
            $this->total = $payment->whereYear('date_of_payment', Carbon::now()->subYear()->year)->get()->sum('payment_amount');
            $this->bar = $payment->where('payment_method', '=', 'Bar')
                ->whereYear('date_of_payment', Carbon::now()->subYear()->year)
                ->get()
                ->sum('payment_amount');
        }
        $this->ueberweisungChange();
        $this->kartenzahlungChange();
        $this->paypalChange();
    }

    public function updateEntry()
    {
        $payment = Payment::query();
        $payment->orderBy($this->sortField, $this->sortDirection);
        $selectRange = $this->selectedRange;
        if ($selectRange === 'Heute') {
            $payment->whereDay('date_of_payment', Carbon::today());
        } elseif ($selectRange === 'Gestern') {
            $payment->whereDay('date_of_payment', Carbon::yesterday());
        } elseif ($selectRange === 'Diese Woche') {
            $payment->whereBetween('date_of_payment', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($selectRange === 'Letzte Woche') {
            $payment->whereBetween('date_of_payment', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]);
        } elseif ($selectRange === 'Dieser Monat') {
            $payment->whereBetween('date_of_payment', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
        } elseif ($selectRange === 'Letzter Monat') {
            $payment->whereBetween('date_of_payment', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()]);
        } elseif ($selectRange === 'Dieses Quartal') {
            $payment->whereBetween('date_of_payment', [Carbon::now()->startOfQuarter(), Carbon::now()->endOfQuarter()]);
        } elseif ($selectRange === 'Letztes Quartal') {
            $payment->whereBetween('date_of_payment', [Carbon::now()->subQuarter()->startOfQuarter(), Carbon::now()->subQuarter()->endOfQuarter()]);
        } elseif ($selectRange === 'Dieses Jahr') {
            $payment->whereYear('date_of_payment', Carbon::now()->year);
        } elseif ($selectRange === 'Letztes Jahr') {
            $payment->whereYear('date_of_payment', Carbon::now()->subYear()->year);
        }

        return $payment->get();
    }

    public function ueberweisungChange()
    {
        $ueberweisung = Payment::query();
        $selectRange = $this->selectedRange;
        if ($selectRange === 'Heute') {
            $this->ueberweisung = $ueberweisung->where('payment_method', '=', 'Überweisung')
                ->whereDay('date_of_payment', Carbon::today())
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Gestern') {
            $this->ueberweisung = $ueberweisung->where('payment_method', '=', 'Überweisung')
                ->whereDay('date_of_payment', Carbon::yesterday())
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Diese Woche') {
            $this->ueberweisung = $ueberweisung->where('payment_method', '=', 'Überweisung')
                ->whereBetween('date_of_payment', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Letzte Woche') {
            $this->ueberweisung = $ueberweisung->where('payment_method', '=', 'Überweisung')
                ->whereBetween('date_of_payment', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Dieser Monat') {
            $this->ueberweisung = $ueberweisung->where('payment_method', '=', 'Überweisung')
                ->whereBetween('date_of_payment', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Letzter Monat') {
            $this->ueberweisung = $ueberweisung->where('payment_method', '=', 'Überweisung')
                ->whereBetween('date_of_payment', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Dieses Quartal') {
            $this->ueberweisung = $ueberweisung->where('payment_method', '=', 'Überweisung')
                ->whereBetween('date_of_payment', [Carbon::now()->startOfQuarter(), Carbon::now()->endOfQuarter()])
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Letztes Quartal') {
            $this->ueberweisung = $ueberweisung->where('payment_method', '=', 'Überweisung')
                ->whereBetween('date_of_payment', [Carbon::now()->subQuarter()->startOfQuarter(), Carbon::now()->subQuarter()->endOfQuarter()])
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Dieses Jahr') {
            $this->ueberweisung = $ueberweisung->where('payment_method', '=', 'Überweisung')
                ->whereYear('date_of_payment', Carbon::now()->year)
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Letztes Jahr') {
            $this->ueberweisung = $ueberweisung->where('payment_method', '=', 'Überweisung')
                ->whereYear('date_of_payment', Carbon::now()->subYear()->year)
                ->get()
                ->sum('payment_amount');
        }
    }

    public function kartenzahlungChange()
    {
        $kartenzahlung = Payment::query();
        $selectRange = $this->selectedRange;
        if ($selectRange === 'Heute') {
            $this->kartenzahlung = $kartenzahlung->where('payment_method', '=', 'Kartenzahlung')
                ->whereDay('date_of_payment', Carbon::today())
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Gestern') {
            $this->kartenzahlung = $kartenzahlung->where('payment_method', '=', 'Kartenzahlung')
                ->whereDay('date_of_payment', Carbon::yesterday())
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Diese Woche') {
            $this->kartenzahlung = $kartenzahlung->where('payment_method', '=', 'Kartenzahlung')
                ->whereBetween('date_of_payment', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Letzte Woche') {
            $this->kartenzahlung = $kartenzahlung->where('payment_method', '=', 'Kartenzahlung')
                ->whereBetween('date_of_payment', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Dieser Monat') {
            $this->kartenzahlung = $kartenzahlung->where('payment_method', '=', 'Kartenzahlung')
                ->whereBetween('date_of_payment', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Letzter Monat') {
            $this->kartenzahlung = $kartenzahlung->where('payment_method', '=', 'Kartenzahlung')
                ->whereBetween('date_of_payment', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Dieses Quartal') {
            $this->kartenzahlung = $kartenzahlung->where('payment_method', '=', 'Kartenzahlung')
                ->whereBetween('date_of_payment', [Carbon::now()->startOfQuarter(), Carbon::now()->endOfQuarter()])
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Letztes Quartal') {
            $this->kartenzahlung = $kartenzahlung->where('payment_method', '=', 'Kartenzahlung')
                ->whereBetween('date_of_payment', [Carbon::now()->subQuarter()->startOfQuarter(), Carbon::now()->subQuarter()->endOfQuarter()])
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Dieses Jahr') {
            $this->kartenzahlung = $kartenzahlung->where('payment_method', '=', 'Kartenzahlung')
                ->whereYear('date_of_payment', Carbon::now()->year)
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Letztes Jahr') {
            $this->kartenzahlung = $kartenzahlung->where('payment_method', '=', 'Kartenzahlung')
                ->whereYear('date_of_payment', Carbon::now()->subYear()->year)
                ->get()
                ->sum('payment_amount');
        }
    }

    public function paypalChange()
    {
        $paypal = Payment::query();
        $selectRange = $this->selectedRange;
        if ($selectRange === 'Heute') {
            $this->paypal = $paypal->where('payment_method', '=', 'PayPal')
                ->whereDay('date_of_payment', Carbon::today())
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Gestern') {
            $this->paypal = $paypal->where('payment_method', '=', 'PayPal')
                ->whereDay('date_of_payment', Carbon::yesterday())
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Diese Woche') {
            $this->paypal = $paypal->where('payment_method', '=', 'PayPal')
                ->whereBetween('date_of_payment', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Letzte Woche') {
            $this->paypal = $paypal->where('payment_method', '=', 'PayPal')
                ->whereBetween('date_of_payment', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Dieser Monat') {
            $this->paypal = $paypal->where('payment_method', '=', 'PayPal')
                ->whereBetween('date_of_payment', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Letzter Monat') {
            $this->paypal = $paypal->where('payment_method', '=', 'PayPal')
                ->whereBetween('date_of_payment', [Carbon::now()->subMonth()->startOfMonth(), Carbon::now()->subMonth()->endOfMonth()])
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Dieses Quartal') {
            $this->paypal = $paypal->where('payment_method', '=', 'PayPal')
                ->whereBetween('date_of_payment', [Carbon::now()->startOfQuarter(), Carbon::now()->endOfQuarter()])
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Letztes Quartal') {
            $this->paypal = $paypal->where('payment_method', '=', 'PayPal')
                ->whereBetween('date_of_payment', [Carbon::now()->subQuarter()->startOfQuarter(), Carbon::now()->subQuarter()->endOfQuarter()])
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Dieses Jahr') {
            $this->paypal = $paypal->where('payment_method', '=', 'PayPal')
                ->whereYear('date_of_payment', Carbon::now()->year)
                ->get()
                ->sum('payment_amount');
        } elseif ($selectRange === 'Letztes Jahr') {
            $this->paypal = $paypal->where('payment_method', '=', 'PayPal')
                ->whereYear('date_of_payment', Carbon::now()->subYear()->year)
                ->get()
                ->sum('payment_amount');
        }
    }

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

    public function render()
    {
        /*return view('livewire.backend.reports.revenue-report', [
            'payments' => $this->updateEntry(),
            'summe' => $this->updatePayment(),
        ]);*/
        return view('livewire.backend.reports.revenue-report');
    }

    public function updatePayment()
    {
        $summe = [];
        foreach ($this->updateEntry() as $payment) {
            $summe = $payment->summe();
        }

        return $summe;
    }
}
