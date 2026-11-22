{{-- ====== Portfolio V2: Projects Showroom Chamber ====== --}}
@php
    $projects = config('portfolio.projects', []);
    $domainCounts = [
        'all' => count($projects),
        'ai' => count(array_filter($projects, fn($p) => ($p['domain'] ?? '') === 'ai')),
        'mobile' => count(array_filter($projects, fn($p) => ($p['domain'] ?? '') === 'mobile')),
        'saas' => count(array_filter($projects, fn($p) => ($p['domain'] ?? '') === 'saas')),
        'creative' => count(array_filter($projects, fn($p) => ($p['domain'] ?? '') === 'creative')),
    ];
@endphp

<section
    id="portfolio"
    class="relative border-b border-zinc-800"
    x-data="{
        activeDomain: 'all',
        allExpanded: false,
        toggleAllSpecs() {
            this.allExpanded = !this.allExpanded;
            this.$dispatch('toggle-all-specs', { expanded: this.allExpanded });
        }
    }"
>
    {{-- ── 1. Section Header Strip ── --}}
    <x-v2.section-header
        :label="__('home.portfolio_label')"
        :title="__('home.portfolio_heading')"
        :accent="__('home.portfolio_heading_accent')"
        :subtitle="__('home.portfolio_subtitle')"
    />

    {{-- ── 2. Engineering Domain Filter Control Strip ── --}}
    <div class="border-b border-zinc-800 bg-void/50 p-4 sm:px-10 lg:px-14 flex flex-wrap items-center justify-between gap-3 relative">
        {{-- Left: Filter Tabs with Monospace Tags and Counts --}}
        <div class="flex items-center flex-wrap gap-2 sm:gap-2.5 max-w-full">
            <span class="text-[10px] font-roboto-mono uppercase text-zinc-500 font-semibold tracking-widest hidden xl:inline-block mr-1 select-none">
                {{ __('home.portfolio_filter_label') }}
            </span>
            @foreach(config('portfolio.project_domains', []) as $domain)
                <x-v2.extruded-box
                    as="button"
                    type="button"
                    @click="activeDomain = '{{ $domain['id'] }}'"
                    variant="zinc"
                    depth="sm"
                    :glow="true"
                    class="inline-flex items-center gap-2 px-3 sm:px-3.5 py-2 font-roboto-mono text-xs uppercase tracking-wider transition-colors whitespace-nowrap focus:outline-none"
                    x-bind:class="activeDomain === '{{ $domain['id'] }}' ? '!bg-amber-500 !text-black !border-amber-300 font-bold shadow-[0_0_15px_rgba(245,158,11,0.25)]' : ''"
                >
                    <span :class="activeDomain === '{{ $domain['id'] }}' ? 'w-1.5 h-1.5 bg-black animate-pulse' : 'w-1.5 h-1.5 bg-amber-500'"></span>
                    <span>{{ __($domain['label_key']) }}</span>
                    <span
                        class="text-[10px] px-1.5 py-0.5 border font-mono transition-colors"
                        :class="activeDomain === '{{ $domain['id'] }}' ? 'border-black bg-amber-400/90 text-black font-bold' : 'border-zinc-700 bg-zinc-900/90 text-zinc-300'"
                    >
                        {{ sprintf('%02d', $domainCounts[$domain['id']] ?? 0) }}
                    </span>
                </x-v2.extruded-box>
            @endforeach
        </div>

        {{-- Right: Master Expand / Collapse Specs Toggle with Distinct Separator Barrier --}}
        <div class="flex items-center gap-3 sm:pl-5 sm:border-l border-zinc-800 ml-auto self-center">
            <x-v2.extruded-box
                as="button"
                type="button"
                @click="toggleAllSpecs()"
                variant="zinc"
                depth="sm"
                class="hidden sm:inline-flex items-center gap-2 px-3.5 py-2 font-roboto-mono text-xs uppercase tracking-wider focus:outline-none"
            >
                <svg class="w-3.5 h-3.5 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="square" stroke-linejoin="miter" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
                </svg>
                <span x-text="allExpanded ? '{{ __('home.project_collapse_all') }}' : '{{ __('home.project_expand_all') }}'"></span>
            </x-v2.extruded-box>
        </div>
    </div>

    {{-- ── 3. Projects Grid (3x3 Orthogonal Matrix with Continuous Vertical Rails) ── --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 relative">

        {{-- Continuous Tablet Rail (md: 50% center) --}}
        <div class="hidden md:block lg:hidden absolute top-0 bottom-0 left-1/2 w-px -translate-x-1/2 bg-zinc-800 pointer-events-none z-10" aria-hidden="true"></div>

        {{-- Continuous Desktop Rails (lg: 1/3 and 2/3) --}}
        <div class="hidden lg:block absolute top-0 bottom-0 left-1/3 w-px -translate-x-1/2 bg-zinc-800 pointer-events-none z-10" aria-hidden="true"></div>
        <div class="hidden lg:block absolute top-0 bottom-0 left-2/3 w-px -translate-x-1/2 bg-zinc-800 pointer-events-none z-10" aria-hidden="true"></div>

        {{-- Tablet CAD Pins (md) --}}
        <x-v2.cad-pin class="hidden md:block lg:hidden absolute -top-1.5 left-1/2 -translate-x-1.5" />
        <x-v2.cad-pin class="hidden md:block lg:hidden absolute -bottom-1.5 left-1/2 -translate-x-1.5" />

        {{-- Desktop CAD Pins (lg: 1/3 and 2/3 intersections with top & bottom floor lines) --}}
        <x-v2.cad-pin class="hidden lg:block absolute -top-1.5 left-1/3 -translate-x-1.5" />
        <x-v2.cad-pin class="hidden lg:block absolute -top-1.5 left-2/3 -translate-x-1.5" />
        <x-v2.cad-pin class="hidden lg:block absolute -bottom-1.5 left-1/3 -translate-x-1.5" />
        <x-v2.cad-pin class="hidden lg:block absolute -bottom-1.5 left-2/3 -translate-x-1.5" />
        <span class="hidden lg:block absolute -bottom-1.5 left-2/3 -translate-x-1.5 w-3 h-3 bg-amber-500 z-20 border border-black pointer-events-none" aria-hidden="true"></span>

        @foreach($projects as $index => $project)
            <x-v2.projects.card :project="$project" />
        @endforeach

    </div>
</section>
