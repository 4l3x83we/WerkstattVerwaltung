<ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
    <li class="mr-2">
        @if(Request::is('backend/berichte/rechnung'))
            <a href="{{ route('backend.berichte.invoice.index') }}" class="inline-flex p-4 border-b-2 rounded-t-lg group active text-orange-600 border-orange-600 dark:text-orange-500 dark:border-orange-500 " aria-current="page">
                Rechnung
            </a>
        @else
            <a href="{{ route('backend.berichte.invoice.index') }}" class="inline-flex p-4 border-b-2 border-transparent rounded-t-lg group hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                Rechnung
            </a>
        @endif
    </li>
    <li class="mr-2">
        @if(Request::is('backend/berichte/einnahmen'))
            <a href="{{ route('backend.berichte.revenue.index') }}" class="inline-flex p-4 border-b-2 rounded-t-lg group active text-orange-600 border-orange-600 dark:text-orange-500 dark:border-orange-500 " aria-current="page">
                Einnahmen
            </a>
        @else
            <a href="{{ route('backend.berichte.revenue.index') }}" class="inline-flex p-4 border-b-2 border-transparent rounded-t-lg group hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                Einnahmen
            </a>
        @endif
    </li>
    <li class="mr-2">
        @if(Request::is('backend/berichte/umsatz'))
            <a href="{{ route('backend.berichte.sales-volume.index') }}" class="inline-flex p-4 border-b-2 rounded-t-lg group active text-orange-600 border-orange-600 dark:text-orange-500 dark:border-orange-500 " aria-current="page">
                Umsatz
            </a>
        @else
            <a href="{{ route('backend.berichte.sales-volume.index') }}" class="inline-flex p-4 border-b-2 border-transparent rounded-t-lg group hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                Umsatz
            </a>
        @endif
    </li>
    <li class="mr-2">
        @if(Request::is('backend/berichte/kassenbuch'))
            <a href="{{ route('backend.berichte.cash-book.index') }}" class="inline-flex p-4 border-b-2 rounded-t-lg group active text-orange-600 border-orange-600 dark:text-orange-500 dark:border-orange-500 " aria-current="page">
                Kassenbuch
            </a>
        @else
            <a href="{{ route('backend.berichte.cash-book.index') }}" class="inline-flex p-4 border-b-2 border-transparent rounded-t-lg group hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                Kassenbuch
            </a>
        @endif
    </li>
    <li class="mr-2">
        @if(Request::is('backend/berichte/kartenzahlung'))
            <a href="{{ route('backend.berichte.card-payment.index') }}" class="inline-flex p-4 border-b-2 rounded-t-lg group active text-orange-600 border-orange-600 dark:text-orange-500 dark:border-orange-500 " aria-current="page">
                Kartenzahlung
            </a>
        @else
            <a href="{{ route('backend.berichte.card-payment.index') }}" class="inline-flex p-4 border-b-2 border-transparent rounded-t-lg group hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                Kartenzahlung
            </a>
        @endif
    </li>
    <li class="mr-2">
        @if(Request::is('backend/berichte/registerkasse'))
            <a href="{{ route('backend.berichte.cash-register.index') }}" class="inline-flex p-4 border-b-2 rounded-t-lg group active text-orange-600 border-orange-600 dark:text-orange-500 dark:border-orange-500 " aria-current="page">
                Registerkasse
            </a>
        @else
            <a href="{{ route('backend.berichte.cash-register.index') }}" class="inline-flex p-4 border-b-2 border-transparent rounded-t-lg group hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                Registerkasse
            </a>
        @endif
    </li>
    <li class="mr-2">
        @if(Request::is('backend/berichte/positionen'))
            <a href="{{ route('backend.berichte.positions.index') }}" class="inline-flex p-4 border-b-2 rounded-t-lg group active text-orange-600 border-orange-600 dark:text-orange-500 dark:border-orange-500 " aria-current="page">
                Positionen
            </a>
        @else
            <a href="{{ route('backend.berichte.positions.index') }}" class="inline-flex p-4 border-b-2 border-transparent rounded-t-lg group hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                Positionen
            </a>
        @endif
    </li>
</ul>
