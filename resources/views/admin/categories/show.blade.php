<x-layout :title="$category->name">
    <h1 class="text-3xl font-bold mb-6">{{ $category->name }}</h1>

    @if ($category->insights->isEmpty())
        <p class="text-gray-500">Der er endnu ingen insights i denne kategori.</p>
    @else
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($category->insights as $insight)
                <x-insight-card :insight="$insight" />
            @endforeach
        </div>
    @endif
</x-layout>
