@php use Carbon\Carbon; @endphp
<div>
    <div class="p-4 bg-white block lg:flex items-center justify-between border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full">
            <div class="breadcrumbs mb-4">
                {!! Breadcrumbs::render('invoiceAll') !!}
                <div class="inline-flex items-center">
                    <h1 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white mr-4">Rechnungen</h1>
                    <div class="items-center hidden mb-3 lg:flex">
                        <x-ag.forms.search/>
                    </div>
                </div>
                <x-ag.errors.errorMessages/>
            </div>
            <div class="border-b border-gray-200 dark:border-gray-700 mb-4">
                @include('livewire.backend.office.layout.menu')
            </div>
            <div class="lg:flex">
                <div class="items-center flex">
                    @can('create')
                        <x-ag.button.a-link href="{{ route('backend.invoice.offen.create') }}" class="py-2.5 px-5 text-xs font-medium text-gray-900 bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-primary-700 focus:text-primary-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center duration-300">
                            <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ __('add new Invoice') }}
                        </x-ag.button.a-link>
                        @if(count($invoices) > 0)<div class="ml-4"> {{ $invoices->count() }} @if(count($invoices) === 1) Rechnung @else Rechnungen @endif </div>@endif
                    @endcan
                </div>
                <div class="flex items-center ml-auto space-x-2 lg:space-x-3"></div>
            </div>
        </div>
    </div>
    <x-ag.main.head>
        @include('livewire.backend.office.layout.uebersicht')
    </x-ag.main.head>
</div>
