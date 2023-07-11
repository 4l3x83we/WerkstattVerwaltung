<x-app-layout>

    <div class="grid grid-cols-1 p-4 pb-0 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
        <div class="mb-4 col-span-full xl:mb-2">
            <div class="breadcrumbs">
                {!! Breadcrumbs::render('categoryCreate') !!}
                <h1 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">Kategorie anlegen</h1>
                <x-ag.errors.errorMessages />
            </div>
        </div>
    </div>
    <x-ag.main.head>
        @livewire('backend.kategorie.kategorie-create')
    </x-ag.main.head>

</x-app-layout>
