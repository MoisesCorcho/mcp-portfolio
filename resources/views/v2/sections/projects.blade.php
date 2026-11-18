{{-- ====== Portfolio V2: Projects Showroom Chamber ====== --}}
<section id="portfolio" class="relative border-b border-zinc-800">
    {{-- ── 1. Section Header Strip ── --}}
    <div class="border-b border-zinc-800 p-6 sm:p-10 lg:px-14 lg:py-8 relative">
        <p class="text-xs font-roboto-mono font-semibold tracking-[0.2em] text-amber-500 uppercase mb-2">
            {{ __('home.portfolio_label') }}
        </p>

        <h2 class="font-oxanium font-extrabold text-2xl sm:text-4xl lg:text-5xl uppercase tracking-tight text-white leading-tight sm:leading-tight lg:leading-[1.15]">
            {{ __('home.portfolio_heading') }}
            <span class="text-amber-500">
                {{ __('home.portfolio_heading_accent') }}
            </span>
        </h2>

        {{-- Amber Accent Ruler --}}
        <div class="flex items-center gap-2 mt-4 mb-3">
            <span class="h-[2px] w-20 bg-amber-500"></span>
            <span class="h-[2px] w-2.5 bg-amber-500/40"></span>
        </div>

        <p class="text-slate-400 font-roboto-mono text-xs sm:text-sm max-w-2xl leading-relaxed">
            {{ __('home.portfolio_subtitle') }}
        </p>
    </div>

    {{-- ── 2. Projects Grid (Orthogonal CAD Framing) ── --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 divide-y lg:divide-y-0 divide-zinc-800 relative">

        {{-- Center Column Intersection Pins on Desktop --}}
        <span class="hidden lg:block absolute -top-1.5 left-1/2 -translate-x-1.5 w-3 h-3 bg-amber-500 z-20 border border-black pointer-events-none" aria-hidden="true"></span>
        <span class="hidden lg:block absolute -bottom-1.5 left-1/2 -translate-x-1.5 w-3 h-3 bg-amber-500 z-20 border border-black pointer-events-none" aria-hidden="true"></span>

        @foreach(config('portfolio.projects', []) as $index => $project)
            <div class="p-6 sm:p-8 lg:p-10 flex flex-col justify-between bg-chamber/30 hover:bg-zinc-950/60 transition-colors duration-200 group relative {{ $index % 2 === 0 ? 'lg:border-r border-zinc-800' : '' }} {{ $index >= 2 ? 'border-t border-zinc-800' : '' }}">

                {{-- Corner Reticle Marks for Special / Featured Projects --}}
                @if(!empty($project['badge']))
                    <span class="absolute top-2 left-2 font-mono text-[10px] text-amber-500/80 leading-none select-none" aria-hidden="true">⌜</span>
                    <span class="absolute top-2 right-2 font-mono text-[10px] text-amber-500/80 leading-none select-none" aria-hidden="true">⌝</span>
                @endif

                <div>
                    {{-- Category & Badges Row --}}
                    <div class="flex flex-wrap items-center justify-between gap-2 mb-5">
                        <span class="font-roboto-mono text-xs font-bold text-amber-500/90 tracking-wider uppercase">
                            {{ $project['category'] }}
                        </span>

                        @if(!empty($project['badge']))
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 border border-amber-500/40 bg-amber-500/10 text-[10px] font-roboto-mono text-amber-400 font-semibold uppercase tracking-wider">
                                <span class="w-1.5 h-1.5 bg-amber-400 animate-pulse"></span>
                                {{ $project['badge'] }}
                            </span>
                        @endif
                    </div>

                    {{-- Title in Oxanium --}}
                    <h3 class="font-oxanium font-extrabold text-2xl sm:text-3xl text-white uppercase tracking-tight group-hover:text-amber-400 transition-colors mb-3">
                        {{ $project['title'] }}
                    </h3>

                    {{-- Description in Roboto Mono --}}
                    <p class="font-roboto-mono text-xs sm:text-sm text-slate-300 leading-relaxed mb-6">
                        {{ __($project['desc_key']) }}
                    </p>
                </div>

                <div>
                    {{-- Technology Tags Matrix --}}
                    <div class="flex flex-wrap gap-1.5 mb-6 pt-5 border-t border-zinc-800/80">
                        @foreach($project['tags'] as $tag)
                            <span class="px-2.5 py-1 border border-zinc-800 bg-card text-[11px] font-roboto-mono text-zinc-400">
                                {{ $tag }}
                            </span>
                        @endforeach
                    </div>

                    {{-- Action CTAs --}}
                    <div class="flex flex-wrap items-center gap-3">
                        @if(!empty($project['url']))
                            <a
                                href="{{ $project['url'] }}"
                                @if(!str_starts_with($project['url'], '/')) target="_blank" rel="noopener noreferrer" @endif
                                class="inline-flex items-center gap-2 px-5 py-2.5 bg-amber-500 hover:bg-amber-400 text-black font-roboto-mono font-bold text-xs uppercase tracking-wider transition-all duration-200 border border-amber-300 shadow-[0_0_15px_rgba(245,158,11,0.2)]"
                            >
                                <span>{{ str_starts_with($project['url'], '/') ? __('home.project_view_game') : __('home.project_view_live') }}</span>
                                <svg class="w-3.5 h-3.5 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="square" stroke-linejoin="miter" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        @endif

                        @if(!empty($project['github']))
                            <a
                                href="{{ $project['github'] }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex items-center gap-2 px-4 py-2.5 bg-zinc-900/90 hover:bg-zinc-800 text-zinc-300 hover:text-white font-roboto-mono font-semibold text-xs uppercase tracking-wider transition-all duration-200 border border-zinc-700 hover:border-zinc-500"
                            >
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/>
                                </svg>
                                <span>{{ __('home.project_view_github') }}</span>
                            </a>
                        @endif
                    </div>
                </div>

            </div>
        @endforeach

    </div>
</section>
