<x-layout title="Alle insights">
    <section class="max-w-6xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold text-indigo-700 mb-6 text-center">Alle insights</h1>

        @include('partials.search-sort-form')

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($insights as $insight)
                    <x-insight-card :insight="$insight" />
            @endforeach
        </div>

        <div class="mt-12">
            {{ $insights->links('pagination::tailwind') }}
        </div>
    </section>
</x-layout>
