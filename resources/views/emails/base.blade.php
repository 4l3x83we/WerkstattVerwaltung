<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @if($subject = $attributes->get('subject'))
        <title>{{ $subject }}</title>
    @endif

    @vite(['resources/css/mail.css'])
</head>
<body>
    <div class="w-full h-full bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-200">
        <div class="w-full h-full px-8 py-12">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
