<div>
    <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="breadcrumbs mb-4">
                {!! Breadcrumbs::render('vehicles') !!}
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Fahrzeuge</h1>
                <x-ag.errors.errorMessages />
            </div>
            <div class="sm:flex">
                <div class="items-center hidden mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700">
                    <x-ag.forms.search />
                </div>
                @if(!$importMode)
                    <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                        @can('create')
                            <x-ag.button.a-link href="{{ route('backend.fahrzeuge.create') }}" class="py-2.5 px-5 text-xs font-medium text-gray-900 bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-primary-700 focus:text-primary-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center duration-300">
                                <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ __('add new Vehicles') }}
                            </x-ag.button.a-link>
                            <x-ag.button.button wire:click="import">
                                <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M48 448V64c0-8.8 7.2-16 16-16H224v80c0 17.7 14.3 32 32 32h80V448c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16zM64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V154.5c0-17-6.7-33.3-18.7-45.3L274.7 18.7C262.7 6.7 246.5 0 229.5 0H64zm90.9 233.3c-8.1-10.5-23.2-12.3-33.7-4.2s-12.3 23.2-4.2 33.7L161.6 320l-44.5 57.3c-8.1 10.5-6.3 25.5 4.2 33.7s25.5 6.3 33.7-4.2L192 359.1l37.1 47.6c8.1 10.5 23.2 12.3 33.7 4.2s12.3-23.2 4.2-33.7L222.4 320l44.5-57.3c8.1-10.5 6.3-25.5-4.2-33.7s-25.5-6.3-33.7 4.2L192 280.9l-37.1-47.6z"/>
                                </svg>
                                {{ __('Import vehicles') }}
                            </x-ag.button.button>
                        @endcan
                    </div>
                @else
                    <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                        <form action="{{ route('backend.fahrzeuge.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-9">
                                    <input type="file" name="import" aria-label="import" class="block w-full text-sm text-gray-900 border border-gray-300 rounded cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" />
                                </div>
                                <div class="col-span-3">
                                    <x-ag.button.button type="submit" >
                                        Importieren
                                    </x-ag.button.button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <x-ag.main.head>
{{--        @if(count($fahrzeuge) > 0)--}}
            <x-ag.table.table>
                <x-slot:thead>
                    <x-ag.table.th>Int. Fz.-Nr.
                        <x-ag.table.th-sortBy id="vehicles_internal_vehicle_number" field="{{$sortField}}" direction="{{$sortDirection}}" wire:click="sortBy('vehicles_internal_vehicle_number')"/>
                    </x-ag.table.th>
                    <x-ag.table.th>Kennzeichen
                        <x-ag.table.th-sortBy id="vehicles_license_plate" field="{{$sortField}}" direction="{{$sortDirection}}" wire:click="sortBy('vehicles_license_plate')"/>
                    </x-ag.table.th>
                    <x-ag.table.th>HSN
                        <x-ag.table.th-sortBy id="vehicles_hsn" field="{{$sortField}}" direction="{{$sortDirection}}" wire:click="sortBy('vehicles_hsn')"/>
                    </x-ag.table.th>
                    <x-ag.table.th>TSN
                        <x-ag.table.th-sortBy id="vehicles_tsn" field="{{$sortField}}" direction="{{$sortDirection}}" wire:click="sortBy('vehicles_tsn')"/>
                    </x-ag.table.th>
                    <x-ag.table.th>Hersteller
                        <x-ag.table.th-sortBy id="vehicles_brand" field="{{$sortField}}" direction="{{$sortDirection}}" wire:click="sortBy('vehicles_brand')"/>
                    </x-ag.table.th>
                    <x-ag.table.th>Model
                        <x-ag.table.th-sortBy id="vehicles_model" field="{{$sortField}}" direction="{{$sortDirection}}" wire:click="sortBy('vehicles_model')"/>
                    </x-ag.table.th>
                    <x-ag.table.th>Baujahr
                        <x-ag.table.th-sortBy id="vehicles_first_registration" field="{{$sortField}}" direction="{{$sortDirection}}" wire:click="sortBy('vehicles_first_registration')"/>
                    </x-ag.table.th>
                    <x-ag.table.th>Kilometerstand
                        <x-ag.table.th-sortBy id="vehicles_mileage" field="{{$sortField}}" direction="{{$sortDirection}}" wire:click="sortBy('vehicles_mileage')"/>
                    </x-ag.table.th>
                    <x-ag.table.th class="w-[100px]"></x-ag.table.th>
                </x-slot:thead>
                <x-slot:tbody>
                    @forelse($fahrzeuge as $key => $fahrzeug)
                        <x-ag.table.tr class="text-sm">
                            <td class="p-2 cursor-pointer" wire:click="edit({{ $fahrzeug->id }})">{{ $fahrzeug->vehicles_internal_vehicle_number }}</td>
                            <td class="p-2 cursor-pointer" wire:click="edit({{ $fahrzeug->id }})">{{ $fahrzeug->vehicles_license_plate }}</td>
                            <td class="p-2 cursor-pointer" wire:click="edit({{ $fahrzeug->id }})">{{ $fahrzeug->vehicles_hsn }}</td>
                            <td class="p-2 cursor-pointer" wire:click="edit({{ $fahrzeug->id }})">{{ $fahrzeug->vehicles_tsn }}</td>
                            <td class="p-2 cursor-pointer" wire:click="edit({{ $fahrzeug->id }})">{{ $fahrzeug->vehicles_brand }}</td>
                            <td class="p-2 cursor-pointer" wire:click="edit({{ $fahrzeug->id }})">{{ $fahrzeug->vehicles_model }}</td>
                            <td class="p-2 cursor-pointer" wire:click="edit({{ $fahrzeug->id }})">{{ $fahrzeug->vehicles_first_registration }}</td>
                            <td class="p-2 cursor-pointer" wire:click="edit({{ $fahrzeug->id }})">{{ $fahrzeug->vehicles_mileage }}</td>
                            <td class="p-2 text-right">
                                @can('edit')
                                    <x-ag.button.link wire:click="edit({{ $fahrzeug->id }})" class="px-2 text-blue-500 hover:text-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                        </svg>
                                    </x-ag.button.link>
                                @endcan
                                @can('delete')
                                    <x-ag.button.link wire:click="$emit('triggerDelete',{{ $fahrzeug->id }})" class="px-2 text-red-500 hover:text-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                        </svg>
                                    </x-ag.button.link>
                                @endcan
                            </td>
                        </x-ag.table.tr>
                    @empty
                        <x-ag.table.tr>
                            <td colspan="9" class="p-2 text-center font-bold text-lg">Es wurden noch keine Fahrzeuge angelegt.</td>
                        </x-ag.table.tr>
                    @endforelse
                </x-slot:tbody>
            </x-ag.table.table>
            <div class="w-full p-4 border-t border-gray-200 dark:border-gray-700">
                {{ $fahrzeuge->links() }}
            </div>
            @push('scripts')
                @include('livewire.delete')
            @endpush
{{--        @endif--}}
    </x-ag.main.head>
</div>
