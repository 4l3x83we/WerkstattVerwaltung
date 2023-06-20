<x-ag.card.head>
    <h3 class="mb-4 text-xl font-semibold dark:text-white">Fahrzeugtyp Import</h3>
    @can('create')
        <form action="{{ route('backend.fahrzeuge.brands.models.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-12 sm:col-span-9">
                    <input type="file" name="import" aria-label="import" class="block w-full text-sm text-gray-900 border border-gray-300 rounded cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" />
                </div>
                <div class="col-span-12 sm:col-span-3">
                    <x-ag.button.button type="submit" >
                        Importieren
                    </x-ag.button.button>
                </div>
            </div>
        </form>
    @endcan
</x-ag.card.head>
