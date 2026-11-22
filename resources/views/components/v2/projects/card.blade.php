{{-- ====== Portfolio V2: Project Showcase Card Component ====== --}}
@props(['project'])

@php
    $isLive = (!empty($project['url']) && !str_starts_with($project['url'], '/')) || (!empty($project['badge']) && (str_contains(strtolower($project['badge']), 'live') || str_contains(strtolower($project['badge']), 'production')));
@endphp

<div
    x-show="activeDomain === 'all' || activeDomain === '{{ $project['domain'] }}'"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-[0.99]"
    x-transition:enter-end="opacity-100 scale-100"
    x-data="{ showSpecs: false }"
    @toggle-all-specs.window="showSpecs = $event.detail.expanded"
    class="p-6 sm:p-7 lg:p-7 xl:p-8 flex flex-col justify-between bg-zinc-900/40 hover:bg-zinc-900/80 transition-all duration-200 group relative border-b border-zinc-800"
>
    {{-- Corner Reticle Marks for Special Projects --}}
    @if(!empty($project['badge']))
        <x-v2.cad-corners :color="$isLive ? 'text-emerald-500/70' : 'text-amber-500/70'" />
    @endif

    <div>
        {{-- Category & Status Badge Row --}}
        <div class="flex flex-wrap items-center justify-between gap-2 mb-3.5">
            <span class="font-roboto-mono text-xs font-bold text-amber-500 tracking-wider uppercase">
                {{ $project['category'] }}
            </span>

            @if(!empty($project['badge']))
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 border text-[10px] font-roboto-mono uppercase tracking-wider transition-colors {{ $isLive ? 'border-emerald-500/30 bg-emerald-500/10 text-emerald-400' : 'border-zinc-800 bg-zinc-900/80 text-zinc-300 group-hover:border-amber-500/40 group-hover:text-amber-400' }}">
                    <span class="w-1.5 h-1.5 {{ $isLive ? 'bg-emerald-400 animate-pulse' : 'bg-amber-500' }}"></span>
                    {{ $project['badge'] }}
                </span>
            @endif
        </div>

        {{-- Title in Oxanium --}}
        <h3 class="font-oxanium font-extrabold text-xl sm:text-2xl text-white uppercase tracking-tight group-hover:text-amber-400 transition-colors mb-3">
            {{ $project['title'] }}
        </h3>

        {{-- Curated Technology Tags Matrix (Primary stack on front) --}}
        <div class="flex flex-wrap gap-1.5 mb-4">
            @foreach(array_slice($project['tags'], 0, 4) as $tag)
                <span class="px-2 py-0.5 border border-zinc-800 bg-card text-[11px] font-roboto-mono text-zinc-300">
                    {{ $tag }}
                </span>
            @endforeach
            @if(count($project['tags']) > 4)
                <span class="px-2 py-0.5 border border-zinc-800/80 bg-zinc-950/60 text-[11px] font-roboto-mono text-zinc-400 font-medium">
                    +{{ count($project['tags']) - 4 }}
                </span>
            @endif
        </div>

        {{-- Progressive Disclosure: Architecture Specs Drawer Toggle --}}
        <div class="my-2">
            <button
                type="button"
                @click="showSpecs = !showSpecs"
                class="inline-flex items-center gap-2 text-xs font-roboto-mono font-semibold text-zinc-400 hover:text-amber-400 uppercase tracking-wider transition-colors group/btn py-1 focus:outline-none"
            >
                <span class="w-1.5 h-1.5 bg-amber-500 transition-transform duration-200" :class="showSpecs ? 'scale-125' : ''"></span>
                <span x-text="showSpecs ? '{{ __('home.project_hide_specs') }}' : '{{ __('home.project_show_specs') }}'"></span>
                <svg class="w-3.5 h-3.5 transition-transform duration-200 stroke-[2.5]" :class="showSpecs ? 'rotate-180 text-amber-400' : 'text-zinc-500 group-hover/btn:text-amber-400'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="square" stroke-linejoin="miter" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            {{-- Expanded Architecture Specs Sub-Chamber --}}
            <div
                x-show="showSpecs"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-1"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-1"
                class="mt-3 p-4 border border-zinc-800/90 bg-zinc-950/80 relative"
            >
                <span class="absolute top-1 left-1 font-mono text-[9px] text-amber-500/50 leading-none select-none" aria-hidden="true">⌜</span>
                <span class="absolute top-1 right-1 font-mono text-[9px] text-amber-500/50 leading-none select-none" aria-hidden="true">⌝</span>
                <span class="absolute bottom-1 left-1 font-mono text-[9px] text-amber-500/50 leading-none select-none" aria-hidden="true">⌞</span>
                <span class="absolute bottom-1 right-1 font-mono text-[9px] text-amber-500/50 leading-none select-none" aria-hidden="true">⌟</span>

                <p class="font-roboto-mono text-xs sm:text-sm text-slate-300 leading-relaxed mb-3">
                    {{ __($project['desc_key']) }}
                </p>

                {{-- Full Stack in Specs Drawer --}}
                @if(count($project['tags']) > 4)
                    <div class="pt-3 border-t border-zinc-800/80">
                        <span class="text-[10px] font-roboto-mono text-zinc-400 uppercase tracking-wider block mb-1.5">{{ __('home.project_full_stack') }}</span>
                        <div class="flex flex-wrap gap-1">
                            @foreach($project['tags'] as $fullTag)
                                <span class="px-1.5 py-0.5 border border-zinc-800 bg-card text-[10px] font-roboto-mono text-zinc-300">
                                    {{ $fullTag }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Action CTAs (Calmed Quiet State with Hover Accent) --}}
    <div class="flex flex-wrap items-center gap-2.5 pt-4 mt-2 border-t border-zinc-800/80">
        @if(!empty($project['url']))
            @php
                $isExternal = !str_starts_with($project['url'], '/');
            @endphp
            <x-v2.extruded-box
                as="a"
                href="{{ $project['url'] }}"
                :target="$isExternal ? '_blank' : null"
                :rel="$isExternal ? 'noopener noreferrer' : null"
                variant="zinc"
                depth="md"
                :glow="true"
                class="inline-flex items-center gap-2 px-3.5 py-1.5 font-roboto-mono font-bold text-xs uppercase tracking-wider"
            >
                <span>{{ str_starts_with($project['url'], '/') ? __('home.project_view_game') : __('home.project_view_live') }}</span>
                <svg class="w-3.5 h-3.5 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="square" stroke-linejoin="miter" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </x-v2.extruded-box>
        @endif

        @if(!empty($project['github']))
            <x-v2.extruded-box
                as="a"
                href="{{ $project['github'] }}"
                target="_blank"
                rel="noopener noreferrer"
                variant="zinc"
                depth="md"
                :glow="true"
                class="inline-flex items-center gap-2 px-3.5 py-1.5 font-roboto-mono font-semibold text-xs uppercase tracking-wider hover:text-white"
            >
                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24">
                    <path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/>
                </svg>
                <span>{{ __('home.project_view_github') }}</span>
            </x-v2.extruded-box>
        @endif
    </div>
</div>
