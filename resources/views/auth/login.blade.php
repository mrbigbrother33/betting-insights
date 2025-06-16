<x-layout title="Login">
    <div class="max-w-md mx-auto mt-16 bg-white p-6 rounded-lg shadow border">

<x-back-button href="{{ route('home') }}" />

        <h1 class="text-2xl font-bold mb-4 text-center">Log ind</h1>

        @if(session('error'))
            <div class="mb-4 text-red-600 text-sm">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('login.authenticate') }}" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                <input type="email" name="email" id="email"  autofocus
                       class="mt-1 w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring focus:ring-indigo-200">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Adgangskode</label>
                <input type="password" name="password" id="password" 
                       class="mt-1 w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring focus:ring-indigo-200">
                @error('email')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                    
            </div>

            <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-500 transition">
                Log ind
            </button>
        </form>

        <p class="text-sm text-center text-gray-600 mt-4">
            Har du ikke en konto?
            <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Opret en her</a>
        </p>
    </div>
</x-layout>
