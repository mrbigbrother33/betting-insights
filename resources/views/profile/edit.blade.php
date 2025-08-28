<x-layout title="Rediger profil">
    <div class="max-w-md mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4 text-indigo-700">Rediger din profil</h1>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if ($user->profile_image)
                <div class="mt-2 flex justify-center">
                    <img src="{{ asset('storage/' . $user->profile_image) }}" class="w-32 h-32 rounded-full object-cover" alt="Profilbillede">
                </div>
            @endif

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Navn</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                       class="w-full px-3 py-2 border rounded bg-white shadow-sm">
                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                       class="w-full px-3 py-2 border rounded bg-white shadow-sm">
                @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="profile_image" class="block text-sm font-medium text-gray-700">Profilbillede</label>
                <input type="file" name="profile_image" id="profile_image"
                       class="w-full mt-1 px-3 py-2 bg-white border border-gray-300 rounded shadow-sm">
                @error('profile_image')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <hr class="my-4">

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Ny adgangskode (valgfrit)</label>
                <input type="password" name="password" id="password"
                       class="w-full px-3 py-2 border rounded bg-white shadow-sm">
                @error('password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Bekræft adgangskode</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="w-full px-3 py-2 border rounded bg-white shadow-sm">
            </div>

            <button type="submit"
                    class="mt-4 bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500 transition">
                Gem ændringer
            </button>
        </form>

        <form method="POST" action="{{ route('profile.destroy') }}" class="mt-6">
            @csrf
            @method('DELETE')
            <button type="submit"
                    onclick="return confirm('Er du sikker på, at du vil slette din konto? Denne handling kan ikke fortrydes.')"
                    class="text-red-600 hover:text-red-800 text-sm underline">
                ❌ Fjern konto
            </button>
        </form>
    </div>
</x-layout>
