<div>
    <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="breadcrumbs mb-4">
                {!! Breadcrumbs::render('permissionEdit', $permission) !!}
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Berechtigung bearbeiten: {{ $permission->name }}</h1>
                <x-ag.errors.errorMessages />
            </div>
            <div class="sm:flex">
                <div class="items-center hidden mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700">

                </div>
                <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                    @can('create')
                        <x-ag.button.button-link href="{{ route('admin.permission.index') }}">
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
                <form wire:submit.prevent="update">
                    <div class="grid grid-cols-1 gap-6">
                        <div class="col-span-1 sm:col-full">
                            <x-ag.forms.label-input id="permission.name" text="Name" />
                        </div>
                        <div class="col-span-1 sm:col-full">
                            <x-ag.button.loading-button target="update" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:text-white dark:hover:bg-primary-700 dark:focus:ring-primary-800 border-0" />
                        </div>
                    </div>
            </x-ag.card.head>
        </div>
    </x-ag.main.head>
</div>
