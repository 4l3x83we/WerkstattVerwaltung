@php use App\Models\Backend\Product\Category; @endphp
<div>
    {{-- Settings --}}
    <form wire:submit.prevent="store" method="POST">
        <input type="hidden" wire:model="categories.id">
        <div class="grid grid-cols-1 p-4 gap-4 dark:bg-gray-900">
            <div class="col-span-1">
                <x-ag.card.head>
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-6 lg:col-span-4">
                            <x-ag.forms.label for="categories.parent_id" text="Hauptkategorie"/>
                            <x-ag.forms.select id="categories.parent_id" stern="true" tabindex="1">
                                <option value="null">Hauptkategorie</option>
                                @foreach($categorie as $category)
                                    <option value="{{ $category->id }}" {{ old('categories.parent_id') == $category->id ? 'selected' : '' }}>{{ $category->category_title }}</option>
                                    @foreach($category->childCategories as $childCategory)
                                        <option value="{{ $childCategory->id }}" {{ old('categories.parent_id') == $childCategory->id ? 'selected' : '' }}>{{ '-- ' . $childCategory->category_title }}</option>
                                    @endforeach
                                @endforeach
                            </x-ag.forms.select>
                        </div>
                        <div class="col-span-6 lg:col-span-4">
                            <x-ag.forms.label-input id="categories.category_title" text="Name" stern="true" tabindex="2"/>
                        </div>
                        <div class="col-span-6 lg:col-span-4">
                            <x-ag.forms.label-input id="categories.category_keywords" text="Keywords" tabindex="3"/>
                        </div>
                        <div class="col-span-6 lg:col-span-4" wire:ignore>
                            <x-ag.forms.textarea data-description="@this" id="category_desc" wire:model.defer="categories.category_desc" text="Beschreibung" tabindex="4"/>
                        </div>
                        <div class="col-span-6 lg:col-span-4">
                            <x-ag.forms.label for="images" text="Bild"/>
                            <x-ag.forms.input-file type="file" id="images" tabindex="5"/>
                        </div>
                        <div class="col-span-6 lg:col-span-4">
                            <x-ag.forms.label for="categories.category_status" stern="true" text="Status"/>
                            <div class="flex py-2.5">
                                <x-ag.forms.checkbox-radio type="radio" id="true" wire:model="categories.category_status" value="true" text="Aktiv" tabindex="6"/>
                                <x-ag.forms.checkbox-radio type="radio" id="false" wire:model="categories.category_status" value="false" text="Inaktiv" tabindex="6"/>
                            </div>
                        </div>
                        {{--<div class="col-span-6 lg:col-span-4">
                            <x-ag.forms.label-input id="categories.category_slug" text="Slug" stern="true" tabindex="7" readonly/>
                        </div>--}}
                        <div class="col-span-12 lg:col-full">
                            <x-ag.button.loading-button text="Speichern" class=""/>
                        </div>
                    </div>
                </x-ag.card.head>
            </div>
        </div>
    </form>


</div>
