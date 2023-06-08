@php use App\Models\Backend\Product\Category; @endphp
<div>
    {{-- Settings --}}
    <form wire:submit.prevent="store" method="POST">
        <input type="hidden" wire:model="categories.id">
        <div class="grid grid-cols-1 p-4 gap-4 dark:bg-gray-900">
            <div class="col-span-1">
                <x-ag.card.head>
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-6 sm:col-span-4" wire:ignore>
                            <x-ag.forms.label for="categories.parent_id" text="Hauptkategorie"/>
                            <x-ag.forms.select id="categories.parent_id" stern="true" tabindex="1">
                                <option value="null" wire:key="{{ $productCategory->parent_id }}">Hauptkategorie</option>
                                @foreach($categorie as $category)
                                    @if($productCategory->id !== $category->id)
                                        <option value="{{ $category->id }}" wire:key="{{ $productCategory->parent_id }}">{{ $category->category_title }}</option>
                                        @foreach($category->childCategories as $childCategory)
                                            @if($productCategory->id !== $childCategory->id)
                                                <option value="{{ $childCategory->id }}" wire:key="{{ $productCategory->parent_id }}">{{ '-- ' . $childCategory->category_title }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </x-ag.forms.select>
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <x-ag.forms.label-input id="categories.category_title" text="Name" stern="true" tabindex="2"/>
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <x-ag.forms.label-input id="categories.category_keywords" text="Keywords" tabindex="3"/>
                        </div>
                        <div class="col-span-6 sm:col-span-4" wire:ignore>
                            <x-ag.forms.textarea data-description="@this" id="category_desc" wire:model.defer="categories.category_desc" text="Beschreibung" tabindex="4"/>
                        </div>
                        @if($categories->category_image)
                            @if($imageChange)
                                <div class="col-span-6 sm:col-span-4">
                                    <x-ag.forms.label for="images" text="Bild"/>
                                    <x-ag.forms.input-file type="file" id="images" tabindex="5"/>
                                    <div class="flex justify-center items-center mt-4" wire:loading>
                                        <div role="status">
                                            <svg aria-hidden="true" class="inline w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                            </svg>
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-span-6 sm:col-span-4">
                                    <div class="grid grid-cols-12 gap-4">
                                        <div class="col-span-6">
                                            <img src="{{ asset($categories->category_image) }}" alt="{{ $categories->category_title }}" class="w-36">
                                        </div>
                                        <div class="col-span-6">
                                            <div class="flex justify-end space-x-4">
                                            <x-ag.button.link type="button" wire:click="editImage" class="px-2 text-blue-500 hover:text-blue-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                                </svg>
                                            </x-ag.button.link>
                                            <x-ag.button.link type="button" wire:click="$emit('triggerDeleteProfilPicture',{{ $productCategory->id }})" class="px-2 text-red-500 hover:text-red-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                                </svg>
                                            </x-ag.button.link>
                                            </div>
                                        </div>
                                        @if($imageLoad)
                                        <div class="flex justify-center items-center mt-4">
                                            <div role="status">
                                                <svg aria-hidden="true" class="inline w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                                </svg>
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                @push('scripts')
                                    @include('livewire.delete')
                                @endpush
                            @endif
                        @else
                            <div class="col-span-6 sm:col-span-4">
                                <x-ag.forms.label for="images" text="Bild"/>
                                <x-ag.forms.input-file type="file" id="images" tabindex="5"/>
                                <div class="flex justify-center items-center mt-4" wire:loading>
                                    <div role="status">
                                        <svg aria-hidden="true" class="inline w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                                        </svg>
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-span-6 sm:col-span-4">
                            <x-ag.forms.label for="categories.category_status" stern="true" text="Status"/>
                            <div class="flex py-2.5">
                                <x-ag.forms.checkbox-radio type="radio" id="true" wire:model="categories.category_status" value="true" text="Aktiv" tabindex="6"/>
                                <x-ag.forms.checkbox-radio type="radio" id="false" wire:model="categories.category_status" value="false" text="Inaktiv" tabindex="6"/>
                            </div>
                        </div>
                        {{--<div class="col-span-6 sm:col-span-4">
                            <x-ag.forms.label-input id="categories.category_slug" text="Slug" stern="true" tabindex="7" readonly/>
                        </div>--}}
                        <div class="col-span-12 sm:col-full">
                            <x-ag.button.loading-button text="Speichern" class=""/>
                        </div>
                    </div>
                </x-ag.card.head>
            </div>
        </div>
    </form>
</div>
