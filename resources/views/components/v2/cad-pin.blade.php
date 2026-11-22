@props([
    'color' => 'bg-amber-500',
    'border' => 'border-black',
    'size' => 'w-3 h-3',
])

<span
    {{ $attributes->merge(['class' => "{$size} {$color} z-20 border {$border} pointer-events-none select-none"]) }}
    aria-hidden="true"
></span>
