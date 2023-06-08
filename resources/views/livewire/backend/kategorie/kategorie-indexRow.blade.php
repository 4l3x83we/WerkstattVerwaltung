<x-ag.table.tr>
    <td class="p-2 cursor-pointer whitespace-nowrap" wire:click="show({{ $productCategory->id }})">{{ $productCategory->id ?? '' }}</td>
    <td class="p-2 cursor-pointer whitespace-nowrap" wire:click="show({{ $productCategory->id }})">{{ $prefix ?? '' }} {{ $productCategory->category_title ?? '' }}</td>
    <td class="p-2 cursor-pointer whitespace-nowrap" wire:click="show({{ $productCategory->id }})">{{ $productCategory->parentCategory->category_title ?? '' }}</td>
    <td class="p-2 cursor-pointer whitespace-nowrap" wire:click="show({{ $productCategory->id }})">{{ $productCategory->category_keywords ?? '' }}</td>
    <td class="p-2 cursor-pointer overflow-hidden text-base font-normal truncate max-w-sm xl:max-w-xs" wire:click="show({{ $productCategory->id }})">{{ $productCategory->category_desc ?? '' }}</td>
    <td class="p-2 cursor-pointer whitespace-nowrap">
        @if($productCategory->category_image)
            <a href="{{ url($productCategory->category_image) }}" target="_blank">
                <img src="{{ asset($productCategory->category_image) }}" alt="" class="w-[75px] max-w-xs h-auto object-scale-down object-center">
            </a>
        @endif
    </td>
    <td class="p-2 cursor-pointer whitespace-nowrap" wire:click="show({{ $productCategory->id }})">{!! $productCategory->categoryStatus() ?? '' !!}</td>
    <td class="p-2 whitespace-nowrap text-right">
        @can('edit')
            <x-ag.button.link wire:click="edit({{ $productCategory->id }})" class="px-2 text-blue-500 hover:text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                </svg>
            </x-ag.button.link>
        @endcan
        @can('delete')
            <x-ag.button.link wire:click="$emit('triggerDelete',{{ $productCategory->id }})" class="px-2 text-red-500 hover:text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                </svg>
            </x-ag.button.link>
        @endcan
    </td>
</x-ag.table.tr>
