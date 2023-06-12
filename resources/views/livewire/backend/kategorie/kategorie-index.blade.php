@php use App\Http\Controllers\Backend\Product\CategoryController; @endphp
<div>


    <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="breadcrumbs mb-4">
                {!! Breadcrumbs::render('category') !!}
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Kategorien</h1>
                <x-ag.errors.errorMessages />
            </div>
            <div class="sm:flex">
                <div class="items-center hidden mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700">
                    <x-ag.forms.search />
                </div>
                @if(!$importMode)
                <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                    @can('create')
                        <x-ag.button.a-link href="{{ route('backend.kategorie.create') }}" class="py-2.5 px-5 text-xs font-medium text-gray-900 bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-primary-700 focus:text-primary-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center duration-300">
                            <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ __('add Category') }}
                        </x-ag.button.a-link>
                        <x-ag.button.button wire:click="import">
                            <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg">
                                <path d="M48 448V64c0-8.8 7.2-16 16-16H224v80c0 17.7 14.3 32 32 32h80V448c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16zM64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V154.5c0-17-6.7-33.3-18.7-45.3L274.7 18.7C262.7 6.7 246.5 0 229.5 0H64zm90.9 233.3c-8.1-10.5-23.2-12.3-33.7-4.2s-12.3 23.2-4.2 33.7L161.6 320l-44.5 57.3c-8.1 10.5-6.3 25.5 4.2 33.7s25.5 6.3 33.7-4.2L192 359.1l37.1 47.6c8.1 10.5 23.2 12.3 33.7 4.2s12.3-23.2 4.2-33.7L222.4 320l44.5-57.3c8.1-10.5 6.3-25.5-4.2-33.7s-25.5-6.3-33.7 4.2L192 280.9l-37.1-47.6z"/>
                            </svg>
                            {{ __('Import categories') }}
                        </x-ag.button.button>
                    @endcan
                </div>
                @else
                <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                    <form action="{{ route('backend.kategorie.import') }}" method="POST" enctype="multipart/form-data">
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
    {{--    @if(count($categorye) > 0)--}}
    <x-ag.table.table>
        <x-slot:thead>
            <x-ag.table.th>#</x-ag.table.th>
            <x-ag.table.th>Titel
                <x-ag.table.th-sortBy id="category_title" :field="$sortField" :direction="$sortDirection" wire:click="sortBy('category_title')"/>
            </x-ag.table.th>
            <x-ag.table.th>Kategorie
                <x-ag.table.th-sortBy id="category_title" :field="$sortField" :direction="$sortDirection" wire:click="sortBy('category_title')"/>
            </x-ag.table.th>
            <x-ag.table.th>Suchwörter
                <x-ag.table.th-sortBy id="category_keywords" :field="$sortField" :direction="$sortDirection" wire:click="sortBy('category_keywords')"/>
            </x-ag.table.th>
            <x-ag.table.th>Beschreibung
                <x-ag.table.th-sortBy id="category_desc" :field="$sortField" :direction="$sortDirection" wire:click="sortBy('category_desc')"/>
            </x-ag.table.th>
            <x-ag.table.th>Bild
                <x-ag.table.th-sortBy id="category_image" :field="$sortField" :direction="$sortDirection" wire:click="sortBy('category_image')"/>
            </x-ag.table.th>
            <x-ag.table.th>Status
                <x-ag.table.th-sortBy id="category_status" :field="$sortField" :direction="$sortDirection" wire:click="sortBy('category_status')"/>
            </x-ag.table.th>
            <x-ag.table.th></x-ag.table.th>
        </x-slot:thead>
        <x-slot:tbody>
            @forelse($categories as $key => $productCategory)

                @include('livewire.backend.kategorie.kategorie-indexRow', compact('productCategory'))

                @foreach($productCategory->childCategories as $childCategory)

                    @include('livewire.backend.kategorie.kategorie-indexRow', ['productCategory' => $childCategory, 'prefix' => '--'])

                    @foreach($childCategory->childCategories as $childCategory)
                        @include('livewire.backend.kategorie.kategorie-indexRow', ['productCategory' => $childCategory, 'prefix' => '----'])
                    @endforeach

                @endforeach

            @empty
                <x-ag.table.tr>
                    <td colspan="8" class="p-2 text-center font-bold text-lg">Es wurde keine Kategorie gefunden.</td>
                </x-ag.table.tr>
            @endforelse
        </x-slot:tbody>
    </x-ag.table.table>
        <div class="w-full p-4 border-t border-gray-200 dark:border-gray-700">
            {{ $categories->links() }}
        </div>
    @push('scripts')
        @include('livewire.delete')
    @endpush
    {{--    @endif--}}
    </x-ag.main.head>
</div>
