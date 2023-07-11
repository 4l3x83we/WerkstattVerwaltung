<div>
    <div class="p-4 bg-white block lg:flex items-center justify-between border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="breadcrumbs mb-4">
                {!! Breadcrumbs::render('permission') !!}
                <h1 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">Berechtigungen Übersicht</h1>
                <x-ag.errors.errorMessages />
            </div>
            <div class="lg:flex">
                <div class="items-center hidden mb-3 lg:flex">
                    <x-ag.forms.search />
                </div>
                <div class="flex items-center ml-auto space-x-2 lg:space-x-3">
                    @can('create')
                        <x-ag.button.button wire:click="create()">
                            <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ __('Add New Permission') }}
                        </x-ag.button.button>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <x-ag.main.head>
        <x-ag.table.table>
            <x-slot:thead>
                <x-ag.table.th>
                    {{ __('#') }}
                </x-ag.table.th>
                <x-ag.table.th>
                    {{ __('Name') }}
                </x-ag.table.th>
                <x-ag.table.th>
                    {{ __('Permissions') }}
                </x-ag.table.th>
            </x-slot:thead>
            <x-slot:tbody>
                @forelse($permissions as $key => $permission)
                    <x-ag.table.tr>
                        <td class="p-2 cursor-pointer" wire:click="edit({{ $permission->id }})">{{ $key + 1 }}</td>
                        <td class="p-2 cursor-pointer" wire:click="edit({{ $permission->id }})">{{ __($permission->name) }}</td>
                        <td class="p-2 cursor-pointer" wire:click="edit({{ $permission->id }})">{{ $permission->guard_name }}</td>
                    </x-ag.table.tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-2 text-center font-bold text-lg">{{ __('No permissions found.') }}</td>
                    </tr>
                @endforelse
            </x-slot:tbody>
        </x-ag.table.table>
    </x-ag.main.head>
</div>
