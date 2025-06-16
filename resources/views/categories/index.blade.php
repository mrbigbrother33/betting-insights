<x-layout title="Kategorier">
    <div class="max-w-5xl mx-auto py-10">
        <h1 class="text-2xl font-bold text-indigo-700 mb-6">Udforsk kategorier</h1>

        <div class="grid md:grid-cols-3 gap-6">
            @forelse ($categories as $category)
                <a href="{{ route('categories.show', $category->slug) }}"
                   class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:shadow-md transition">

                    <div class="flex items-center justify-between mb-2">
                        <h2 class="text-lg font-semibold text-indigo-700">
                            {{ $category->name }}
                        </h2>

                        {{-- Valgfrit ikon --}}
                        <span class="text-gray-400 text-sm">
                            {{ $category->insights_count ?? 0 }} indlæg
                        </span>
                    </div>

                    {{-- Valgfri beskrivelse --}}
                    @if ($category->description)
                        <p class="text-sm text-gray-600">
                            {{ Str::limit($category->description, 80) }}
                        </p>
                    @endif

                </a>
            @empty
                <p class="text-gray-500 col-span-3">Ingen kategorier tilgængelige.</p>
            @endforelse
        </div>
    </div>
</x-layout>
