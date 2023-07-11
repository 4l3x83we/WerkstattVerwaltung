<div class="col-span-2">
    {{-- weitere Daten --}}
    <x-ag.card.head>
        <h3 class="mb-4 text-xl font-semibold dark:text-white">weitere Fahrzeugdaten</h3>
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12 lg:col-span-6">
                <x-ag.forms.inline-label-input id="furtherData.vehicles_color" text="Farbe" />
            </div>
            <div class="col-span-12 lg:col-span-6">
                <x-ag.forms.inline-label-input id="furtherData.vehicles_color_code" text="Farbcode" />
            </div>
            <div class="col-span-12 lg:col-span-6">
                <x-ag.forms.inline-label-input id="furtherData.vehicles_upholstery_type" text="Polsterart" />
            </div>
            <div class="col-span-12 lg:col-span-6">
                <x-ag.forms.inline-label-input id="furtherData.vehicles_upholstery_color" text="Polsterfarbe" />
            </div>
            <div class="col-span-12 lg:col-span-6">
                <x-ag.forms.inline-label-input id="furtherData.vehicles_radio_code" text="Radiocode" />
            </div>
            <div class="col-span-12 lg:col-span-6">
                <x-ag.forms.inline-label-input id="furtherData.vehicles_key_number" text="Schlüsselnummer" />
            </div>
            <div class="col-span-12 lg:col-span-4">
                <x-ag.forms.inline-label-input type="number" id="furtherData.vehicles_seats" text="Sitzplätze" />
            </div>
            <div class="col-span-12 lg:col-span-4">
                <x-ag.forms.inline-label-input type="number" id="furtherData.vehicles_doors" text="Türen" />
            </div>
            <div class="col-span-12 lg:col-span-4">
                <x-ag.forms.inline-label-input type="number" id="furtherData.vehicles_sleeping_places" text="Schlafplätze" />
            </div>
            <div class="col-span-12 lg:col-span-4">
                <x-ag.forms.inline-label-input type="number" id="furtherData.vehicles_axles" text="Achsen" />
            </div>
            <div class="col-span-12 lg:col-span-4">
                <x-ag.forms.inline-label-input type="number" id="furtherData.vehicles_number_of_gears" text="Anzahl der Gänge" />
            </div>
            <div class="col-span-12 lg:col-span-4">
                <x-ag.forms.inline-label-input type="number" id="furtherData.vehicles_cylinder" text="Zylinder" />
            </div>
            <div class="col-span-6 lg:col-span-3">
                <div class="flex justify-start items-center h-[38px]">
                <x-ag.forms.label class="!mb-0" for="furtherData.vehicles_curb_weight" text="Leer/Nutz/Ges.-gewicht"/>
                </div>
            </div>
            <div class="col-span-6 lg:col-span-3">
                <x-ag.forms.input type="number" id="furtherData.vehicles_curb_weight" text="Leergewicht" />
            </div>
            <div class="col-span-6 lg:col-span-3">
                <x-ag.forms.input type="number" id="furtherData.vehicles_payload" text="Nutzgewicht" />
            </div>
            <div class="col-span-6 lg:col-span-3">
                <x-ag.forms.input type="number" id="furtherData.vehicles_total_weight" text="Gesamtgewicht" />
            </div>
            <div class="col-span-6 lg:col-span-3">
                <div class="flex justify-start items-center h-[38px]">
                <x-ag.forms.label class="!mb-0" for="furtherData.vehicles_length" text="Länge/Breite/Höhe"/>
                </div>
            </div>
            <div class="col-span-6 lg:col-span-3">
                <x-ag.forms.input type="number" id="furtherData.vehicles_length" text="Länge" />
            </div>
            <div class="col-span-6 lg:col-span-3">
                <x-ag.forms.input type="number" id="furtherData.vehicles_broad" text="Breite" />
            </div>
            <div class="col-span-6 lg:col-span-3">
                <x-ag.forms.input type="number" id="furtherData.vehicles_height" text="Höhe" />
            </div>
        </div>
    </x-ag.card.head>
</div>
