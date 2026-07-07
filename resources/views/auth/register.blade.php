<x-guest-layout>
    <div class="bg-slate-900 p-8 rounded-2xl border border-slate-800 shadow-2xl w-full max-w-md">

        <h2 class="text-2xl font-bold text-white mb-6 text-center">Create your FICMS Account</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-400 mb-1">Username</label>
                <input type="text" name="username" value="{{ old('username') }}" required autofocus 
                    class="w-full bg-slate-950 border border-slate-700 rounded-lg p-3 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none transition">
                <x-input-error :messages="$errors->get('username')" class="mt-2" />
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-slate-400 mb-1">Password</label>
                <input type="password" name="password" required 
                    class="w-full bg-slate-950 border border-slate-700 rounded-lg p-3 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none transition">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-slate-400 mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" required 
                    class="w-full bg-slate-950 border border-slate-700 rounded-lg p-3 text-white focus:ring-2 focus:ring-indigo-500 focus:outline-none transition">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-lg transition duration-200">
                Register Account
            </button>
        </form>

        <div class="mt-6 text-center">
            <a class="text-sm text-indigo-400 hover:text-indigo-300 transition" href="{{ route('login') }}">
                Already registered? Sign in instead
            </a>
        </div>
    </div>
</x-guest-layout>