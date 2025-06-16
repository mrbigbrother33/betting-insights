<x-layout title="Opret ny Insight">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-6">Opret ny Insight</h1>

        <form action="{{ route('admin.insights.store') }}" method="POST" class="space-y-4" enctype="multipart/form-data">
            @csrf

            <x-input label="Titel" name="title" :value="old('title')" required />

            <x-input label="Slug (valgfri)" name="slug" :value="old('slug')" />

            <div>
                <label class="block text-sm font-medium text-gray-700">Kategori</label>
                <select name="category_id" class="mt-1 w-full border rounded px-3 py-2">
                    <option value="">-- Vælg kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Indhold</label>
                <textarea name="content" rows="8" class="mt-1 w-full border rounded px-3 py-2">{{ old('content') }}</textarea>
                @error('content') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Upload billede</label>
    <input type="file" name="image" id="image"
           class="w-full px-3 py-2 border border-gray-300 bg-white rounded shadow-sm text-sm">
    @error('image')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>

            <x-input label="Affiliate-link (URL)" name="affiliate_url" :value="old('affiliate_url')" />

            <x-input label="Publiceringsdato" name="published_at" type="date" :value="old('published_at')" />

            <button type="submit"
                class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500 transition">
                Gem Insight
            </button>
        </form>
    </div>
</x-layout>
