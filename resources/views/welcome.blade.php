<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FICMS | Welcome</title>
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('FICMS.png') }}" type="image/png">
    
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .tech-bg {
            background-image: url('{{ asset('images/background FICMS.png') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
    </style>
</head>
<body class="bg-slate-950 text-white min-h-screen flex items-center justify-center font-sans tech-bg">
    
    <div class="max-w-4xl text-center px-6 bg-slate-950/60 backdrop-blur-md p-10 rounded-3xl border border-slate-800 shadow-2xl">
        
        <!-- Logo -->
        <div class="mb-8 flex justify-center">
            <img src="{{ asset('FICMS.png') }}" alt="FICMS Logo" class="h-20 w-auto">
        </div>

        <!-- Main Heading -->
        <h1 class="text-4xl md:text-6xl font-black tracking-tighter text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-200 to-indigo-400 mb-6 leading-tight">
            Formal Image Classification & <br>Multimedia Metadata Management System
        </h1>
        
        <p class="text-slate-400 text-lg md:text-xl mb-12 max-w-2xl mx-auto">
            Automatically classify your multimedia library by distinguishing formal images, characterized by professional attire and clean backgrounds, from informal images through our advanced metadata management system.
        </p>

        <!-- Call to Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">

            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-xl font-bold transition shadow-lg shadow-indigo-500/20">
                        Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="w-full sm:w-auto bg-slate-800 hover:bg-slate-700 text-white px-8 py-4 rounded-xl font-bold transition border border-slate-700">
                        Log In
                    </a>
                    <a href="{{ route('register') }}" class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-xl font-bold transition shadow-lg shadow-indigo-500/20">
                        Get Started
                    </a>
                @endauth
            @endif
        </div>

        <!-- Footer Note -->
        <div class="mt-16 text-slate-600 text-sm">
            © {{ date('Y') }} Multimedia Database
        </div>
    </div>

</body>
</html>
