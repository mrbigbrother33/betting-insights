@props(['url' => '/', 'active' => false, 'icon' => null, 'mobile' => false])


<a href="{{$url}}" class="text-sm font-medium px-2 py-1 rounded text-gray-700 hover:text-indigo-500 {{ $active ? 'text-indigo-600 font-semibold' : '' }}">
    @if($icon)
    <i class="fa fa-{{ $icon }} mr-1"></i>
    @endif 
    {{$slot}}
</a>
