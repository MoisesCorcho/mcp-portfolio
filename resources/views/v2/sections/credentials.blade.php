{{-- ====== Portfolio V2: Credentials & Trajectory Chamber ====== --}}
<section id="experience" class="relative border-b border-zinc-800">
    {{-- ── 1. Section Header Strip ── --}}
    <div class="border-b border-zinc-800 p-6 sm:p-10 lg:px-14 lg:py-8 relative">
        <p class="text-xs font-roboto-mono font-semibold tracking-[0.2em] text-amber-500 uppercase mb-2">
            {{ __('home.credentials_label') }}
        </p>

        <h2 class="font-oxanium font-extrabold text-3xl sm:text-4xl lg:text-5xl uppercase tracking-tight text-white leading-tight sm:leading-tight lg:leading-[1.15]">
            {{ __('home.credentials_heading') }}
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-amber-500 to-orange-500 inline-block py-1 sm:py-1.5 box-decoration-clone">
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

    {{-- ── 2. Work Experience (Chronological Architectural Log) ── --}}
    <div class="border-b border-zinc-800">
        <div class="px-6 py-4 sm:px-10 lg:px-14 bg-zinc-950/80 border-b border-zinc-800/80 flex items-center justify-between">
            <h3 class="font-oxanium font-bold text-sm sm:text-base text-zinc-300 uppercase tracking-wider flex items-center gap-2">
                <span class="w-2 h-2 bg-amber-500"></span>
                <span>{{ __('home.credentials_tab_experience') }}</span>
            </h3>
            <span class="font-roboto-mono text-[11px] text-zinc-500 uppercase tracking-widest hidden sm:inline">
                Track Record
            </span>
        </div>

        <div class="divide-y divide-zinc-800 relative">
            @foreach(__('home.experience_jobs') as $index => $job)
                <div class="p-6 sm:p-8 lg:px-14 lg:py-8 bg-chamber/20 hover:bg-zinc-950/40 transition-colors">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-2 mb-3">
                        <div class="flex flex-wrap items-center gap-2.5">
                            <span class="font-oxanium font-bold text-lg sm:text-xl text-white uppercase tracking-tight">
                                {{ $job['role'] }}
                            </span>
                            <span class="text-amber-500 font-mono">/</span>
                            <span class="font-roboto-mono text-sm font-semibold text-amber-400">
                                {{ $job['company'] }}
                            </span>
                        </div>

                        <span class="font-roboto-mono text-xs text-zinc-400 bg-card px-3 py-1 border border-zinc-800 inline-block self-start lg:self-auto">
                            {{ $job['date'] }}
                        </span>
                    </div>

                    <div class="font-roboto-mono text-xs sm:text-sm text-slate-300 leading-relaxed max-w-4xl mb-4">
                        {!! $job['description'] !!}
                    </div>

                    @if(!empty($job['stack']))
                        <div class="flex flex-wrap gap-1.5 pt-2">
                            @foreach($job['stack'] as $tech)
                                <span class="px-2 py-0.5 border border-zinc-800/80 bg-card text-[11px] font-roboto-mono text-zinc-400">
                                    {{ $tech }}
                                </span>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
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
