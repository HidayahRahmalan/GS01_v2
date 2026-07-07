<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'FICMS') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- ADD THIS LINE HERE -->
        <link rel="icon" href="{{ asset('FICMS.png') }}" type="image/png">
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex">
            
            <!-- Render your frozen static sidebar -->
            @include('layouts.sidebar') 

            <!-- Main Workspace Container (Shifted right by ml-64 to accommodate the sidebar) -->
            <div class="flex-1 ml-64 flex flex-col min-h-screen">
                @isset($header)
                    <header class="bg-white dark:bg-gray-800 shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- This is where your clean dashboard code drops in -->
                <main class="flex-1 p-8 text-gray-900 dark:text-gray-100">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>