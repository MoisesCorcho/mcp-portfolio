{{-- ====== Portfolio V2 Credentials: Work Experience Spine Timeline ====== --}}
@php
    $jobs = __('home.experience_jobs');
    $allJobIndexes = range(0, count($jobs) - 1);
    $companyLogos = config('portfolio.company_logos', []);
@endphp

<div
    class="border-b border-zinc-800"
    x-data="{
        expandedJobs: [0],
        toggleJob(idx) {
            if (this.expandedJobs.includes(idx)) {
                this.expandedJobs = this.expandedJobs.filter(i => i !== idx);
            } else {
                this.expandedJobs.push(idx);
            }
        },
        toggleAll() {
            if (this.expandedJobs.length > 0) {
                this.expandedJobs = [];
            } else {
                this.expandedJobs = @js($allJobIndexes);
            }
        }
    }"
>
    {{-- Section Subheader Strip --}}
    <div class="px-6 py-4 sm:px-10 lg:px-14 bg-zinc-950/80 border-b border-zinc-800/80 flex items-center justify-between">
        <h3 class="font-oxanium font-bold text-sm sm:text-base text-zinc-300 uppercase tracking-wider flex items-center gap-2">
            <span class="w-2 h-2 bg-amber-500"></span>
            <span>{{ __('home.credentials_tab_experience') }}</span>
        </h3>

        {{-- Quick Expand/Collapse All Button --}}
        <button
            type="button"
            @click="toggleAll()"
            class="font-roboto-mono text-xs text-zinc-400 hover:text-amber-400 uppercase tracking-wider transition-colors flex items-center gap-1.5 focus:outline-none"
        >
            <span x-text="expandedJobs.length > 0 ? '{{ __('home.exp_collapse_all') }}' : '{{ __('home.exp_expand_all') }}'"></span>
            <span class="text-amber-500 text-[10px]" x-text="expandedJobs.length > 0 ? '▲' : '▼'"></span>
        </button>
    </div>

    {{-- Continuous Vertical Spine Timeline --}}
    <div class="p-6 sm:p-10 lg:px-14 lg:py-10 bg-chamber/20 relative">

        <div class="space-y-6 sm:space-y-8 pl-8 sm:pl-10 md:pl-12 relative">
            @foreach($jobs as $index => $job)
                @php
                    $logo = $companyLogos[$job['company']] ?? null;
                @endphp

                <div class="relative group">
                    @if(!$loop->last)
                        {{-- Vertical Spine Segment connecting Node i to Node i+1 (terminates exactly at the last node) --}}
                        <div
                            class="absolute top-[34px] sm:top-[40px] -bottom-[58px] sm:-bottom-[72px] -left-8 sm:-left-10 md:-left-12 -translate-x-1/2 w-px bg-zinc-800 z-0 pointer-events-none"
                            aria-hidden="true"
                        ></div>
                    @endif

                    {{-- Horizontal Bus Trace connecting vertical rail & node directly to the experience card --}}
                    <div
                        class="absolute top-[40px] sm:top-[46px] -left-8 sm:-left-10 md:-left-12 w-8 sm:w-10 md:w-12 h-px transition-colors duration-200 z-0"
                        :class="expandedJobs.includes({{ $index }}) ? 'bg-amber-500 shadow-[0_0_8px_rgba(245,158,11,0.5)]' : 'bg-zinc-800 group-hover:bg-zinc-700'"
                        aria-hidden="true"
                    ></div>

                    {{-- CAD Square Node directly centered on the vertical steel rail and horizontal bus line --}}
                    <span
                        class="absolute top-[34px] sm:top-[40px] -left-8 sm:-left-10 md:-left-12 -translate-x-1/2 w-3 h-3 border border-black z-10 transition-all duration-200"
                        :class="expandedJobs.includes({{ $index }}) ? 'bg-amber-500 shadow-[0_0_12px_rgba(245,158,11,0.6)] scale-110' : 'bg-zinc-800 group-hover:bg-amber-400'"
                        aria-hidden="true"
                    ></span>

                    {{-- Job Interactive Module Box --}}
                    <x-v2.extruded-box
                        variant="card"
                        depth="lg"
                        :cad-pins="true"
                        class="block w-full transition-all duration-200"
                        x-bind:class="expandedJobs.includes({{ $index }}) ? 'border-l-2 border-l-amber-500 shadow-[0_10px_30px_rgba(0,0,0,0.5)]' : ''"
                    >
                        {{-- Clickable Header Bar --}}
                        <div
                            @click="toggleJob({{ $index }})"
                            class="p-5 sm:p-6 cursor-pointer flex flex-col md:flex-row md:items-center justify-between gap-4 select-none"
                            role="button"
                            :aria-expanded="expandedJobs.includes({{ $index }}) ? 'true' : 'false'"
                        >
                            <div class="flex items-center gap-3.5 sm:gap-4">
                                {{-- Company Logo CAD Frame --}}
                                <div class="w-10 h-10 sm:w-11 sm:h-11 border border-zinc-700/80 bg-zinc-900 p-1 flex items-center justify-center flex-shrink-0 shadow-sm">
                                    @if($logo)
                                        <img
                                            src="{{ asset($logo) }}"
                                            alt="{{ $job['company'] }}"
                                            class="w-full h-full object-contain"
                                            loading="lazy"
                                            width="40"
                                            height="40"
                                        />
                                    @else
                                        <span class="font-oxanium font-extrabold text-base text-amber-400">
                                            {{ strtoupper(substr($job['company'], 0, 1)) }}
                                        </span>
                                    @endif
                                </div>

                                <div>
                                    {{-- Role Title in Oxanium --}}
                                    <h4 class="font-oxanium font-bold text-base sm:text-xl text-white uppercase tracking-tight group-hover:text-amber-400 transition-colors">
                                        {{ $job['role'] }}
                                    </h4>

                                    {{-- Company Name in Structured Badge --}}
                                    <div class="flex flex-wrap items-center gap-2 mt-1">
                                        <span class="font-roboto-mono text-xs sm:text-sm font-semibold text-amber-400">
                                            {{ $job['company'] }}
                                        </span>
                                        @if($index === 0)
                                            <span class="inline-flex items-center gap-1 px-1.5 py-0.5 bg-amber-500/10 border border-amber-500/30 text-[9px] font-roboto-mono text-amber-400 uppercase tracking-wider font-semibold">
                                                <span class="w-1.5 h-1.5 bg-amber-400 animate-pulse"></span>
                                                {{ __('home.exp_current_badge') }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- Date Chip & Expand Indicator --}}
                            <div class="flex items-center justify-between md:justify-end gap-3 pt-3 md:pt-0 border-t md:border-t-0 border-zinc-800/60">
                                <span class="font-roboto-mono text-xs text-zinc-400 bg-zinc-900/90 px-3 py-1 border border-zinc-800">
                                    {{ $job['date'] }}
                                </span>

                                <span class="w-8 h-8 border border-zinc-800 bg-zinc-900 flex items-center justify-center text-zinc-400 group-hover:border-amber-500 group-hover:text-amber-400 text-xs font-mono transition-colors">
                                    <span x-show="!expandedJobs.includes({{ $index }})">+</span>
                                    <span x-show="expandedJobs.includes({{ $index }})" style="display: none;">−</span>
                                </span>
                            </div>
                        </div>

                        {{-- Collapsible Technical Chamber --}}
                        <div
                            x-show="expandedJobs.includes({{ $index }})"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="px-5 pb-6 sm:px-6 sm:pb-6 pt-1 border-t border-zinc-800/80 overflow-hidden"
                            style="display: none;"
                        >
                            <div class="font-roboto-mono text-xs sm:text-sm text-slate-300 leading-relaxed max-w-4xl py-3 space-y-2">
                                {!! $job['description'] !!}
                            </div>

                            @if(!empty($job['stack']))
                                <div class="pt-4 border-t border-zinc-800/60 flex flex-wrap items-center gap-1.5">
                                    <span class="text-[10px] font-roboto-mono uppercase text-amber-500/90 font-semibold tracking-wider flex items-center gap-1 mr-1 select-none">
                                        <span class="w-1.5 h-1.5 bg-amber-500"></span>
                                        <span>STACK:</span>
                                    </span>
                                    @foreach($job['stack'] as $tech)
                                        <span class="px-2 py-0.5 border border-zinc-800/80 bg-zinc-900/80 text-[10px] sm:text-[11px] font-roboto-mono text-zinc-300 hover:border-amber-500/50 hover:text-amber-400 transition-colors">
                                            {{ $tech }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </x-v2.extruded-box>
                </div>
            @endforeach
        </div>
    </div>
</div>
