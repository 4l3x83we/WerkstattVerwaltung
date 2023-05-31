<div>
    <div class="grid grid-cols-1 p-4 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
        <div class="mb-4 col-span-full xl:mb-2">
            <div class="breadcrumbs mb-4">
                {!! Breadcrumbs::render('benutzerCreate') !!}
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Benutzer erstellen</h1>
                <x-ag.errors.errorMessages />
            </div>
            <div class="sm:flex">
                <div class="items-center hidden mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700">
                    {{--<x-ag.forms.search />--}}
                </div>
                <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                    @can('create')
                        <x-ag.button.button-link href="{{ route('admin.users.index') }}">
                            <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                <path d="M48.5 224H40c-13.3 0-24-10.7-24-24V72c0-9.7 5.8-18.5 14.8-22.2s19.3-1.7 26.2 5.2L98.6 96.6c87.6-86.5 228.7-86.2 315.8 1c87.5 87.5 87.5 229.3 0 316.8s-229.3 87.5-316.8 0c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0c62.5 62.5 163.8 62.5 226.3 0s62.5-163.8 0-226.3c-62.2-62.2-162.7-62.5-225.3-1L185 183c6.9 6.9 8.9 17.2 5.2 26.2s-12.5 14.8-22.2 14.8H48.5z"/>
                            </svg>
                            {{ __('Back') }}
                        </x-ag.button.button-link>
                    @endcan
                </div>
            </div>
        </div>
        <div class="col-span-full">
            <x-ag.card.head>
                <h3 class="mb-4 text-xl font-semibold dark:text-white">{{ __('Create new user') }}</h3>
                <form wire:submit.prevent="create">
                    <div class="grid grid-cols-6 gap-4">
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label-input id="user.name" text="Name" stern="true"/>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label-input type="email" id="email" :text="__('E-Mail Address')" stern="true"/>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label-input id="user.strasse" text="Straße" stern="true"/>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label-input id="user.plz" text="Postleitzahl" stern="true"/>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label-input id="user.ort" text="Ort" stern="true"/>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label-input type="tel" id="user.telefon" text="Telefon"/>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label-input type="tel" id="user.mobil" text="Mobiltelefon"/>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label-input type="date" id="user.geburtstag" text="Geburtstag"/>
                        </div>
                        <div class="col-span-6 sm:col-full">
                            <x-ag.button.loading-button target="create" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:text-white dark:hover:bg-primary-700 dark:focus:ring-primary-800 border-0"/>
                        </div>
                    </div>
                </form>
            </x-ag.card.head>
        </div>
    </div>
</div>
