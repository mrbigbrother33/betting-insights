@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center mt-10">
        <ul class="inline-flex items-center space-x-1 text-sm">
            {{-- Forrige side link --}}
            @if ($paginator->onFirstPage())
                <li class="px-3 py-1.5 bg-gray-100 text-gray-400 rounded border border-gray-200">
                    ←
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                       class="px-3 py-1.5 bg-white text-indigo-600 border border-gray-200 rounded hover:bg-indigo-50 transition">
                        ←
                    </a>
                </li>
            @endif

            {{-- Sidelinks --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="px-3 py-1.5 text-gray-400">{{ $element }}</li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="px-3 py-1.5 bg-indigo-600 text-white rounded font-semibold border border-indigo-600">
                                {{ $page }}
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                   class="px-3 py-1.5 bg-white text-gray-700 rounded border border-gray-200 hover:bg-indigo-50 hover:text-indigo-600 transition">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Næste side link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                       class="px-3 py-1.5 bg-white text-indigo-600 border border-gray-200 rounded hover:bg-indigo-50 transition">
                        →
                    </a>
                </li>
            @else
                <li class="px-3 py-1.5 bg-gray-100 text-gray-400 rounded border border-gray-200">
                    →
                </li>
            @endif
        </ul>
    </nav>
@endif
