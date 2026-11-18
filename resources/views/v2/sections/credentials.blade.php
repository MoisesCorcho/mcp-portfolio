{{-- ====== Portfolio V2: Credentials & Trajectory Chamber ====== --}}
<section id="experience" class="relative border-b border-zinc-800">
    {{-- ── 1. Section Header Strip ── --}}
    <div class="border-b border-zinc-800 p-6 sm:p-10 lg:px-14 lg:py-8 relative">
        <p class="text-xs font-roboto-mono font-semibold tracking-[0.2em] text-amber-500 uppercase mb-2">
            {{ __('home.credentials_label') }}
        </p>

        <h2 class="font-oxanium font-extrabold text-2xl sm:text-4xl lg:text-5xl uppercase tracking-tight text-white leading-tight sm:leading-tight lg:leading-[1.15]">
            {{ __('home.credentials_heading') }}
            <span class="text-amber-500">
                {{ __('home.credentials_heading_accent') }}
            </span>
        </h2>

        {{-- Amber Accent Ruler --}}
        <div class="flex items-center gap-2 mt-4 mb-3">
            <span class="h-[2px] w-20 bg-amber-500"></span>
            <span class="h-[2px] w-2.5 bg-amber-500/40"></span>
        </div>

        <p class="text-slate-400 font-roboto-mono text-xs sm:text-sm max-w-2xl leading-relaxed">
            {{ __('home.credentials_subtitle') }}
        </p>
    </div>

    {{-- ── 2. Work Experience (Interactive Spine Timeline Chamber) ── --}}
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
        {{-- Section Subheader Strip (Clean, without redundant Track Record text) --}}
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
            {{-- Vertical Steel Rail --}}
            <div class="absolute top-8 bottom-8 left-3 sm:left-4 w-px bg-zinc-800" aria-hidden="true"></div>

            <div class="space-y-6 sm:space-y-8 pl-9 sm:pl-10 relative">
                @foreach($jobs as $index => $job)
                    @php
                        $logo = $companyLogos[$job['company']] ?? null;
                    @endphp

                    <div class="relative group">
                        {{-- CAD Square Node directly centered on the vertical steel rail --}}
                        <span
                            class="absolute top-6 -left-[30px] w-3 h-3 border border-black z-10 transition-colors duration-200"
                            :class="expandedJobs.includes({{ $index }}) ? 'bg-amber-500 shadow-[0_0_12px_rgba(245,158,11,0.6)]' : 'bg-zinc-800 group-hover:bg-amber-400'"
                            aria-hidden="true"
                        ></span>

                        {{-- Job Interactive Module Box --}}
                        <div
                            class="border border-zinc-800/90 bg-card/60 hover:bg-card hover:border-zinc-700 transition-all duration-200 overflow-hidden"
                            :class="expandedJobs.includes({{ $index }}) ? 'border-zinc-700 bg-card shadow-[0_10px_30px_rgba(0,0,0,0.5)]' : ''"
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
                                class="px-5 pb-6 sm:px-6 sm:pb-6 pt-1 border-t border-zinc-800/80"
                                style="display: none;"
                            >
                                <div class="font-roboto-mono text-xs sm:text-sm text-slate-300 leading-relaxed max-w-4xl py-3 space-y-2">
                                    {!! $job['description'] !!}
                                </div>

                                @if(!empty($job['stack']))
                                    <div class="pt-4 border-t border-zinc-800/60 flex flex-wrap gap-1.5">
                                        @foreach($job['stack'] as $tech)
                                            <span class="px-2 py-0.5 border border-zinc-800/80 bg-zinc-900/80 text-[10px] sm:text-[11px] font-roboto-mono text-zinc-400">
                                                {{ $tech }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ── 3. Formal Education & Industry Certifications (2-Column Grid) ── --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 divide-y lg:divide-y-0 lg:divide-x divide-zinc-800 relative">

        {{-- Center Column Intersection Pins on Desktop (5/12 = 41.666667%) --}}
        <span class="hidden lg:block absolute -top-1.5 left-[41.666667%] -translate-x-1.5 w-3 h-3 bg-amber-500 z-20 border border-black pointer-events-none" aria-hidden="true"></span>
        <span class="hidden lg:block absolute -bottom-1.5 left-[41.666667%] -translate-x-1.5 w-3 h-3 bg-amber-500 z-20 border border-black pointer-events-none" aria-hidden="true"></span>

        {{-- ── LEFT: Formal University Degree & Diploma (5.4 Cols = 45%) ── --}}
        <div class="lg:col-span-5 p-6 sm:p-8 lg:p-10 flex flex-col justify-between bg-chamber/40">
            <div>
                <div class="flex items-center gap-2 mb-6">
                    <span class="w-2 h-2 bg-amber-500"></span>
                    <h3 class="font-oxanium font-bold text-base text-zinc-200 uppercase tracking-wider">
                        {{ __('home.credentials_tab_education') }}
                    </h3>
                </div>

                <div class="space-y-6">
                    @foreach(config('portfolio.education', []) as $edu)
                        <div class="relative border border-zinc-800 bg-card p-5 sm:p-6 shadow-sm">
                            <span class="absolute top-1 left-1 font-mono text-[9px] text-amber-500/70 select-none" aria-hidden="true">⌜</span>
                            <span class="absolute top-1 right-1 font-mono text-[9px] text-amber-500/70 select-none" aria-hidden="true">⌝</span>

                            <span class="inline-block px-2 py-0.5 border border-zinc-800 bg-zinc-900/80 text-[10px] font-roboto-mono text-amber-400 font-semibold uppercase tracking-wider mb-2">
                                {{ $edu['type'] }}
                            </span>

                            <h4 class="font-oxanium font-extrabold text-lg sm:text-xl text-white uppercase tracking-tight mb-1">
                                {{ __($edu['degree_key']) }}
                            </h4>

                            <p class="font-roboto-mono text-xs sm:text-sm text-slate-300 mb-2">
                                {{ __($edu['institution_key']) }}
                            </p>

                            <div class="flex items-center justify-between text-[11px] font-roboto-mono text-zinc-500 pt-2 border-t border-zinc-800/80">
                                <span>{{ __($edu['period_key']) }}</span>
                                <span>{{ $edu['location'] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Academic Seal Info Note --}}
            <div class="mt-8 pt-4 border-t border-zinc-800/80 text-[11px] font-roboto-mono text-zinc-500 flex items-center gap-2">
                <span class="text-amber-500">✔</span>
                <span>Título universitario oficial convalidado y habilitado para ejercicio profesional.</span>
            </div>
        </div>

        {{-- ── RIGHT: Official Industry Certifications (7 Cols = 55%) ── --}}
        <div class="lg:col-span-7 p-6 sm:p-8 lg:p-10 flex flex-col justify-between bg-zinc-950/50">
            <div>
                <div class="flex items-center justify-between gap-2 mb-6">
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 bg-amber-500"></span>
                        <h3 class="font-oxanium font-bold text-base text-zinc-200 uppercase tracking-wider">
                            {{ __('home.credentials_tab_certs') }}
                        </h3>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-2 py-0.5 border border-emerald-500/30 bg-emerald-500/10 text-[10px] font-roboto-mono text-emerald-400 font-semibold uppercase tracking-wider">
                        <span class="w-1.5 h-1.5 bg-emerald-400 animate-pulse"></span>
                        <span>{{ __('home.cert_verified_badge') }}</span>
                    </span>
                </div>

                {{-- Certifications Cards with Banners & Badges --}}
                <div class="space-y-6">
                    @foreach(config('portfolio.certifications', []) as $cert)
                        <div class="border border-zinc-800 bg-card overflow-hidden group hover:border-zinc-700 transition-colors">
                            {{-- Banner Preview with Right-Aligned Focus (where title & credentials live) --}}
                            @if(!empty($cert['banner']))
                                <a
                                    href="{{ $cert['url'] ?? '#' }}"
                                    @if(!empty($cert['url'])) target="_blank" rel="noopener noreferrer" @endif
                                    class="block relative w-full h-28 sm:h-32 md:h-36 overflow-hidden border-b border-zinc-800 bg-black group/banner"
                                    title="{{ __('home.cert_view_credential') }}: {{ $cert['title'] }}"
                                >
                                    <img
                                        src="{{ asset($cert['banner']) }}"
                                        alt="{{ $cert['title'] }}"
                                        class="w-full h-full object-cover object-right group-hover/banner:scale-[1.02] transition-transform duration-500"
                                        loading="lazy"
                                    />
                                    {{-- Hover Badge Overlay --}}
                                    <span class="absolute top-2 right-2 px-2 py-0.5 bg-black/80 border border-zinc-800 text-[10px] font-roboto-mono text-zinc-300 opacity-0 group-hover/banner:opacity-100 transition-opacity flex items-center gap-1.5 backdrop-blur-sm">
                                        <span>{{ __('home.cert_verify_link') }}</span>
                                        <svg class="w-3 h-3 text-amber-500 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="square" stroke-linejoin="miter" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                        </svg>
                                    </span>
                                </a>
                            @endif

                            <div class="p-5 sm:p-6">
                                <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-3 mb-2">
                                    <div class="flex items-center gap-3">
                                        @if(!empty($cert['badge']))
                                            <img
                                                src="{{ asset($cert['badge']) }}"
                                                alt="{{ $cert['title'] }}"
                                                class="w-10 h-10 object-contain flex-shrink-0"
                                                loading="lazy"
                                            />
                                        @endif
                                        <div>
                                            <h4 class="font-oxanium font-bold text-base sm:text-lg text-white uppercase tracking-tight group-hover:text-amber-400 transition-colors">
                                                {{ $cert['title'] }}
                                            </h4>
                                            <p class="font-roboto-mono text-xs text-amber-500/90 font-medium">
                                                {{ $cert['issuer'] }} @if(!empty($cert['score'])) · <span class="text-emerald-400">{{ $cert['score'] }}</span> @endif
                                            </p>
                                        </div>
                                    </div>

                                    @if(!empty($cert['url']))
                                        <a
                                            href="{{ $cert['url'] }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 border border-zinc-800 bg-zinc-900/80 hover:border-amber-500 hover:text-amber-400 text-[11px] font-roboto-mono text-zinc-400 transition-all self-start sm:self-auto flex-shrink-0"
                                            title="{{ __('home.cert_view_credential') }}"
                                        >
                                            <span>{{ __('home.cert_verify_link') }}</span>
                                            <svg class="w-3 h-3 stroke-[2]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="square" stroke-linejoin="miter" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                            </svg>
                                        </a>
                                    @endif
                                </div>

                                {{-- Verified Skills Pill Tags --}}
                                <div class="flex flex-wrap gap-1.5 mt-3 pt-3 border-t border-zinc-800/80">
                                    @foreach($cert['skills'] as $skill)
                                        <span class="px-2 py-0.5 border border-zinc-800 bg-zinc-900/60 text-[10px] font-roboto-mono text-zinc-400">
                                            {{ $skill }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</section>
