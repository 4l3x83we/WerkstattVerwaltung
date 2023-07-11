<ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
    <li class="mr-2">
        @if(Request::is('backend/buero/auftraege'))
            <a href="{{ route('backend.auftraege.index') }}" class="inline-flex p-4 border-b-2 rounded-t-lg group active text-orange-600 border-orange-600 dark:text-orange-500 dark:border-orange-500 " aria-current="page">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-orange-600 dark:text-orange-500" fill="currentColor" viewBox="0 0 512 512"><path d="M352 320c88.4 0 160-71.6 160-160c0-15.3-2.2-30.1-6.2-44.2c-3.1-10.8-16.4-13.2-24.3-5.3l-76.8 76.8c-3 3-7.1 4.7-11.3 4.7H336c-8.8 0-16-7.2-16-16V118.6c0-4.2 1.7-8.3 4.7-11.3l76.8-76.8c7.9-7.9 5.4-21.2-5.3-24.3C382.1 2.2 367.3 0 352 0C263.6 0 192 71.6 192 160c0 19.1 3.4 37.5 9.5 54.5L19.9 396.1C7.2 408.8 0 426.1 0 444.1C0 481.6 30.4 512 67.9 512c18 0 35.3-7.2 48-19.9L297.5 310.5c17 6.2 35.4 9.5 54.5 9.5zM80 408a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg>Auftrag
            </a>
        @else
        <a href="{{ route('backend.auftraege.index') }}" class="inline-flex p-4 border-b-2 border-transparent rounded-t-lg group hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="currentColor" viewBox="0 0 512 512"><path d="M352 320c88.4 0 160-71.6 160-160c0-15.3-2.2-30.1-6.2-44.2c-3.1-10.8-16.4-13.2-24.3-5.3l-76.8 76.8c-3 3-7.1 4.7-11.3 4.7H336c-8.8 0-16-7.2-16-16V118.6c0-4.2 1.7-8.3 4.7-11.3l76.8-76.8c7.9-7.9 5.4-21.2-5.3-24.3C382.1 2.2 367.3 0 352 0C263.6 0 192 71.6 192 160c0 19.1 3.4 37.5 9.5 54.5L19.9 396.1C7.2 408.8 0 426.1 0 444.1C0 481.6 30.4 512 67.9 512c18 0 35.3-7.2 48-19.9L297.5 310.5c17 6.2 35.4 9.5 54.5 9.5zM80 408a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg>Auftrag
        </a>
        @endif
    </li>
    <li class="mr-2">
        @if(Request::is('backend/buero/rechnung/entwurf'))
        <a href="{{ route('backend.invoice.entwurf.index') }}" class="inline-flex p-4 border-b-2 rounded-t-lg group active text-orange-600 border-orange-600 dark:text-orange-500 dark:border-orange-500 " aria-current="page">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-orange-600 dark:text-orange-500" fill="currentColor" viewBox="0 0 384 512"><path d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128z"/></svg>Entwurf
        </a>
        @else
        <a href="{{ route('backend.invoice.entwurf.index') }}" class="inline-flex p-4 border-b-2 border-transparent rounded-t-lg group hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="currentColor" viewBox="0 0 384 512"><path d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128z"/></svg>Entwurf
        </a>
        @endif
    </li>
    <li class="mr-2">
        @if(Request::is('backend/buero/rechnung/offen'))
        <a href="{{ route('backend.invoice.offen.index') }}" class="inline-flex p-4 border-b-2 rounded-t-lg group active text-orange-600 border-orange-600 dark:text-orange-500 dark:border-orange-500 " aria-current="page">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-orange-600 dark:text-orange-500" fill="currentColor" viewBox="0 0 384 512"><path d="M32 0C14.3 0 0 14.3 0 32S14.3 64 32 64V75c0 42.4 16.9 83.1 46.9 113.1L146.7 256 78.9 323.9C48.9 353.9 32 394.6 32 437v11c-17.7 0-32 14.3-32 32s14.3 32 32 32H64 320h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V437c0-42.4-16.9-83.1-46.9-113.1L237.3 256l67.9-67.9c30-30 46.9-70.7 46.9-113.1V64c17.7 0 32-14.3 32-32s-14.3-32-32-32H320 64 32zM96 75V64H288V75c0 19-5.6 37.4-16 53H112c-10.3-15.6-16-34-16-53zm16 309c3.5-5.3 7.6-10.3 12.1-14.9L192 301.3l67.9 67.9c4.6 4.6 8.6 9.6 12.1 14.9H112z"/></svg>Offen
        </a>
        @else
        <a href="{{ route('backend.invoice.offen.index') }}" class="inline-flex p-4 border-b-2 border-transparent rounded-t-lg group hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="currentColor" viewBox="0 0 384 512"><path d="M32 0C14.3 0 0 14.3 0 32S14.3 64 32 64V75c0 42.4 16.9 83.1 46.9 113.1L146.7 256 78.9 323.9C48.9 353.9 32 394.6 32 437v11c-17.7 0-32 14.3-32 32s14.3 32 32 32H64 320h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V437c0-42.4-16.9-83.1-46.9-113.1L237.3 256l67.9-67.9c30-30 46.9-70.7 46.9-113.1V64c17.7 0 32-14.3 32-32s-14.3-32-32-32H320 64 32zM96 75V64H288V75c0 19-5.6 37.4-16 53H112c-10.3-15.6-16-34-16-53zm16 309c3.5-5.3 7.6-10.3 12.1-14.9L192 301.3l67.9 67.9c4.6 4.6 8.6 9.6 12.1 14.9H112z"/></svg>Offen
        </a>
        @endif
    </li>
    <li class="mr-2">
        @if(Request::is('backend/buero/rechnung/bezahlt'))
            <a href="{{ route('backend.invoice.bezahlt.index') }}" class="inline-flex p-4 border-b-2 rounded-t-lg group active text-orange-600 border-orange-600 dark:text-orange-500 dark:border-orange-500 " aria-current="page">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-orange-600 dark:text-orange-500" fill="currentColor" viewBox="0 0 576 512"><path d="M96 80c0-26.5 21.5-48 48-48H432c26.5 0 48 21.5 48 48V384H96V80zm313 47c-9.4-9.4-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L409 161c9.4-9.4 9.4-24.6 0-33.9zM0 336c0-26.5 21.5-48 48-48H64V416H512V288h16c26.5 0 48 21.5 48 48v96c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V336z"/></svg>Bezahlt
            </a>
        @else
            <a href="{{ route('backend.invoice.bezahlt.index') }}" class="inline-flex p-4 border-b-2 border-transparent rounded-t-lg group hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="currentColor" viewBox="0 0 576 512"><path d="M96 80c0-26.5 21.5-48 48-48H432c26.5 0 48 21.5 48 48V384H96V80zm313 47c-9.4-9.4-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L409 161c9.4-9.4 9.4-24.6 0-33.9zM0 336c0-26.5 21.5-48 48-48H64V416H512V288h16c26.5 0 48 21.5 48 48v96c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V336z"/></svg>Bezahlt
            </a>
        @endif
    </li>
    <li class="mr-2">
        @if(Request::is('backend/buero/rechnung/storno'))
            <a href="{{ route('backend.invoice.storno.index') }}" class="inline-flex p-4 border-b-2 rounded-t-lg group active text-orange-600 border-orange-600 dark:text-orange-500 dark:border-orange-500 " aria-current="page">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-orange-600 dark:text-orange-500" fill="currentColor" viewBox="0 0 640 512"><path d="M5.1 9.2C13.3-1.2 28.4-3.1 38.8 5.1l592 464c10.4 8.2 12.3 23.3 4.1 33.7s-23.3 12.3-33.7 4.1L9.2 42.9C-1.2 34.7-3.1 19.6 5.1 9.2z"/></svg>Storno/Gutschrift
            </a>
        @else
            <a href="{{ route('backend.invoice.storno.index') }}" class="inline-flex p-4 border-b-2 border-transparent rounded-t-lg group hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="currentColor" viewBox="0 0 640 512"><path d="M5.1 9.2C13.3-1.2 28.4-3.1 38.8 5.1l592 464c10.4 8.2 12.3 23.3 4.1 33.7s-23.3 12.3-33.7 4.1L9.2 42.9C-1.2 34.7-3.1 19.6 5.1 9.2z"/></svg>Storno/Gutschrift
            </a>
        @endif
    </li>
    <li>
        @if(Request::is('backend/buero/rechnung/alle'))
        <a href="{{ route('backend.invoice.alle.index') }}"  class="inline-flex p-4 border-b-2 rounded-t-lg group active text-orange-600 border-orange-600 dark:text-orange-500 dark:border-orange-500 " aria-current="page">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-orange-600 dark:text-orange-500" fill="currentColor" viewBox="0 0 576 512"><path d="M384 480h48c11.4 0 21.9-6 27.6-15.9l112-192c5.8-9.9 5.8-22.1 .1-32.1S555.5 224 544 224H144c-11.4 0-21.9 6-27.6 15.9L48 357.1V96c0-8.8 7.2-16 16-16H181.5c4.2 0 8.3 1.7 11.3 4.7l26.5 26.5c21 21 49.5 32.8 79.2 32.8H416c8.8 0 16 7.2 16 16v32h48V160c0-35.3-28.7-64-64-64H298.5c-17 0-33.3-6.7-45.3-18.7L226.7 50.7c-12-12-28.3-18.7-45.3-18.7H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H87.7 384z"/></svg>Alle
        </a>
        @else
        <a href="{{ route('backend.invoice.alle.index') }}" class="inline-flex p-4 border-b-2 border-transparent rounded-t-lg group hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="currentColor" viewBox="0 0 576 512"><path d="M384 480h48c11.4 0 21.9-6 27.6-15.9l112-192c5.8-9.9 5.8-22.1 .1-32.1S555.5 224 544 224H144c-11.4 0-21.9 6-27.6 15.9L48 357.1V96c0-8.8 7.2-16 16-16H181.5c4.2 0 8.3 1.7 11.3 4.7l26.5 26.5c21 21 49.5 32.8 79.2 32.8H416c8.8 0 16 7.2 16 16v32h48V160c0-35.3-28.7-64-64-64H298.5c-17 0-33.3-6.7-45.3-18.7L226.7 50.7c-12-12-28.3-18.7-45.3-18.7H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H87.7 384z"/></svg>Alle
        </a>
        @endif
    </li>
</ul>
