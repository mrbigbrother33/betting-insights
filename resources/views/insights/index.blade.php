<x-layout title="Alle insights">
    <section class="max-w-6xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold text-indigo-700 mb-6 text-center">Alle insights</h1>

        @include('partials.search-sort-form')

        <div class="grid md:grid-cols-2 gap-6">
            @forelse($insights as $insight)
                <x-insight-card :insight="$insight" />
            @empty
                <p class="text-gray-500 col-span-2">Ingen indlæg fundet.</p>
            @endforelse
        </div>

      <div class="mt-12">
    {{ $insights->links('pagination::tailwind') }}
      </div>
    </section>
</x-layout>
