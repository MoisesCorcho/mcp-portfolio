@props([
    'as' => 'div',
    'variant' => 'zinc',
    'depth' => 'md',
    'interactive' => null,
    'cadPins' => false,
    'glow' => false,
    'sheen' => true,
])

@php
    $depthPx = match ($depth) {
        'sm' => 4,
        'md' => 8,
        'lg' => 16,
        default => is_numeric($depth) ? (int)$depth : 8,
    };

    $marginClass = match ($depth) {
        'sm' => 'mr-1.5 mb-1',
        'lg' => 'mr-4.5 mb-4',
        default => 'mr-2.5 mb-2',
    };

    $config = match ($variant) {
        'amber' => [
            'class' => 'bg-amber-500 text-black border-amber-300/90 font-bold',
            'right' => '#d97706',
            'bottom' => '#92400e',
            'border' => '#000000',
            'shadow' => 'rgba(245, 158, 11, 0.25)',
        ],
        'card' => [
            'class' => 'bg-zinc-800/95 text-zinc-100 border-zinc-600/80',
            'right' => '#1c1e26',
            'bottom' => '#0f1016',
            'border' => '#52525b',
            'shadow' => 'rgba(161, 161, 170, 0.22)',
        ],
        'emerald' => [
            'class' => 'bg-emerald-950/80 text-emerald-200 border-emerald-500/60',
            'right' => '#064e3b',
            'bottom' => '#022c22',
            'border' => '#059669',
            'shadow' => 'rgba(16, 185, 129, 0.25)',
        ],
        'ghost' => [
            'class' => 'bg-transparent text-zinc-300 border-zinc-800',
            'right' => 'rgba(39, 39, 42, 0.5)',
            'bottom' => 'rgba(24, 24, 27, 0.7)',
            'border' => '#27272a',
            'shadow' => 'rgba(113, 113, 122, 0.15)',
        ],
        default => [ // 'zinc'
            'class' => 'bg-zinc-700/95 text-zinc-100 border-zinc-500/80',
            'right' => '#27272a',
            'bottom' => '#14151b',
            'border' => '#52525b',
            'shadow' => 'rgba(161, 161, 170, 0.25)',
        ],
    };

    $isInteractive = $interactive ?? in_array($as, ['button', 'a']);
    $interactiveClass = $isInteractive ? 'v2-extruded-interactive select-none cursor-pointer' : '';
    $glowClass = match (true) {
        $glow && $variant === 'amber' => 'shadow-[0_0_25px_rgba(245,158,11,0.25)]',
        $glow && ($variant === 'zinc' || $variant === 'card') => 'shadow-[0_0_20px_rgba(161,161,170,0.18)]',
        default => '',
    };
@endphp

<{{ $as }}
    {{ $attributes->merge([
        'class' => "v2-extruded relative isolation-isolate border {$config['class']} {$interactiveClass} {$marginClass} {$glowClass}"
    ]) }}
    data-extruded
    data-depth="{{ $depthPx }}"
    data-ext-right="{{ $config['right'] }}"
    data-ext-bottom="{{ $config['bottom'] }}"
    data-ext-border="{{ $config['border'] }}"
    data-ext-shadow="{{ $config['shadow'] }}"
>
    @if($cadPins)
        <span class="absolute -top-[3px] -left-[3px] w-[5px] h-[5px] bg-amber-500/80 pointer-events-none z-10" aria-hidden="true"></span>
        <span class="absolute -top-[3px] -right-[3px] w-[5px] h-[5px] bg-amber-500/80 pointer-events-none z-10" aria-hidden="true"></span>
        <span class="absolute -bottom-[3px] -left-[3px] w-[5px] h-[5px] bg-amber-500/80 pointer-events-none z-10" aria-hidden="true"></span>
        <span class="absolute -bottom-[3px] -right-[3px] w-[5px] h-[5px] bg-amber-500/80 pointer-events-none z-10" aria-hidden="true"></span>
    @endif

    @if($sheen)
        <span class="v2-extruded-sheen absolute inset-0 overflow-hidden pointer-events-none z-10" aria-hidden="true">
            <span class="v2-extruded-beam"></span>
        </span>
    @endif

    {{ $slot }}
</{{ $as }}>
