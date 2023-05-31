<x-app-layout>
    <div class="grid grid-cols-1 p-4 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
        <div class="mb-4 col-span-full xl:mb-2">
            <div class="breadcrumbs mb-4">
                {!! Breadcrumbs::render('dashboard') !!}
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Dashboard</h1>
            </div>
            <x-ag.errors.errorMessages />
        </div>
    </div>

</x-app-layout>
