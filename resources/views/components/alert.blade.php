@props(['type', 'message', 'timeout' => 5000])

@if(session()->has($type))
    <div 
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, {{ $timeout }})"
        x-show="show"
        class="p-4 mb-4 text-sm rounded border 
            {{ $type === 'success' 
                ? 'bg-green-50 border-green-200 text-green-800' 
                : 'bg-red-50 border-red-200 text-red-800' }}">
        {{ $message }}
    </div>
@endif
