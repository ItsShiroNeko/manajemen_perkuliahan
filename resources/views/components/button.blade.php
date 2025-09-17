@props([
    'type' => 'button',
    'variant' => null,    
    'color' => null,
    'size' => 'md',
    'icon' => null,
    'iconPosition' => 'left',
])

@php
    $base = "inline-flex items-center justify-center font-semibold rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 transition";

    $colors = [
        'primary' => "bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500",
        'secondary' => "bg-gray-600 text-white hover:bg-gray-700 focus:ring-gray-500",
        'danger' => "bg-red-600 text-white hover:bg-red-700 focus:ring-red-500",
        'warning' => 'bg-yellow-500 text-white hover:bg-yellow-700 focus:ring-yellow-500',
        'success' => 'bg-green-500 text-white hover:bg-green-700 focus:ring-green-500',
    ];

    $sizes = [
        'sm' => "px-2 py-1 text-sm space-x-1",
        'md' => "px-4 py-2 text-base space-x-2",
        'lg' => "px-6 py-3 text-lg space-x-3",
    ];

    $variants = [
        'add' => ['color' => 'primary', 'icon' => 'fa-solid fa-plus', 'text' => 'Tambah'],
        'edit' => ['color' => 'warning', 'icon' => 'fa-solid fa-pen', 'text' => 'Edit'],
        'delete' => ['color' => 'danger', 'icon' => 'fa-solid fa-trash', 'text' => 'Hapus'],
        'details' => ['color' => 'secondary', 'icon' => 'fa-solid fa-eye', 'text' => 'Detail'],
        'send' => ['color' => 'success', 'icon' => 'fa-solid fa-paper-plane', 'text' => 'Kirim'],
        'save' => ['color' => 'primary', 'icon' => 'fa-solid fa-save', 'text' => 'Simpan'],
        'cancel' => ['color' => 'danger', 'icon' => 'fa-solid fa-xmark', 'text' => 'Batal'],
    ];

    if ($variant && isset($variants[$variant])) {
        $color = $color ?: $variants[$variant]['color'];
        $icon = $icon ?: $variants[$variant]['icon'];
        $defaultText = $variants[$variant]['text'];
    } else {
        $defaultText = $slot ?: '';
    }
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => "$base {$colors[$color]} {$sizes[$size]}"]) }}>
    @if($icon && $iconPosition === 'left')
        <i class="{{ $icon }}"></i>
    @endif

    <span>{{ $slot->isEmpty() ? $defaultText : $slot }}</span>

    @if($icon && $iconPosition === 'right')
        <i class="{{ $icon }}"></i>
    @endif
</button>
