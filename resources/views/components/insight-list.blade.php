@props(['insights'])

<section class="py-16 bg-gray-50 border-t border-gray-200">
    <div class="max-w-4xl mx-auto px-4">
        <h2 class="text-2xl font-bold text-indigo-700 mb-4">Seneste insights</h2>
        <p class="text-gray-700 mb-8">
            Her finder du konkrete analyser og erfaringer om investering, betting og trading – med fokus på at bygge strategier, der kan give frihed og overskud.
        </p>

        <div class="space-y-6">
            @forelse ($insights as $insight)
                <x-insight-card :insight="$insight" />
            @empty
                <p class="text-sm text-gray-500">Ingen insights fundet endnu.</p>
            @endforelse
        </div>

        <div class="text-center mt-10">
            <a href="{{ route('insights.index') }}"
               class="inline-block bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-500 transition">
                Se alle insights →
            </a>
        </div>
    </div>
</section>
