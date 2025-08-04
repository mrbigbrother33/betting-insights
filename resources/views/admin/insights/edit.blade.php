<x-layout title="Rediger indlæg">
    <div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded shadow border">

        <h1 class="text-2xl font-bold text-indigo-700 mb-6">Rediger indlæg</h1>

        {{-- Fjern billede form (udenfor hovedform) --}}
        @if ($insight->image_url)
            <div class="mb-6">
                <p class="text-sm text-gray-500 mb-1">Nuværende billede:</p>
                <img src="{{ asset('storage/' . $insight->image_url) }}" class="h-40 rounded shadow mb-2">

                <form method="POST" action="{{ route('admin.insights.removeImage', $insight) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            onclick="return confirm('Er du sikker på, at du vil fjerne billedet?')"
                            class="inline-block text-red-600 hover:text-red-800 text-sm underline">
                        Fjern billede
                    </button>
                </form>
            </div>
        @endif

        {{-- Redigeringsform --}}
        <form method="POST" action="{{ route('admin.insights.update', $insight) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Titel</label>
                <input type="text" name="title" id="title" value="{{ old('title', $insight->title) }}"
                       class="w-full px-3 py-2 border bg-white border-gray-300 rounded shadow-sm text-sm">
                @error('title') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700">Slug (valgfri)</label>
                <input type="text" name="slug" id="slug" value="{{ old('slug', $insight->slug) }}"
                       class="w-full px-3 py-2 border bg-white border-gray-300 rounded shadow-sm text-sm">
                @error('slug') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
                <select name="category_id" id="category_id"
                        class="w-full px-3 py-2 border bg-white border-gray-300 rounded shadow-sm text-sm">
                    <option value="">Ingen</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                                {{ old('category_id', $insight->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="published_at" class="block text-sm font-medium text-gray-700">Publiceringsdato</label>
                <input type="date" name="published_at" id="published_at"
                       value="{{ old('published_at', optional($insight->published_at)->format('Y-m-d')) }}"
                       class="w-full px-3 py-2 border bg-white border-gray-300 rounded shadow-sm text-sm">
                @error('published_at') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="affiliate_url" class="block text-sm font-medium text-gray-700">Affiliate-link</label>
                <input type="url" name="affiliate_url" id="affiliate_url"
                       value="{{ old('affiliate_url', $insight->affiliate_url) }}"
                       class="w-full px-3 py-2 border bg-white border-gray-300 rounded shadow-sm text-sm">
                @error('affiliate_url') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Erstat billede</label>
                <input type="file" name="image" id="image"
                       class="w-full px-3 py-2 border border-gray-300 bg-white rounded shadow-sm text-sm">
                @error('image') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
<div>

<div class="mb-4">
    <label for="editor" class="block font-medium mb-1">Indhold</label>
    <textarea id="editor" name="content" class="w-full border border-gray-300 rounded px-3 py-2" rows="10">
        {{ old('content', $insight->content ?? '') }}
    </textarea>
</div>


    @error('content')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>

            <div class="flex justify-between items-center">
                <x-back-button href="{{ route('admin.insights.index') }}" />

                <button type="submit"
                        class="bg-indigo-600 text-white px-5 py-2 rounded hover:bg-indigo-500 transition text-sm">
                    Gem ændringer
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
    <script src="https://cdn.tiny.cloud/1/bqf076c9czpv7mfk5pel6qojf5dzh474lrd8q506yjm711kh/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            tinymce.init({
                selector: '#editor',
                plugins: 'link image media code lists',
                toolbar: 'undo redo | bold italic | bullist numlist | link image media | code',
                height: 400,
                menubar: false,
                branding: false,
            });
        });
    </script>
@endpush

</x-layout>

