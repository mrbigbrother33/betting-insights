<nav x-data="{ open: false }" class="bg-white shadow-sm border-b border-gray-200 p-4">
    <div class="flex justify-between items-center max-w-7xl mx-auto">
        <a href="/" class="text-xl font-bold text-indigo-600 tracking-tight">FriIndsigt</a>

        <!-- Desktop nav -->
        <div class="hidden md:flex space-x-6 text-sm font-medium items-center">
            @auth
    <x-nav-link url="/admin/insights" :active="request()->is('insights')">
        Insights
    </x-nav-link>

    <x-nav-link url="/admin/categories" :active="request()->is('categories')">
        Kategorier
    </x-nav-link>

    @if (auth()->user()->is_admin)
        <x-nav-link url="/admin/users" :active="request()->is('admin/users')">
            Brugere
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
<x-nav-link url="/insights" :active="request()->is('insights')">
        Insights
    </x-nav-link>

    <x-nav-link url="/categories" :active="request()->is('categories')">
        Kategorier
    </x-nav-link>
    <x-nav-link url="/login" :active="request()->is('login')">Login</x-nav-link>
    <x-nav-link url="/register" :active="request()->is('register')">Opret bruger</x-nav-link>
@endauth

        </div>

        <!-- Burger / Close icon -->
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
        <a href="/insights" class="block px-4 py-2 text-gray-700 hover:text-indigo-500">Insights</a>
        <a href="/categories" class="block px-4 py-2 text-gray-700 hover:text-indigo-500">Kategorier</a>

        @if(auth()->user()->is_admin)
            <a href="{{ route('admin.insights.create') }}" class="block px-4 py-2 text-indigo-600 font-medium">➕ Opret Insight</a>
            <a href="{{ route('admin.insights.index') }}" class="block px-4 py-2 text-gray-700 hover:text-indigo-500">🛠 Adminpanel</a>
        @endif

        <a href="/profil" class="block px-4 py-2 text-gray-700 hover:text-indigo-500">Profil</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="block w-full text-left px-4 py-2 text-gray-700 hover:text-red-500">
                Log ud
            </button>
        </form>
    @else
        <a href="/login" class="block px-4 py-2 text-gray-700 hover:text-indigo-500">Login</a>
        <a href="/register" class="block px-4 py-2 text-gray-700 hover:text-indigo-500">Opret bruger</a>
    @endauth
</div>

</nav>
