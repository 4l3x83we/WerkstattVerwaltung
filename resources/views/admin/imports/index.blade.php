<x-app-layout>

    <div class="grid grid-cols-1 p-4 pb-0 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
        <div class="mb-4 col-span-full xl:mb-2">
            <div class="breadcrumbs">
                {!! Breadcrumbs::render('import') !!}
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Imports</h1>
                <x-ag.errors.errorMessages />
            </div>
        </div>
    </div>
    <x-ag.main.head>
        <div class="grid grid-cols-1 xl:grid-cols-3 p-4 pb-0 gap-4 dark:bg-gray-900">
            <div class="col-span-1">
                @include('admin.imports.brandsImport')
            </div>
            <div class="col-span-1">
                @include('admin.imports.modelsImport')
            </div>
            <div class="col-span-1">
                @include('admin.imports.brandsModelsImport')
            </div>
        </div>
    </x-ag.main.head>

</x-app-layout>
