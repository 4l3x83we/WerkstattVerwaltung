@extends('layouts.single')
@section('content')
<div>
    <div class="flex flex-col justify-center items-center px-6 mx-auto h-screen xl:px-0 dark:bg-gray-900">
        <x-ag.card.head>

            <form action="{{ route('register.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <x-ag.forms.label-input id="strasse" text="Straße" value="{{ old('straße') ?? $user->strasse }}" stern="true" />
                    </div>
                    <div class="col-span-1 sm:col-full">
                        <x-ag.forms.label-input id="plz" text="Postleitzahl" value="{{ old('plz') ?? $user->plz }}" stern="true" />
                    </div>
                    <div class="col-span-1 sm:col-full">
                        <x-ag.forms.label-input id="ort" text="Ort" value="{{ old('ort') ?? $user->ort }}" stern="true" />
                    </div>
                    <div class="col-span-2">
                        <x-ag.forms.label-input type="tel" id="telefon" value="{{ old('telefon') ?? $user->telefon }}" text="Telefon" />
                    </div>
                    <div class="col-span-2">
                        <x-ag.forms.label-input type="tel" id="mobil" value="{{ old('mobil') ?? $user->mobil }}" text="Mobil" />
                    </div>
                    <div class="col-span-2">
                        <x-ag.forms.label-input type="date" id="geburtstag" value="{{ old('geburtstag') ?? $user->geburtstag }}" text="Geburtstag" stern="true" />
                    </div>
                    @if(!$user->image)
                    <div class="col-span-2">
                        <x-ag.forms.label id="image" text="Profilbild" />
                        <x-ag.forms.input-file type="file" id="image" text="Profilbild" />
                    </div>
                    @endif
                    <div class="col-span-2">
                        <x-ag.button.loading-button target="update" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:text-white dark:hover:bg-primary-700 dark:focus:ring-primary-800 border-0"/>
                    </div>
                </div>
            </form>

        </x-ag.card.head>
</div>
@endsection
