@php use Carbon\Carbon; @endphp
<x-emails.base subject="Dein neuer Benutzeraccount bei {{ env('APP_NAME') }} wurde durch einen Admin angelegt.">

    <table class="sm:w-full font-sans shadow-xl rounded bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-200">
        <tr>
            <td class="p-6">
                <div>
                    Hallo {{ $user['name'] }},<br><br>
                </div>
                <div>
                    willkommen auf der Seite {{ env('APP_NAME') }}.<br> Um sich beim Besuch unserer Website anzumelden, klick einfach oben auf jeder Seite auf „<a href="{{ route('login') }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Anmelden</a>“ und gib dann deine E-Mail-Adresse und dein Passwort ein.<br><br>
                </div>
                <div class="bg-gray-50 dark:bg-gray-200 text-black dark:text-black">
                    <div class="p-4">
                        Verwende die folgenden Daten, wenn du zur Anmeldung aufgefordert wirst:<br>
                        E-Mail Adresse: <span class="font-bold">{{ $user['email'] }}</span><br>
                        Passwort: <span class="font-bold">{{ $user['password'] }}</span><br>
                        Hast du dein Passwort vergessen? Kein Problem. Klicke <a href="{{ route('password.request') }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">hier</a>, um es zurückzusetzen.
                    </div>
                </div>
                <div>
                    <br>
                    Wenn du dich bei deinem Konto anmeldest, kannst du Folgendes tun:<br>
                    <br>
                    <ul class="space-y-1 list-inside">
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1.5 flex-shrink-0 text-black dark:text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                            </svg>
                            Überprüfe den Status deiner Mietzahlungen
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1.5 flex-shrink-0 text-black dark:text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                            </svg>
                            Eintragen von Terminen
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1.5 flex-shrink-0 text-black dark:text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                            </svg>
                            Nehm Änderungen an deinen Kontoinformationen vor
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1.5 flex-shrink-0 text-black dark:text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                            </svg>
                            Ändern des Passworts
                        </li>
                    </ul>
                    <br>
                </div>
                <div>
                    Wenn du Fragen zu deinem Konto oder zu einem anderen Thema hast, kannst du mich gerne unter <a href="mailto:webmaster@thueringer-tuning-freunde.de?subject=Frage zu {{ env('APP_NAME') }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">webmaster@thueringer-tuning-freunde.de</a> oder telefonisch unter
                    <a href="tel:01721020770" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">01721020770</a> kontaktieren.
                </div>
            </td>
        </tr>
    </table>

</x-emails.base>
