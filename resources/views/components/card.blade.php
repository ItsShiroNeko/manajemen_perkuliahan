@props([
    'title' => null,
    'footer' => null,
    'shadow' => true,
])

@php
    $base = "bg-white rounded-xl overflow-hidden";
    $shadowClass = $shadow ? "shadow-md hover:shadow-lg transition" : "";
@endphp

<div {{ $attributes->merge(['class' => "$base $shadowClass"]) }}>
    {{-- Header --}}
    @if($title)
        <div class="px-4 py-3 border-b border-gray-200 font-semibold text-lg">
            {{ $title }}
        </div>
    @endif

    {{-- Body --}}
    <div class="px-4 py-3">
        {{ $slot }}
    </div>

    {{-- Footer --}}
    @if($footer)
        <div class="px-4 py-2 border-t border-gray-200 text-sm text-gray-600">
            {{ $footer }}
        </div>
    @endif
</div>
