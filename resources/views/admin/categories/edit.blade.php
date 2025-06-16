<x-layout title="Rediger kategori">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <x-back-button />
        <h1 class="text-xl font-bold mb-4">Rediger kategori</h1>

        <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="space-y-4">
            @csrf
            @method('PUT')
            <x-input name="name" label="Navn" :value="$category->name" required />
            <x-input name="slug" label="Slug (valgfrit)" :value="$category->slug" />

            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500">
                Opdater
            </button>
        </form>
    </div>
</x-layout>
