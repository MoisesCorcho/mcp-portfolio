{{-- ====== Portfolio V2 Credentials: Industry Certifications ====== --}}
<div class="lg:col-span-7 p-5 sm:p-8 lg:p-10 pr-6 sm:pr-8 lg:pr-10 flex flex-col justify-between bg-zinc-950/50">
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
        <div class="space-y-10 sm:space-y-12">
            @foreach(config('portfolio.certifications', []) as $cert)
                <x-v2.extruded-box variant="card" depth="lg" class="group block">
                    {{-- Banner Preview with Right-Aligned Focus --}}
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
                                width="800"
                                height="144"
                                class="w-full h-full object-cover object-right group-hover/banner:scale-[1.02] transition-transform duration-500"
                                loading="lazy"
                                decoding="async"
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
                </x-v2.extruded-box>
            @endforeach
        </div>
    </div>
</div>
