@php
    $textWidth = [
        'lg' => 'text-lg font-bold dark:text-white',
        'xl' => 'text-xl font-bold dark:text-white',
        '2xl' => 'text-2xl font-bold dark:text-white',
        '3xl' => 'text-3xl font-bold dark:text-white',
        '4xl' => 'text-4xl font-bold dark:text-white',
        '5xl' => 'text-5xl font-bold dark:text-white',
    ][$textWidth ?? '2xl'];
@endphp

<{{$heading ?? 'h4'}} {{ $attributes->merge(['class' => $textWidth]) }}>{!! $text ?? '' !!}</{{ $heading }}>
