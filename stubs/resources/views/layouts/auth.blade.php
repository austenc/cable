<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name') }}</title>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @livewireStyles
    </head>
    <body class="font-sans antialiased text-gray-600 bg-gray-200">
        <div class="flex h-screen items-center justify-center bg-gradient-to-br from-primary-600 to-secondary-200">
            {{ $slot }}
        </div>
        @livewireScripts
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
