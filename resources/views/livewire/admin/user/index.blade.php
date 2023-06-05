<div>
    <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="breadcrumbs mb-4">
                {!! Breadcrumbs::render('benutzer') !!}
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Benutzerübersicht</h1>
                <x-ag.errors.errorMessages />
            </div>
            <div class="sm:flex">
                <div class="items-center hidden mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700">
                    <x-ag.forms.search />
                </div>
                <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                    @can('create')
                        <x-ag.button.button wire:click="create()">
                            <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ __('Add user') }}
                        </x-ag.button.button>
                    @endcan
                    @can('edit')
                        <x-ag.button.button wire:click="export()">
                            <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 384 512" xmlns="http://www.w3.org/2000/svg">
                                <path d="M48 448V64c0-8.8 7.2-16 16-16H224v80c0 17.7 14.3 32 32 32h80V448c0 8.8-7.2 16-16 16H64c-8.8 0-16-7.2-16-16zM64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V154.5c0-17-6.7-33.3-18.7-45.3L274.7 18.7C262.7 6.7 246.5 0 229.5 0H64zm90.9 233.3c-8.1-10.5-23.2-12.3-33.7-4.2s-12.3 23.2-4.2 33.7L161.6 320l-44.5 57.3c-8.1 10.5-6.3 25.5 4.2 33.7s25.5 6.3 33.7-4.2L192 359.1l37.1 47.6c8.1 10.5 23.2 12.3 33.7 4.2s12.3-23.2 4.2-33.7L222.4 320l44.5-57.3c8.1-10.5 6.3-25.5-4.2-33.7s-25.5-6.3-33.7 4.2L192 280.9l-37.1-47.6z"/>
                            </svg>
                            {{ __('Export User') }}
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
                    {{ __('Email') }}
                </x-ag.table.th>
                <x-ag.table.th>
                    {{ __('Roles') }}
                </x-ag.table.th>
                <x-ag.table.th />
            </x-slot:thead>
            <x-slot:tbody>
                @forelse($users as $key => $user)
                    <x-ag.table.tr>
                        <td class="p-2 cursor-pointer" wire:click="show({{ $user->id }})">{{ $key + 1 }}</td>
                        <td class="p-2 cursor-pointer" wire:click="show({{ $user->id }})">{{ $user->name }}</td>
                        <td class="p-2 cursor-pointer" wire:click="show({{ $user->id }})">{{ $user->email }}</td>
                        <td class="p-2 cursor-pointer" wire:click="show({{ $user->id }})">
                            @foreach($user->roles as $role)
                                <div class="inline-flex mb-2 xl:mb-0">
                                    <x-ag.badge color="blue">{{ $role->name }}</x-ag.badge>
                                </div>
                            @endforeach
                        </td>
                        <td class="p-2 text-right">
                            @can('delete')
                                <x-ag.button.link wire:click="$emit('triggerDelete',{{ $user->id }})" class="px-2 text-red-500 hover:text-red-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                    </svg>
                                </x-ag.button.link>
                            @endcan
                        </td>
                    </x-ag.table.tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-2 text-center font-bold text-lg">{{ __('No user found.') }}</td>
                    </tr>
                @endforelse
            </x-slot:tbody>
        </x-ag.table.table>
        {{ $users->links() }}
        @push('scripts')
            @include('livewire.delete')
        @endpush
    </x-ag.main.head>
</div>
