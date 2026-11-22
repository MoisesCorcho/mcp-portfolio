@props([
    'service',
    'index',
])

<div class="p-6 sm:p-8 lg:p-10 flex flex-col justify-between bg-chamber/40 hover:bg-zinc-950/80 transition-colors duration-300 group relative overflow-hidden {{ $index % 2 === 0 ? 'md:border-r border-zinc-800' : '' }} {{ $index >= 2 ? 'md:border-t border-zinc-800' : '' }}">

    {{-- Center CAD Crosshair Node (exact junction of the 4 chambers, pinned to bottom-right of cell 0) --}}
    @if($index === 0)
        <x-v2.cad-pin class="hidden md:block absolute -bottom-1.5 -right-1.5 z-30" />
    @endif

    {{-- 4 Corner Reticle Marks --}}
    <x-v2.cad-corners color="text-zinc-700/80 group-hover:text-amber-500/80" />

    {{-- Architectural Isometric Wireframe Schematic (Modular CAD Component) --}}
    <div class="absolute top-5 right-5 sm:top-8 sm:right-8 pointer-events-none opacity-45 group-hover:opacity-100 transition-all duration-300 z-0">
        @if($service['id'] === 'fullstack')
            <x-v2.schematics.fullstack />
        @elseif($service['id'] === 'mobile')
            <x-v2.schematics.mobile />
        @elseif($service['id'] === 'devops')
            <x-v2.schematics.devops />
        @elseif($service['id'] === 'ai' || $service['id'] === 'architecture')
            <x-v2.schematics.ai />
        @endif
    </div>

    {{-- Content Block (Elevated over watermark with crisp contrast) --}}
    <div class="relative z-10">
        {{-- Header Row: Index Number + Status Badge --}}
        <div class="flex items-center justify-between gap-2 mb-6">
            <span class="font-roboto-mono text-xs font-bold text-amber-500/80 tracking-widest uppercase">
                0{{ $index + 1 }}
            </span>
            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 border border-zinc-800 bg-zinc-900/80 text-[10px] font-roboto-mono text-zinc-400 uppercase tracking-wider">
                <span class="w-1.5 h-1.5 bg-amber-500"></span>
                {{ $service['badge'] }}
            </span>
        </div>

        {{-- Service Title in Oxanium --}}
        <h3 class="font-oxanium font-extrabold text-xl sm:text-2xl text-white uppercase tracking-tight group-hover:text-amber-400 transition-colors mb-4 max-w-[85%]">
            {{ __($service['title_key']) }}
        </h3>

        {{-- Service Description in Roboto Mono --}}
        <p class="font-roboto-mono text-xs sm:text-sm text-slate-400 leading-relaxed mb-6 max-w-[90%]">
            {{ __($service['desc_key']) }}
        </p>
    </div>

    {{-- Bottom Specifications & Technology Tags (Elevated over watermark) --}}
    <div class="pt-6 border-t border-zinc-800/80 relative z-10">
        <p class="font-roboto-mono text-[11px] font-semibold text-zinc-500 uppercase tracking-widest mb-3 group-hover:text-zinc-300 transition-colors">
            {{ $service['metric'] }}
        </p>

        <div class="flex flex-wrap gap-1.5">
            @foreach($service['tags'] as $tag)
                <span class="px-2 py-1 border border-zinc-800 bg-card text-[11px] font-roboto-mono text-zinc-400 group-hover:border-zinc-700 transition-colors">
                    {{ $tag }}
                </span>
            @endforeach
        </div>
    </div>

</div>
