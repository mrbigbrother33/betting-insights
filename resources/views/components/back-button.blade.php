@props(['href' => url()->previous(), 'label' => '← Tilbage'])

<a href="{{ $href }}"
   class="inline-block text-sm text-indigo-600 hover:underline mb-6">
   {{ $label }}
</a>
