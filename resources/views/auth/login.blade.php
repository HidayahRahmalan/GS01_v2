<x-guest-layout>
    <div class="bg-slate-900 p-8 rounded-2xl border border-slate-800 shadow-2xl w-full max-w-md">
        
        <h2 class="text-2xl font-bold text-white mb-6">Sign in to FICMS</h2>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-400 mb-1">Username</label>
                <input type="text" name="username" value="{{ old('username') }}" required autofocus 
                    class="w-full bg-slate-950 border border-slate-700 rounded-lg p-3 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none transition">
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-slate-400 mb-1">Password</label>
                <input type="password" name="password" required 
                    class="w-full bg-slate-950 border border-slate-700 rounded-lg p-3 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none transition">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mb-6">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="remember" class="rounded bg-slate-950 border-slate-700 text-indigo-600 focus:ring-indigo-500">
                    <span class="ms-2 text-sm text-slate-400">Remember me</span>
                </label>
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-lg transition duration-200">
                Sign In
            </button>
        </form>

        <div class="mt-6 text-center">
            @if (Route::has('password.request'))
                <a class="text-sm text-indigo-400 hover:text-indigo-300 transition" href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
            @endif
        </div>
    </div>
</x-guest-layout>