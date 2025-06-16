<form method="GET" action="" class="mb-6 bg-white p-4 rounded-md shadow-sm border flex flex-col md:flex-row md:items-center gap-4">
    <input type="text"
           name="search"
           value="{{ request('search') }}"
           placeholder="Søg indlæg..."
           class="w-full md:w-1/2 px-4 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring focus:ring-indigo-200 text-sm" />

    <select name="sort"
            class="w-full md:w-48 px-4 py-2 border border-gray-300 bg-white rounded-md text-sm shadow-sm focus:outline-none focus:ring focus:ring-indigo-200">
        <option value="">Sortér efter</option>
        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Nyeste</option>
        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Ældste</option>
        <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Mest liket</option>
    </select>

    <button type="submit"
            class="bg-indigo-600 text-white text-sm px-5 py-2 rounded-md hover:bg-indigo-500 transition">
        Anvend
    </button>
</form>
