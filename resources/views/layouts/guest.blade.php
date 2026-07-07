<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'FICMS') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- ADD THIS LINE HERE bla -->
        <link rel="icon" href="{{ asset('FICMS.png') }}" type="image/png">

        <!-- ADD THIS STYLE BLOCK -->
        <style>
            .tech-bg {
                background-image: url('{{ asset('images/background FICMS.png') }}');
                background-size: cover;
                background-position: center;
                background-attachment: fixed;
            }
        </style>
    </head>
    
    <!-- UPDATE BODY CLASS TO tech-bg -->
    <body class="font-sans text-gray-900 antialiased tech-bg">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            
            <div class="mb-6">
                <a href="/">
                    <img src="{{ asset('images/FICMS.png') }}" alt="FICMS Logo" class="h-16 w-auto">
                </a>
            </div>

            <!-- UPDATE CARD STYLING FOR GLASS EFFECT -->
            <div class="w-full sm:max-w-md bg-slate-950/70 backdrop-blur-lg border border-slate-700/50 p-8 rounded-2xl shadow-2xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>