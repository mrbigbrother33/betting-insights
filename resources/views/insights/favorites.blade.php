<x-layout title="Mine favoritter">
    <div class="max-w-5xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6 text-indigo-700">Mine favoritter</h1>

        @if($insights->count())
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($insights as $insight)
                    <x-insight-card :insight="$insight" />
                @endforeach
            </div>
        @else
            <p class="text-gray-600">Du har endnu ikke liket nogle indlæg.</p>
        @endif
    </div>
</x-layout>
