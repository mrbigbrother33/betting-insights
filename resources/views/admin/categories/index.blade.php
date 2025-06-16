<x-layout title="Kategorier">
    <div class="max-w-4xl mx-auto py-8">
        <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-indigo-700">Kategorier</h1>
       
        <a href="{{ route('admin.categories.create') }}"
               class="inline-flex items-center gap-1 px-4 py-2 bg-indigo-600 text-white text-sm rounded hover:bg-indigo-500 transition">
                <i class="fa fa-plus"></i> Opret kategori
            </a>
        </div>

        <ul class="space-y-2">
            @foreach ($categories as $category)
                <li class="flex justify-between items-center bg-white border px-4 py-2 rounded">
                    <div>
                        <strong>{{ $category->name }}</strong>
                        <span class="text-gray-500 text-sm">({{ $category->slug }})</span>
                    </div>
                    <td class="px-4 py-2 text-right whitespace-nowrap">
    <div class="inline-flex gap-2">
        <a href="{{ route('admin.categories.edit', $category) }}"
           class="px-3 py-1 text-sm bg-indigo-600 text-white rounded hover:bg-indigo-500 transition">
            ✏️ Rediger
        </a>

        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
              onsubmit="return confirm('Vil du slette denne kategori?')">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="px-3 py-1 text-sm bg-red-600 text-white rounded hover:bg-red-500 transition">
                🗑 Slet
            </button>
        </form>
    </div>
</td>

                </li>
            @endforeach
        </ul>
    </div>
</x-layout>
