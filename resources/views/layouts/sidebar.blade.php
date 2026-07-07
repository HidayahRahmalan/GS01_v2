<!-- resources/views/layouts/sidebar.blade.php -->
<aside class="h-screen w-64 fixed inset-y-0 left-0 bg-slate-900 text-white flex flex-col justify-between p-6 z-50 border-r border-slate-800">
    <div>
        <!-- Brand Header Logo -->
        <div class="text-2xl font-bold mb-10 text-indigo-400 tracking-wider">FICMS</div>
        
        <!-- Main Navigation Links (Matches UI Scope Requirements) -->
        <nav class="space-y-2">
            <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-sidebar-link>

        </nav>
    </div>

    <!-- System Actions & Authenticated Session Controls -->
    <div class="border-t border-slate-800 pt-6">
        <nav class="space-y-2">
            <x-sidebar-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                {{ __('Settings') }}
            </x-sidebar-link>
            
            <!-- Safe Laravel Auth State Termination Pipeline -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left py-2 px-4 rounded text-red-400 hover:bg-slate-800 transition text-sm font-semibold">
                    {{ __('Log Out') }}
                </button>
            </form>
        </nav>
    </div>
</aside>