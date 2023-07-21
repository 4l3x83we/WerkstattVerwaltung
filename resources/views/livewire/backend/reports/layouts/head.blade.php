<div class="p-4 block lg:flex items-center justify-between">
    <div class="w-full">
        <div class="breadcrumbs">
            {!! Breadcrumbs::render($render) !!}
            <x-ag.errors.errorMessages/>
        </div>
        <div class="border-b border-gray-200 dark:border-gray-700 mb-4" wire:ignore>
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
            @include('livewire.backend.reports.layouts.menu')
        </div>
        <div class="lg:flex">
            <div class="items-center hidden lg:flex">
                <div class="flex items-center w-full sm:w-80">
                    <x-ag.forms.select id="selectedRange" text="Auswahl" class="mr-2" wire:change="render">
                        @foreach(dataRanges() as $range)
                            <option value="{{ $range['wert'] }}">{!! $range['name'] !!}</option>
                        @endforeach
                    </x-ag.forms.select>
                </div>
            </div>
            <div class="flex items-center ml-auto space-x-2 lg:space-x-3">
                exportbutton
            </div>
        </div>
    </div>
</div>
