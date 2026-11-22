@props([
    'label',
    'title',
    'accent' => null,
    'subtitle' => null,
])

<div {{ $attributes->merge(['class' => 'border-b border-zinc-800 p-6 sm:p-10 lg:px-14 lg:py-8 relative']) }}>
    <p class="text-xs font-roboto-mono font-semibold tracking-[0.2em] text-amber-500 uppercase mb-2">
        {{ $label }}
    </p>

    <h2 class="font-oxanium font-extrabold text-2xl sm:text-4xl lg:text-5xl uppercase tracking-tight text-white leading-tight sm:leading-tight lg:leading-[1.15]">
        {{ $title }}
        @if(!empty($accent))
            <span class="text-amber-500">
                {{ $accent }}
            </span>
        @endif
    </h2>

    <div class="flex items-center gap-2 mt-4 {{ !empty($subtitle) ? 'mb-3' : '' }}">
        <span class="h-[2px] w-20 bg-amber-500"></span>
        <span class="h-[2px] w-2.5 bg-amber-500/40"></span>
    </div>

    @if(!empty($subtitle))
        <p class="text-slate-400 font-roboto-mono text-xs sm:text-sm max-w-2xl leading-relaxed">
            {{ $subtitle }}
        </p>
    @endif
</div>
