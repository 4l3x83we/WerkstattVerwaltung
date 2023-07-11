@php use Carbon\Carbon; @endphp
<x-emails.base subject="Werkstatt Tool Registrierung abgeschlossen">

    <table class="lg:w-full font-sans shadow-xl rounded bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-200">
        <tr>
            <td class="p-6">
                <h2 class="text-2xl leading-7 mt-2 mb-3">Die Registrierung des Benutzers "{!! $user->name !!}" ist
                    abgeschlossen.</h2>
                <table class="w-[600px] lg:w-full">
                    @if($user->name)
                        <tr>
                            <td class="w-4/12">Name:</td>
                            <td class="w-8/12">{{ $user->name }}</td>
                        </tr>
                    @endif
                    @if($user->strasse)
                        <tr>
                            <td class="w-4/12">Straße:</td>
                            <td class="w-8/12">{{ $user->strasse }}</td>
                        </tr>
                    @endif
                    @if($user->plz and $user->ort)
                        <tr>
                            <td class="w-4/12">PLZ/Ort:</td>
                            <td class="w-8/12">{{ $user->plz . ' ' . $user->ort }}</td>
                        </tr>
                    @endif
                    @if(isset($user->telefon))
                        <tr>
                            <td class="w-4/12">Telefon:</td>
                            <td class="w-8/12">{{ $user->telefon }}</td>
                        </tr>
                    @endif
                    @if(isset($user->mobil))
                        <tr>
                            <td class="w-4/12">Mobiltelefon:</td>
                            <td class="w-8/12">{{ $user->mobil }}</td>
                        </tr>
                    @endif
                    @if($user->geburtstag)
                        <tr>
                            <td class="w-4/12">Geburtstag:</td>
                            <td class="w-8/12">{{ Carbon::parse($user->geburtstag)->format('d.m.Y') . ' / Alter: ' . Carbon::parse($user->geburtstag)->age }}</td>
                        </tr>
                    @endif
                </table>
            </td>
        </tr>
        @if(isset($user->image))
        <tr>
            <td class="text-center">
                <img class="rounded-b object-center object-cover w-full h-full" src="{{ asset($user->image) }}" alt="">
            </td>
        </tr>
        @endif
    </table>

</x-emails.base>
