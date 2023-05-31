<div>
    <div class="grid grid-cols-1 p-4 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
        <div class="mb-4 col-span-full xl:mb-2">
            <div class="breadcrumbs mb-4">
                {!! Breadcrumbs::render('rollenCreate') !!}
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Benutzerrolle erstellen</h1>
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
        <div class="col-span-full">
            <x-ag.card.head>
                <form wire:submit.prevent="create">
                    <div class="grid grid-cols-1 gap-6">
                        <div class="col-span-1 sm:col-full">
                            <x-ag.forms.label-input id="name" text="Name" />
                        </div>
                        <div class="col-span-1">
                            <x-ag.forms.label for="permission" :text="__('Permissions')" />
                            @foreach($permissions as $permission)
                                <div class="flex items-center mb-2">
                                    <x-ag.forms.input-checkbox id="permission" wire:model="permission.{{ $permission->name }}" value="{{ $permission->name }}" :text="__($permission->name)" />
                                </div>
                            @endforeach
                        </div>
                        <div class="col-span-1 sm:col-full">
                            <x-ag.button.loading-button target="update" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:text-white dark:hover:bg-primary-700 dark:focus:ring-primary-800 border-0" />
                        </div>
                    </div>
                </form>
            </x-ag.card.head>
        </div>
    </div>
</div>
