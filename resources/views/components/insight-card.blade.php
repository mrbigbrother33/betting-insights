<div class="bg-white shadow-sm border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition">
    @if ($insight->image_url)
              <img src="{{ asset('storage/' . $insight->image_url) }}" alt="Billede"
         class="w-full h-40 object-cover">
    @else
        <div class="w-full h-40 bg-indigo-50 flex items-center justify-center text-indigo-400">
            <!-- Heroicon: Lightbulb -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 2a7 7 0 00-4 12.9V17a1 1 0 001 1h6a1 1 0 001-1v-2.1A7 7 0 0012 2z"/>
            </svg>
        </div>
    @endif

    <div class="p-4">
        <h2 class="text-lg font-semibold mb-1">
            <a href="{{ route('insights.show', $insight) }}" class="text-indigo-600 hover:underline">
                {{ $insight->title }}
            </a>
        </h2>

        <p class="text-sm text-gray-500 mb-2">
            {{ $insight->published_at?->format('d. M Y') ?? 'Ikke publiceret' }} –
            {{ $insight->category->name ?? 'Ingen kategori' }}
        </p>

        <p class="text-gray-700 text-sm leading-relaxed">
            {!! Str::limit($insight->content, 300) !!}
        </p>

        <x-like-button :insight="$insight" />
    </div>
    

</div>
