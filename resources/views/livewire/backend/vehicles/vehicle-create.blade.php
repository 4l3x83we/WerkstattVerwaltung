<div>
    <div class="grid grid-cols-1 p-4 pb-0 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
        <div class="mb-4 col-span-full xl:mb-2">
            <div class="breadcrumbs">
                {!! Breadcrumbs::render('vehiclesCreate') !!}
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Neues Fahrzeug anlegen</h1>
                <x-ag.errors.errorMessages />
            </div>
        </div>
    </div>
    <x-ag.main.head>

    </x-ag.main.head>
</div>
