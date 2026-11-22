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
        <div class="flex items-center gap-1.5 sm:gap-2 overflow-x-auto scrollbar-none py-1 max-w-full">
            @foreach(config('portfolio.project_domains', []) as $domain)
                <button
                    type="button"
                    @click="activeDomain = '{{ $domain['id'] }}'"
                    :class="activeDomain === '{{ $domain['id'] }}'
                        ? 'border-amber-500 bg-amber-500/10 text-amber-400 font-bold shadow-[0_0_15px_rgba(245,158,11,0.12)]'
                        : 'border-zinc-800 bg-card/70 text-zinc-400 hover:text-zinc-200 hover:border-zinc-700'"
                    class="inline-flex items-center gap-2 px-3 sm:px-3.5 py-2 border font-roboto-mono text-xs uppercase tracking-wider transition-all duration-200 whitespace-nowrap focus:outline-none"
                >
                    <span :class="activeDomain === '{{ $domain['id'] }}' ? 'w-1.5 h-1.5 bg-amber-400 animate-pulse' : 'w-1.5 h-1.5 bg-zinc-600'"></span>
                    <span>{{ __($domain['label_key']) }}</span>
                    <span class="text-[10px] px-1.5 py-0.5 border border-zinc-800 bg-zinc-950 font-mono text-zinc-400">
                        {{ sprintf('%02d', $domainCounts[$domain['id']] ?? 0) }}
                    </span>
                </button>
            @endforeach
        </div>

        {{-- Right: Master Expand / Collapse Specs Toggle --}}
        <button
            type="button"
            @click="toggleAllSpecs()"
            class="hidden sm:inline-flex items-center gap-2 px-3.5 py-2 border border-zinc-800 hover:border-amber-500/60 bg-zinc-900/60 text-zinc-400 hover:text-amber-400 font-roboto-mono text-xs uppercase tracking-wider transition-all focus:outline-none"
        >
            <svg class="w-3.5 h-3.5 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="square" stroke-linejoin="miter" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/>
            </svg>
            <span x-text="allExpanded ? '{{ __('home.project_collapse_all') }}' : '{{ __('home.project_expand_all') }}'"></span>
        </button>
    </div>

    {{-- ── 3. Projects Grid (3x3 Orthogonal Matrix with Continuous Vertical Rails) ── --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 relative">

        {{-- Continuous Tablet Rail (md: 50% center) --}}
        <div class="hidden md:block lg:hidden absolute top-0 bottom-0 left-1/2 w-px -translate-x-1/2 bg-zinc-800 pointer-events-none z-10" aria-hidden="true"></div>

        {{-- Continuous Desktop Rails (lg: 1/3 and 2/3) --}}
        <div class="hidden lg:block absolute top-0 bottom-0 left-1/3 w-px -translate-x-1/2 bg-zinc-800 pointer-events-none z-10" aria-hidden="true"></div>
        <div class="hidden lg:block absolute top-0 bottom-0 left-2/3 w-px -translate-x-1/2 bg-zinc-800 pointer-events-none z-10" aria-hidden="true"></div>

        {{-- Tablet CAD Pins (md) --}}
        <span class="hidden md:block lg:hidden absolute -top-1.5 left-1/2 -translate-x-1.5 w-3 h-3 bg-amber-500 z-20 border border-black pointer-events-none" aria-hidden="true"></span>
        <span class="hidden md:block lg:hidden absolute -bottom-1.5 left-1/2 -translate-x-1.5 w-3 h-3 bg-amber-500 z-20 border border-black pointer-events-none" aria-hidden="true"></span>

        {{-- Desktop CAD Pins (lg: 1/3 and 2/3 intersections with top & bottom floor lines) --}}
        <span class="hidden lg:block absolute -top-1.5 left-1/3 -translate-x-1.5 w-3 h-3 bg-amber-500 z-20 border border-black pointer-events-none" aria-hidden="true"></span>
        <span class="hidden lg:block absolute -top-1.5 left-2/3 -translate-x-1.5 w-3 h-3 bg-amber-500 z-20 border border-black pointer-events-none" aria-hidden="true"></span>
        <span class="hidden lg:block absolute -bottom-1.5 left-1/3 -translate-x-1.5 w-3 h-3 bg-amber-500 z-20 border border-black pointer-events-none" aria-hidden="true"></span>
        <span class="hidden lg:block absolute -bottom-1.5 left-2/3 -translate-x-1.5 w-3 h-3 bg-amber-500 z-20 border border-black pointer-events-none" aria-hidden="true"></span>

        @foreach($projects as $index => $project)
            <x-v2.projects.card :project="$project" />
        @endforeach

    </div>
</section>
