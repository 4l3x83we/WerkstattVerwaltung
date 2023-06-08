<div>
    <div class="grid grid-cols-1 p-4 gap-4 dark:bg-gray-900">
        <div class="col-span-1">
            <x-ag.card.head>
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12">
                        <x-ag.table.table>
                            <x-slot:tbody>
                                @if($category->id)
                                    <x-ag.table.tr>
                                        <x-ag.table.th>ID</x-ag.table.th>
                                        <td class="p-2 whitespace-nowrap">{{ $category->id }}</td>
                                    </x-ag.table.tr>
                                @endif
                                @if($category->category_title)
                                    <x-ag.table.tr>
                                        <x-ag.table.th>Titel</x-ag.table.th>
                                        <td class="p-2 whitespace-nowrap">{{ $category->category_title }}</td>
                                    </x-ag.table.tr>
                                @endif
                                @if($category->category_keywords)
                                    <x-ag.table.tr>
                                        <x-ag.table.th>Schlüsselwörter</x-ag.table.th>
                                        <td class="p-2 whitespace-nowrap">{{ $category->category_keywords }}</td>
                                    </x-ag.table.tr>
                                @endif
                                @if($category->category_desc)
                                    <x-ag.table.tr>
                                        <x-ag.table.th>Beschreibung</x-ag.table.th>
                                        <td class="p-2 whitespace-nowrap">{{ $category->category_desc }}</td>
                                    </x-ag.table.tr>
                                @endif
                                @if($category->category_image)
                                    <x-ag.table.tr>
                                        <x-ag.table.th>Bild</x-ag.table.th>
                                        <td class="p-2 whitespace-nowrap">
                                            <img src="{{ asset($category->category_image) }}" alt="{{ $category->category_title }}" class="w-64 object-scale-down object-center"/>
                                        </td>
                                    </x-ag.table.tr>
                                @endif
                                @if($category->category_status)
                                    <x-ag.table.tr>
                                        <x-ag.table.th>Status</x-ag.table.th>
                                        <td class="p-2 whitespace-nowrap">{!! $category->categoryStatus() !!}</td>
                                    </x-ag.table.tr>
                                @endif
                                @if($category->category_slug)
                                    <x-ag.table.tr>
                                        <x-ag.table.th>Slug</x-ag.table.th>
                                        <td class="p-2 whitespace-nowrap">{{ $category->category_slug }}</td>
                                    </x-ag.table.tr>
                                @endif
                            </x-slot:tbody>
                        </x-ag.table.table>
                    </div>
                    <div class="col-span-12">
                        <div class="flex justify-end items-center">
                            <x-ag.button.a-link href="{{ route('backend.kategorie.index') }}" class="py-2.5 px-5 text-xs font-medium text-gray-900 bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-primary-700 focus:text-primary-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center duration-300">
                                Zurück
                            </x-ag.button.a-link>
                        </div>
                    </div>
                </div>
            </x-ag.card.head>
        </div>
    </div>
</div>
