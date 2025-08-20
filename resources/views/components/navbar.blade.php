<nav x-data="{ open: false }" class="bg-white shadow-sm border-b border-gray-200 p-4">
    <div class="flex justify-between items-center max-w-7xl mx-auto">
     <a href="/" class="flex items-center space-x-2 text-indigo-600">
    
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" class="h-8 w-8" fill="currentColor">
        <path d="M32 12C18 12 6 24 6 32s12 20 26 20 26-12 26-20S46 12 32 12zm0 32c-6.6 0-12-5.4-12-12s5.4-12 12-12 12 5.4 12 12-5.4 12-12 12z"/>
        <circle cx="32" cy="32" r="6"/>
    </svg>

    <span class="text-xl font-bold tracking-tight">
        FriIndsigt
    </span>
</a>

        <!-- Desktop nav -->
        <div class="hidden md:flex space-x-6 text-sm font-medium items-center">
            @auth
                @if(auth()->user()->is_admin)
                    <x-nav-link url="/admin/insights" :active="request()->is('admin/insights*')">
                        Admin Insights
                    </x-nav-link>

                    <x-nav-link url="/admin/categories" :active="request()->is('admin/categories*')">
                        Admin Kategorier
                    </x-nav-link>

                    <x-nav-link url="/admin/users" :active="request()->is('admin/users*')">
                        Brugere
                    </x-nav-link>
                @else
                    <x-nav-link url="/insights" :active="request()->is('insights')">
                        Insights
                    </x-nav-link>

                    <x-nav-link url="/categories" :active="request()->is('categories')">
                        Kategorier
                    </x-nav-link>
                @endif

                <x-nav-link url="/profil" :active="request()->is('profil')">
                    <span class="flex items-center gap-2">
                        <img src="{{ Auth::user()->profile_image 
                            ? asset('storage/' . Auth::user()->profile_image) 
                            : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                            class="w-6 h-6 rounded-full object-cover border border-gray-300" alt="Profil" />
                        Profil
                    </span>
                </x-nav-link>

                <x-logout-button />
            @else
                <x-nav-link url="/insights" :active="request()->is('insights')">Insights</x-nav-link>
                <x-nav-link url="/categories" :active="request()->is('categories')">Kategorier</x-nav-link>
                <x-nav-link url="/login" :active="request()->is('login')">Login</x-nav-link>
                <x-nav-link url="/register" :active="request()->is('register')">Opret bruger</x-nav-link>
            @endauth
        </div>

        <!-- Burger icon -->
        <button @click="open = !open" class="md:hidden focus:outline-none">
            <svg x-show="!open" class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg x-show="open" class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Mobile nav -->
    <div x-show="open" x-transition class="mt-4 md:hidden space-y-2">
        @auth
            @if(auth()->user()->is_admin)
                <a href="/admin/insights" class="block px-4 py-2 text-gray-700 hover:text-indigo-500">Admin Insights</a>
                <a href="/admin/categories" class="block px-4 py-2 text-gray-700 hover:text-indigo-500">Admin Kategorier</a>
                <a href="/admin/users" class="block px-4 py-2 text-gray-700 hover:text-indigo-500">Brugere</a>
            @else
                <a href="/insights" class="block px-4 py-2 text-gray-700 hover:text-indigo-500">Insights</a>
                <a href="/categories" class="block px-4 py-2 text-gray-700 hover:text-indigo-500">Kategorier</a>
            @endif

            <a href="/profil" class="block px-4 py-2 text-gray-700 hover:text-indigo-500">Profil</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="block w-full text-left px-4 py-2 text-gray-700 hover:text-red-500">
                    Log ud
                </button>
            </form>
        @else
            <a href="/insights" class="block px-4 py-2 text-gray-700 hover:text-indigo-500">Insights</a>
            <a href="/categories" class="block px-4 py-2 text-gray-700 hover:text-indigo-500">Kategorier</a>
            <a href="/login" class="block px-4 py-2 text-gray-700 hover:text-indigo-500">Login</a>
            <a href="/register" class="block px-4 py-2 text-gray-700 hover:text-indigo-500">Opret bruger</a>
        @endauth
    </div>
</nav>
