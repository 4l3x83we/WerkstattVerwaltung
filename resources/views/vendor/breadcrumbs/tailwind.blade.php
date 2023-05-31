@if (count($breadcrumbs))

    <nav class="flex mb-5" aria-label="Breadcrumbs">
        <ol role="list" class="inline-flex items-center space-x-1 xl:space-x-3">
            @foreach ($breadcrumbs as $breadcrumb)
                <li>
                    <div class="flex items-center">
                        @unless ($loop->first)
                            <span class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-orange-600 dark:text-gray-400 dark:hover:text-white" aria-hidden="true">
                                <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </span>
                        @endunless

                        <a href="{{ $breadcrumb->url && ! $loop->last ? $breadcrumb->url : '#' }}"
                           @if ($loop->last) aria-current="page" @endif
                           @class([
                               'text-sm font-medium text-gray-700 dark:text-gray-400 breadcrumb-item',
                               'ml-1 xl:ml-2' => ! $loop->first,
                               'hover:text-gray-700 dark:hover:text-white' => ! $loop->last,
                               'pointer-events-none breadcrumb-item--active' => $loop->last,
                           ])
                        >
                            {{ $breadcrumb->title }}
                        </a>
                    </div>
                </li>
            @endforeach
        </ol>
    </nav>

@endif
