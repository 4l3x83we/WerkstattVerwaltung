<x-ag.card.head>
    <div class="items-center sm:flex xl:block 2xl:flex sm:space-x-4 xl:space-x-0 2xl:space-x-4">
        @if($user->image)
            <img class="mb-4 rounded w-28 h-28 sm:mb-0 xl:mb-4 2xl:mb-0 object-scale-down object-center {{ $image ?? 'bg-gray-100' }}" src="{{ $image }}" alt="{{ $name ?? 'Profilbild' }}">
        @else
            <div class="mb-4 rounded w-28 h-28 sm:mb-0 xl:mb-4 2xl:mb-0 dark:text-gray-200 dark:hover:bg-gray-700 bg-gray-200 dark:bg-gray-700 leading-none">
                <div class="flex justify-center items-center w-28 h-28 font-bold text-6xl">
                    {{ initials($user) }}
                </div>
            </div>
        @endif
        <div>
            <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">{{ __('Profile picture')}}</h3>
            <div class="mb-4 text-sm text-gray-500 dark:text-gray-400">
                JPG, GIF oder PNG. {{ __('Max size of') }} 800kb
            </div>
            <div class="flex items-center space-x-4">
                @if($uploadPicture === false)
                    @can('edit')
                    <x-ag.button.button wire:click="uploadPicture" class="text-white border-0 bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:text-white dark:focus:ring-primary-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 -ml-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15m0-3l-3-3m0 0l-3 3m3-3V15" />
                        </svg>
                        {{ __('Upload Picture') }}
                    </x-ag.button.button>
                    @endcan
                    @can('delete')
                        <x-ag.button.button wire:click="$emit('triggerDeleteProfilPicture',{{ $upload }})">
                            {{ __('Delete') }}
                        </x-ag.button.button>
                    @endcan
                @else
                    <div class="grid grid-cols-1 gap-4">
                        <div class="col-span-1">
                            <x-ag.forms.input-file type="file" id="images.image" wire:loading.remove/>
                        </div>
                        <div wire:loading wire:target="images.image">
                            <div class="col-span-1">
                                <div class="text-center">
                                    <div role="status">
                                        <svg aria-hidden="true" class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                        </svg>
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-ag.card.head>
