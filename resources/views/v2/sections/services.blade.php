{{-- ====== Portfolio V2: Services & Capabilities Chamber ====== --}}
<section id="services" class="relative border-b border-zinc-800">
    {{-- ── 1. Section Header Strip ── --}}
    <div class="border-b border-zinc-800 p-6 sm:p-10 lg:px-14 lg:py-8 relative">
        <p class="text-xs font-roboto-mono font-semibold tracking-[0.2em] text-amber-500 uppercase mb-2">
            {{ __('home.services_label') }}
        </p>

        <h2 class="font-oxanium font-extrabold text-2xl sm:text-4xl lg:text-5xl uppercase tracking-tight text-white leading-tight sm:leading-tight lg:leading-[1.15]">
            {{ __('home.services_heading') }}
            <span class="text-amber-500">
                {{ __('home.services_heading_accent') }}
            </span>
        </h2>

        {{-- Amber Accent Ruler --}}
        <div class="flex items-center gap-2 mt-4 mb-3">
            <span class="h-[2px] w-20 bg-amber-500"></span>
            <span class="h-[2px] w-2.5 bg-amber-500/40"></span>
        </div>

        <p class="text-slate-400 font-roboto-mono text-xs sm:text-sm max-w-2xl leading-relaxed">
            {{ __('home.services_subtitle') }}
        </p>
    </div>

    {{-- ── 2. Services Grid (2x2 Orthogonal Matrix with CAD Intersections) ── --}}
    <div class="grid grid-cols-1 md:grid-cols-2 divide-y md:divide-y-0 divide-zinc-800 relative">

        {{-- Top Center CAD Pin (intersection of vertical divider and section header floor line) --}}
        <span class="hidden md:block absolute -top-1.5 left-1/2 -translate-x-1.5 w-3 h-3 bg-amber-500 z-20 border border-black pointer-events-none" aria-hidden="true"></span>

        {{-- Bottom Center CAD Pin (intersection of vertical divider and bottom floor line) --}}
        <span class="hidden md:block absolute -bottom-1.5 left-1/2 -translate-x-1.5 w-3 h-3 bg-amber-500 z-20 border border-black pointer-events-none" aria-hidden="true"></span>

        @foreach(config('portfolio.services', []) as $index => $service)
            <div class="p-6 sm:p-8 lg:p-10 flex flex-col justify-between bg-chamber/40 hover:bg-zinc-950/80 transition-colors duration-300 group relative overflow-hidden {{ $index % 2 === 0 ? 'md:border-r border-zinc-800' : '' }} {{ $index >= 2 ? 'md:border-t border-zinc-800' : '' }}">

                {{-- Center CAD Crosshair Node (exact junction of the 4 chambers, pinned to bottom-right of cell 0) --}}
                @if($index === 0)
                    <span class="hidden md:block absolute -bottom-1.5 -right-1.5 w-3 h-3 bg-amber-500 z-30 border border-black pointer-events-none" aria-hidden="true"></span>
                @endif

                {{-- 4 Corner Reticle Marks --}}
                <span class="absolute top-2 left-2 font-mono text-[10px] text-zinc-700/80 group-hover:text-amber-500/80 leading-none select-none transition-colors" aria-hidden="true">⌜</span>
                <span class="absolute top-2 right-2 font-mono text-[10px] text-zinc-700/80 group-hover:text-amber-500/80 leading-none select-none transition-colors" aria-hidden="true">⌝</span>
                <span class="absolute bottom-2 left-2 font-mono text-[10px] text-zinc-700/80 group-hover:text-amber-500/80 leading-none select-none transition-colors" aria-hidden="true">⌞</span>
                <span class="absolute bottom-2 right-2 font-mono text-[10px] text-zinc-700/80 group-hover:text-amber-500/80 leading-none select-none transition-colors" aria-hidden="true">⌟</span>

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
        @endforeach

    </div>
</section>
