<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="{{ env('META_AUTHOR') }}">
    <meta name="generator" content="Werkstatt Verwaltung V:{{ env('META_VERSION') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="canonical" href="{{ canonical_url() }}">

    @include('layouts.partials.stylesheet')
    @stack('css')
</head>
<body class="bg-gray-50 dark:bg-gray-800">
    <!-- Navbar -->
    @include('layouts.partials.navbar')
    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">
        <!-- Sidebar -->
        @include('layouts.partials.sidebar')
        <div id="main-content" class="relative w-full h-full overflow-y-auto lg:ml-64">
            <div class="flex flex-col h-screen justify-between -mt-16">
            <main class="mb-auto bg-gray-50 dark:bg-gray-900 pt-16">
                {{ $slot }}
            </main>
            @include('layouts.partials.footer')
            </div>
        </div>
    </div>
    @stack('js')
    @stack('scripts')
</body>
</html>
