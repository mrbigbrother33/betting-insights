<x-layout title="Rediger Insight">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-6">Rediger: {{ $insight->title }}</h1>

        <form action="{{ route('admin.insights.update', $insight) }}" method="POST" class="space-y-4" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <x-input label="Titel" name="title" :value="old('title', $insight->title)" required />

            <x-input label="Slug" name="slug" :value="old('slug', $insight->slug)" />

            <div>
                <label class="block text-sm font-medium text-gray-700">Kategori</label>
                <select name="category_id" class="mt-1 w-full border rounded px-3 py-2">
                    <option value="">-- Vælg kategori --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            @selected(old('category_id', $insight->category_id) == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Indhold</label>
                <textarea name="content" rows="8" class="mt-1 w-full border rounded px-3 py-2">{{ old('content', $insight->content) }}</textarea>
                @error('content') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="mt-4">
        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Erstat billede</label>
        <input type="file" name="image" id="image"
               class="w-full px-3 py-2 border border-gray-300 bg-white rounded shadow-sm text-sm">
        @error('image')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror

        @if ($insight->image_url)
            <p class="text-sm text-gray-500 mt-2">Nuværende billede:</p>
            <img src="{{ asset('storage/' . $insight->image_url) }}" class="mt-1 h-40 rounded shadow">
        @endif
    </div>

            <x-input label="Affiliate-link (URL)" name="affiliate_url" :value="old('affiliate_url', $insight->affiliate_url)" />

            <x-input label="Publiceringsdato" name="published_at" type="date" :value="old('published_at', \Illuminate\Support\Str::substr($insight->published_at, 0, 10))" />

            <button type="submit"
                class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500 transition">
                Opdater Insight
            </button>
        </form>
    </div>
</x-layout>
