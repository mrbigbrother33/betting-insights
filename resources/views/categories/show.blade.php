<x-layout :title="$category->name">
    <div class="max-w-5xl mx-auto py-8">

        <h1 class="text-2xl font-bold mb-6 text-indigo-700">Indlæg i "{{ $category->name }}"</h1>

        @include('partials.search-sort-form')

        <div class="grid md:grid-cols-2 gap-6">
            @forelse($insights as $insight)
                <x-insight-card :insight="$insight" />
            @empty
                <p class="text-gray-500 col-span-2">Ingen indlæg fundet i denne kategori.</p>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $insights->withQueryString()->links() }}
        </div>
    </div>
</x-layout>
