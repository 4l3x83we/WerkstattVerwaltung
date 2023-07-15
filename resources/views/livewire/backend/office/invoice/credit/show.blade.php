@php use Carbon\Carbon; @endphp
<div>
    <div class="grid grid-cols-1 p-4 pb-0 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
        <div class="mb-4 col-span-full xl:mb-2">
            <div class="breadcrumbs">
                {!! Breadcrumbs::render('invoiceCreditShow', $invoice) !!}
                <h1 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">Rechnung {{ $invoice->invoice_nr }} <span class="text-sm text-green-500">{{ $invoice->invoice_order_type }}</span></h1>
                <x-ag.errors.errorMessages/>
            </div>
        </div>
    </div>

    <x-ag.main.head>
        @include('livewire.backend.office.layout.invoiceComplete')
    </x-ag.main.head>
</div>
