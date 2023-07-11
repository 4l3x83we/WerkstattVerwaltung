@php use Carbon\Carbon; @endphp
<div id="accordion-flush" data-accordion="collapse" data-active-classes="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white" data-inactive-classes="text-gray-500 dark:text-gray-400">
    <h2 id="accordion-flush-heading-rechnungsprotokoll">
        <button type="button" class="flex items-center w-full py-1 font-medium text-left text-gray-500 dark:text-gray-400" data-accordion-target="#accordion-flush-body-rechnungsprotokoll" aria-expanded="false" aria-controls="accordion-flush-body-rechnungsprotokoll">
            <span>Rechnungsprotokoll</span>
            <svg data-accordion-icon class="w-3 h-3 ml-2 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
            </svg>
        </button>
    </h2>
    <div id="accordion-flush-body-rechnungsprotokoll" class="hidden" aria-labelledby="accordion-flush-heading-rechnungsprotokoll">
        <div class="py-5">
            <ol class="relative border-l border-gray-200 dark:border-gray-700 left-3">
                @foreach($protocols as $protocol)
                    <li class="ml-6">
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-orange-200 rounded-full -left-3 ring-8 ring-white dark:ring-gray-900 dark:bg-orange-300">
                            @if($protocol->protocol_status === 'created')
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-black dark:text-black" fill="currentColor" viewBox="0 0 448 512">
                                    <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
                                </svg>
                            @endif
                            @if($protocol->protocol_status === 'edited')
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-black dark:text-black" fill="currentColor" viewBox="0 0 512 512">
                                    <path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z"/>
                                </svg>
                            @endif
                            @if($protocol->protocol_status === 'complete')
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-black dark:text-black" fill="currentColor" viewBox="0 0 448 512">
                                    <path d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z"/>
                                </svg>
                            @endif
                            @if($protocol->protocol_status === 'printed')
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-black dark:text-black" fill="currentColor" viewBox="0 0 512 512">
                                    <path d="M128 0C92.7 0 64 28.7 64 64v96h64V64H354.7L384 93.3V160h64V93.3c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0H128zM384 352v32 64H128V384 368 352H384zm64 32h32c17.7 0 32-14.3 32-32V256c0-35.3-28.7-64-64-64H64c-35.3 0-64 28.7-64 64v96c0 17.7 14.3 32 32 32H64v64c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V384zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/>
                                </svg>
                            @endif
                            @if($protocol->protocol_status === 'storno')
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-black dark:text-black" fill="currentColor" viewBox="0 0 384 512">
                                    <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/>
                                </svg>
                            @endif
                            @if($protocol->protocol_status === 'mail')
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-black dark:text-black" fill="currentColor" viewBox="0 0 512 512">
                                    <path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/>
                                </svg>
                            @endif
                        </span>
                        <h3 class="mb-1 text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $protocol->protocol_text }}
                        </h3>
                        <time class="block mb-2 text-xs font-normal leading-none text-gray-400 dark:text-gray-500">
                            {{ Carbon::parse($protocol->created_at)->format('d.m.Y H:i') }}
                        </time>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
</div>

