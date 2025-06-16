<x-layout title="Opret konto">
    <div class="max-w-md mx-auto mt-16 bg-white p-6 rounded-lg shadow border">
        <h1 class="text-2xl font-bold mb-4 text-center">Opret konto</h1>

        <form method="POST" action="{{ route('register.store') }}" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Navn</label>
                <input type="text" name="name" id="name" 
                       value="{{ old('name') }}"
                       class="mt-1 w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring focus:ring-indigo-200">
                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                <input type="email" name="email" id="email" 
                       value="{{ old('email') }}"
                       class="mt-1 w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring focus:ring-indigo-200">
                @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Adgangskode</label>
                <input type="password" name="password" id="password" 
                       class="mt-1 w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring focus:ring-indigo-200">
                @error('password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Bekræft adgangskode</label>
                <input type="password" name="password_confirmation" id="password_confirmation" 
                       class="mt-1 w-full px-3 py-2 border rounded shadow-sm focus:outline-none focus:ring focus:ring-indigo-200">
                @error('password_confirmation')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="w-full bg-indigo-600 text-white py-2 rounded hover:bg-indigo-500 transition">
                Opret konto
            </button>
        </form>

        <p class="text-sm text-center text-gray-600 mt-4">
            Har du allerede en konto?
            <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Log ind her</a>
        </p>
    </div>
</x-layout>
