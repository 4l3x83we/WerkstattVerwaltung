<div>
    <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="breadcrumbs mb-4">
                {!! Breadcrumbs::render('rollenShow', $role) !!}
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Benutzerrolle {{ __($role->name) }}</h1>
                <x-ag.errors.errorMessages />
            </div>
            <div class="sm:flex">
                <div class="items-center hidden mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700">

                </div>
                <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                    @can('create')
                        <x-ag.button.button-link href="{{ route('admin.roles.index') }}">
                            <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ __('Back') }}
                        </x-ag.button.button-link>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <x-ag.main.head>
        <div class="p-4">
            <x-ag.card.head>
                @if(!$updateMode)
                    <div class="grid grid-cols-1 gap-6">
                        <div class="col-span-1 sm:col-full">
                            <x-ag.table.table>
                                <x-slot:thead>
                                    <x-ag.table.th>{{ __('Name') }}</x-ag.table.th>
                                    <x-ag.table.th>{{ __('Guard') }}</x-ag.table.th>
                                </x-slot:thead>
                                <x-slot:tbody>
                                    @forelse($rolePermissions as $permission)
                                        <x-ag.table.tr>
                                            <td class="p-2 cursor-pointer" wire:click="showPermission({{  $permission->id }})">{{ __($permission->name) }}</td>
                                            <td class="p-2 cursor-pointer" wire:click="showPermission({{  $permission->id }})">{{ $permission->guard_name }}</td>
                                        </x-ag.table.tr>
                                    @empty
                                        <x-ag.table.tr>
                                            <td colspan="2" class="p-2">{{ __('No permissions found.') }}</td>
                                        </x-ag.table.tr>
                                    @endforelse
                                </x-slot:tbody>
                            </x-ag.table.table>
                        </div>
                        @hasanyrole('super_admin|admin')
                            <div class="col-span-1 sm:col-full">
                                <x-ag.button.button wire:click="edit()">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 -ml-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                    </svg>
                                    {{ __('Edit') }}
                                </x-ag.button.button>
                            </div>
                        @endhasanyrole
                    </div>
                @else
                <form wire:submit.prevent="update">
                    <div class="grid grid-cols-1 gap-6">
                        <div class="col-span-1 sm:col-full">
                            <x-ag.forms.label-input id="role.name" text="Name" />
                        </div>
                        <div class="col-span-1">
                            <x-ag.forms.label id="permissions" :text="__('Permissions')" />
                            @foreach($permissions as $permission)
                                <div class="flex items-center mb-2">
                                    <x-ag.forms.input-checkbox id="role-{{ $permission->name }}" wire:model="permissionCheck" value="{{ $permission->name }}" :text="$permission->name" />
                                </div>
                            @endforeach
                        </div>
                        <div class="col-span-1 sm:col-full">
                            <x-ag.button.loading-button target="update" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:text-white dark:hover:bg-primary-700 dark:focus:ring-primary-800 border-0" />
                        </div>
                    </div>
                </form>
                @endif
            </x-ag.card.head>
        </div>
    </x-ag.main.head>
</div>
