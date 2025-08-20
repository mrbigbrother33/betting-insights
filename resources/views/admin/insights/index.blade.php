<x-layout title="Indlæg">
    <div class="max-w-6xl mx-auto py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-indigo-700">Indlæg (Admin)</h1>

            <a href="{{ route('admin.insights.create') }}"
               class="inline-flex items-center gap-1 px-4 py-2 bg-indigo-600 text-white text-sm rounded hover:bg-indigo-500 transition">
                <i class="fa fa-plus"></i> Opret nyt indlæg
            </a>
        </div>

        <div class="bg-white border border-gray-200 shadow-sm rounded overflow-x-auto">
            <table class="min-w-full table-auto text-sm">
                <thead class="bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase">
                    <tr>
                        <th class="px-4 py-3">Titel</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Publiceret</th>
                        <th class="px-4 py-3">Antal klik</th>
                        <th class="px-4 py-3 text-right">Handlinger</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($insights as $insight)
                        <tr>
                            <td class="px-4 py-3 font-medium">{{ $insight->title }}</td>
                            <td class="px-4 py-3">{{ $insight->category->name ?? '-' }}</td>
                            <td class="px-4 py-3 text-gray-600">
                                {{ $insight->published_at?->format('d/m/Y') ?? 'Ikke publiceret' }}
                            </td>
                             <td>{{ $insight->click_count ?? 0 }}</td>
                            <td class="px-4 py-3 text-right space-x-2">
                                <a href="{{ route('admin.insights.edit', $insight) }}"
                                   class="text-sm text-indigo-600 hover:underline">Rediger</a>

                                <form method="POST" action="{{ route('admin.insights.destroy', $insight) }}"
                                      class="inline-block"
                                      onsubmit="return confirm('Slet dette indlæg?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600 hover:underline">Slet</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-6 text-center text-gray-500">Ingen indlæg oprettet endnu.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $insights->links() }}
        </div>
    </div>
</x-layout>
