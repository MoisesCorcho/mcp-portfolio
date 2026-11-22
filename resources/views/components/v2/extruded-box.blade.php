@props([
    'as' => 'div',
    'variant' => 'zinc',
    'depth' => 'md',
    'interactive' => null,
    'cadPins' => false,
    'glow' => false,
])

@php
    $depthPx = match ($depth) {
        'sm' => 4,
        'md' => 8,
        'lg' => 14,
        default => is_numeric($depth) ? (int)$depth : 8,
    };

    $marginClass = match ($depth) {
        'sm' => 'mr-1.5 mb-1',
        'lg' => 'mr-4 mb-3.5',
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
            'class' => 'bg-card text-zinc-200 border-zinc-800',
            'right' => '#11141e',
            'bottom' => '#05070a',
            'border' => '#27272a',
            'shadow' => 'rgba(0, 0, 0, 0.8)',
        ],
        'emerald' => [
            'class' => 'bg-emerald-950/80 text-emerald-200 border-emerald-500/60',
            'right' => '#064e3b',
            'bottom' => '#022c22',
            'border' => '#059669',
            'shadow' => 'rgba(16, 185, 129, 0.15)',
        ],
        'ghost' => [
            'class' => 'bg-transparent text-zinc-300 border-zinc-800',
            'right' => 'rgba(39, 39, 42, 0.5)',
            'bottom' => 'rgba(24, 24, 27, 0.7)',
            'border' => '#27272a',
            'shadow' => 'rgba(0, 0, 0, 0.3)',
        ],
        default => [ // 'zinc'
            'class' => 'bg-zinc-900/90 text-zinc-100 border-zinc-700/80',
            'right' => '#18181b',
            'bottom' => '#09090b',
            'border' => '#3f3f46',
            'shadow' => 'rgba(0, 0, 0, 0.75)',
        ],
    };

    $isInteractive = $interactive ?? in_array($as, ['button', 'a']);
    $interactiveClass = $isInteractive ? 'v2-extruded-interactive select-none cursor-pointer' : '';
    $glowClass = $glow && $variant === 'amber' ? 'shadow-[0_0_25px_rgba(245,158,11,0.25)]' : '';
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

    {{ $slot }}
</{{ $as }}>
