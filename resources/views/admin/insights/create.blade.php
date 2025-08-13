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
    
   <div class="mb-4">
    <label for="editor" class="block font-medium mb-1">Indhold</label>
    <textarea id="editor" name="content" class="w-full border border-gray-300 rounded px-3 py-2" rows="10">
        {!! old('content', $insight->content ?? '') !!}
    </textarea>
</div>

    @error('content')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
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
                force_br_newlines: false,
                force_p_newlines: true,
                remove_trailing_brs: true,
                // Whitelist elementer – blokér div/span/section osv.
                valid_elements: 'p,strong,em,b,i,ul,ol,li,br,blockquote,h3,h4',
                invalid_elements: 'div,span,section,article,header,footer,style,script',
                entity_encoding: 'raw',
                verify_html: true,                 // TinyMCE validerer/renser HTML
            });
        });
    </script>
@endpush
</x-layout>
