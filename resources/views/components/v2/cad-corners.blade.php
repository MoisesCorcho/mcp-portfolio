@props([
    'color' => 'text-amber-500',
    'size' => 'text-[10px]',
])

<span class="absolute top-1 left-1 font-mono {{ $size }} {{ $color }} leading-none select-none pointer-events-none" aria-hidden="true">⌜</span>
<span class="absolute top-1 right-1 font-mono {{ $size }} {{ $color }} leading-none select-none pointer-events-none" aria-hidden="true">⌝</span>
<span class="absolute bottom-1 left-1 font-mono {{ $size }} {{ $color }} leading-none select-none pointer-events-none" aria-hidden="true">⌞</span>
<span class="absolute bottom-1 right-1 font-mono {{ $size }} {{ $color }} leading-none select-none pointer-events-none" aria-hidden="true">⌟</span>
