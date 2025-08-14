<div x-data="{ liked: {{ json_encode($liked ?? false) }}, count: {{ $likeCount }} }">
    @auth
        <button @click.prevent="
            fetch('{{ route('insights.like', $insight) }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                liked = data.liked;
                count = data.count;
            });
        "
        class="inline-flex items-center gap-2 text-xs px-3 py-1.5 rounded-full border transition 
               duration-200"
        :class="liked 
            ? 'bg-red-600 text-white hover:bg-red-500 border-red-600' 
            : 'bg-gray-100 text-gray-700 hover:bg-gray-200 border-gray-200'">
            <i :class="liked ? 'fas fa-heart' : 'far fa-heart'"></i>
            <span x-text="count"></span>
        </button>
    @else
        <div class="inline-flex items-center gap-2 text-xs px-3 py-1.5 rounded-full bg-gray-100 text-gray-500 border border-gray-200" title="Log ind for at like">
            <i class="far fa-heart"></i>
            <span x-text="count"></span>
            <span>synes godt om</span>
        </div>
    @endauth
</div>
