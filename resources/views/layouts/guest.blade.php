<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="author" content="{{ env('META_AUTHOR') }}">
        <meta name="generator" content="Werkstatt Verwaltung V:{{ env('META_VERSION') }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="canonical" href="{{ canonical_url() }}">

        @include('layouts.partials.stylesheet')
    </head>
    <body class="bg-gray-50 dark:bg-gray-800">
        <main class="bg-gray-50 dark:bg-gray-900">
            <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
                <a href="/" class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 dark:text-white">
                    <img src="{{ asset('images/Logo_neu.png') }}" alt="TTF Logo" class="mr-4 h-16">
                </a>

                <div class="w-full max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded shadow dark:bg-gray-800">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </body>
</html>
