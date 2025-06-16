<x-layout title="Opret kategori">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <x-back-button />
        <h1 class="text-xl font-bold mb-4">Opret ny kategori</h1>

        <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-4">
            @csrf
            <x-input name="name" label="Navn" required />
            <x-input name="slug" label="Slug (valgfrit)" />

            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500">
                Gem
            </button>
        </form>
    </div>
</x-layout>
