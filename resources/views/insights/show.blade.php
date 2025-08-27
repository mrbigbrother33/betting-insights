<x-layout :title="$insight->title"
    :metaTitle="$insight->title"
    :metaDescription="Str::limit(strip_tags($insight->content), 150)"
    :metaImage="$insight->image_url ? asset('storage/' . $insight->image_url) : asset('default-og-image.jpg')">
    <article class="max-w-3xl mx-auto bg-white shadow-sm border border-gray-200 rounded-lg overflow-hidden">

    
        @if ($insight->image_url)
    <img src="{{ asset('storage/' . $insight->image_url) }}" alt="Billede"
         class="w-full h-64 object-cover">
@endif

        <div class="p-6">
            {{-- Rediger / slet --}}
            @auth
            @if(auth()->user()->is_admin)
                <div class="flex justify-end gap-3 mb-4">
                    <a href="{{ route('admin.insights.edit', $insight) }}" class="inline-flex items-center gap-1 text-sm bg-indigo-600 text-white px-3 py-1.5 rounded hover:bg-indigo-500 transition">
                        ✏️ Rediger
                    </a>

                    <form method="POST" action="{{ route('admin.insights.destroy', $insight) }}"
                          onsubmit="return confirm('Er du sikker på, at du vil slette dette indlæg?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center gap-1 text-sm bg-red-600 text-white px-3 py-1.5 rounded hover:bg-red-500 transition">
                            🗑 Slet
                        </button>
                    </form>
                </div>
                @endif
            @endauth

            <h1 class="text-3xl font-bold mb-2 text-indigo-700">{{ $insight->title }}</h1>

            <p class="text-sm text-gray-500 mb-4">
                {{ $insight->published_at?->format('d. M Y') ?? 'Ikke publiceret' }} ·
                {{ $insight->category->name ?? 'Ingen kategori' }}
            </p>

            <div class="prose prose-indigo max-w-none mb-6">
    @auth
     <div class="prose prose-indigo max-w-none">
    {!! $insight->content !!}
</div>
    @else
    <div class="prose prose-indigo max-w-none">
       {!! html_limit($insight->content, 500) !!}
        </div>        

<div class="mt-4 bg-yellow-50 border border-yellow-200 text-yellow-800 text-sm p-4 rounded">
    <p class="font-medium mb-2">Vil du læse hele indlægget?</p>
    <a href="{{ route('register') }}" class="inline-block text-indigo-600 underline hover:text-indigo-800">
        Opret en gratis bruger
    </a>
    eller
    <a href="{{ route('login') }}" class="text-indigo-600 underline hover:text-indigo-800">
        log ind her
    </a>
    for at få adgang til hele indholdet.
</div>
<br>
    @endauth

    
</div>

            {{-- Like-knap --}}
            <div class="mb-6">
                <x-like-button :insight="$insight" />
            </div>

            @if ($insight->affiliate_url)
                <div>
                    <a href="{{ $insight->affiliate_url }}" target="_blank"
                       class="inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500 transition">
                        Læs mere / Gå til anbefalet platform →
                    </a>
                </div>
            @endif
        </div>
    </article>
</x-layout>
