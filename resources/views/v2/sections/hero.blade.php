{{-- ====== Portfolio V2: Hero Chamber ====== --}}
<section id="hero-section" class="relative">
    {{-- 2-Column Grid with 1px Vertical Divider --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 divide-y lg:divide-y-0 lg:divide-x divide-zinc-800 relative">

        {{-- Center Column Intersection Pins on desktop (7/12 division = 58.333%) --}}
        <span class="hidden lg:block absolute -top-1.5 left-[58.333333%] -translate-x-1.5 w-3 h-3 bg-amber-500 z-20 border border-black" aria-hidden="true"></span>
        <span class="hidden lg:block absolute -bottom-1.5 left-[58.333333%] -translate-x-1.5 w-3 h-3 bg-amber-500 z-20 border border-black" aria-hidden="true"></span>

        {{-- ── LEFT: Text Content (7 Cols on desktop) ── --}}
        <div class="lg:col-span-7 p-6 sm:p-10 lg:p-14 flex flex-col justify-center">

            {{-- Greeting --}}
            <p
                class="hero-title font-oxanium font-bold leading-[1.05] text-slate-300 mb-2 tracking-tight"
                style="font-size: clamp(2rem, 4.5vw, 3rem);"
            >
                {{ __('home.hero_greeting') }}
            </p>

            {{-- Name with Macro Heavy Typography in Solid High-Contrast --}}
            <h1
                class="hero-name font-oxanium font-extrabold leading-[0.98] mb-5 tracking-tight text-white uppercase"
                style="font-size: clamp(2.6rem, 5.5vw, 4.2rem);"
            >
                <span>Moisés</span>
                <span class="text-amber-500">Corcho.</span>
            </h1>

            {{-- Amber Accent Ruler --}}
            <div class="flex items-center gap-2 mb-7">
                <span class="h-[2px] w-20 bg-amber-500"></span>
                <span class="h-[2px] w-2.5 bg-amber-500/40"></span>
            </div>

            {{-- Subtitle (CV Summary verbatim) --}}
            <div class="hero-subtitle text-slate-300 max-w-[580px] leading-relaxed mb-8 text-sm sm:text-base font-roboto-mono font-normal">
                {!! __('home.hero_subtitle') !!}
            </div>

            {{-- CTA Buttons in Cyber-Industrial High-Contrast Styling --}}
            <div class="hero-cta flex flex-wrap items-center gap-4 mb-9">
                <a
                    href="#portfolio"
                    class="inline-flex items-center gap-2 px-6 py-3.5 bg-amber-500 hover:bg-amber-400 text-black font-roboto-mono font-bold text-xs uppercase tracking-wider transition-all duration-200 border border-amber-300 shadow-[0_0_25px_rgba(245,158,11,0.25)]"
                >
                    <span>{{ __('home.hero_cta_primary') }}</span>
                    <svg class="w-4 h-4 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="square" stroke-linejoin="miter" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>

                <a
                    href="#about"
                    class="inline-flex items-center gap-2 px-6 py-3.5 bg-zinc-900/90 hover:bg-zinc-800 text-zinc-200 font-roboto-mono font-semibold text-xs uppercase tracking-wider transition-all duration-200 border border-zinc-700 hover:border-zinc-500"
                >
                    <span>{{ __('home.hero_cta_secondary') }}</span>
                </a>
            </div>

            {{-- Social Section in Clean Industrial Square Cells --}}
            <div class="hero-social pt-6 border-t border-zinc-800/80">
                <p class="font-roboto-mono text-xs font-semibold tracking-[0.16em] uppercase text-zinc-500 mb-3">
                    {{ __('home.hero_social_label') }}
                </p>
                <div class="flex items-center gap-2.5">
                    {{-- Instagram --}}
                    <a href="{{ config('portfolio.owner.instagram') }}" target="_blank"
                        class="w-10 h-10 border border-zinc-800 bg-zinc-900/70 hover:border-amber-500 hover:text-amber-400 hover:bg-amber-500/10 text-zinc-400 transition-all duration-200 flex items-center justify-center"
                        aria-label="Instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="18" height="18" class="fill-current">
                            <path d="M 16.5 5 C 10.16639 5 5 10.16639 5 16.5 L 5 31.5 C 5 37.832757 10.166209 43 16.5 43 L 31.5 43 C 37.832938 43 43 37.832938 43 31.5 L 43 16.5 C 43 10.166209 37.832757 5 31.5 5 L 16.5 5 z M 16.5 8 L 31.5 8 C 36.211243 8 40 11.787791 40 16.5 L 40 31.5 C 40 36.211062 36.211062 40 31.5 40 L 16.5 40 C 11.787791 40 8 36.211243 8 31.5 L 8 16.5 C 8 11.78761 11.78761 8 16.5 8 z M 34 12 C 32.895 12 32 12.895 32 14 C 32 15.105 32.895 16 34 16 C 35.105 16 36 15.105 36 14 C 36 12.895 35.105 12 34 12 z M 24 14 C 18.495178 14 14 18.495178 14 24 C 14 29.504822 18.495178 34 24 34 C 29.504822 34 34 29.504822 34 24 C 34 18.495178 29.504822 14 24 14 z M 24 17 C 27.883178 17 31 20.116822 31 24 C 31 27.883178 27.883178 31 24 31 C 20.116822 31 17 27.883178 17 24 C 17 20.116822 20.116822 17 24 17 z"/>
                        </svg>
                    </a>

                    {{-- LinkedIn --}}
                    <a href="{{ config('portfolio.owner.linkedin') }}" target="_blank"
                        class="w-10 h-10 border border-zinc-800 bg-zinc-900/70 hover:border-amber-500 hover:text-amber-400 hover:bg-amber-500/10 text-zinc-400 transition-all duration-200 flex items-center justify-center"
                        aria-label="LinkedIn">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>

                    {{-- GitHub --}}
                    <a href="{{ config('portfolio.owner.github') }}" target="_blank"
                        class="w-10 h-10 border border-zinc-800 bg-zinc-900/70 hover:border-amber-500 hover:text-amber-400 hover:bg-amber-500/10 text-zinc-400 transition-all duration-200 flex items-center justify-center"
                        aria-label="GitHub">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor">
                            <path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/>
                        </svg>
                    </a>

                    {{-- Resume/CV --}}
                    <a href="{{ asset('data/CVMoisesCorcho_' . strtoupper(app()->getLocale()) . '.pdf') }}"
                        target="_blank"
                        class="w-10 h-10 border border-zinc-800 bg-zinc-900/70 hover:border-amber-500 hover:text-amber-400 hover:bg-amber-500/10 text-zinc-400 transition-all duration-200 flex items-center justify-center font-roboto-mono text-xs font-bold"
                        aria-label="{{ __('CV') }}">
                        <span>CV</span>
                    </a>
                </div>
            </div>

        </div>

        {{-- ── RIGHT: Profile Photo (5 Cols on desktop) ── --}}
        <div class="lg:col-span-5 p-6 sm:p-10 lg:p-14 flex flex-col items-center justify-center bg-zinc-950/30">

            <div class="relative w-full max-w-[340px]">

                {{-- Clean Industrial Frame around Photo --}}
                <div class="relative border border-zinc-700/80 bg-card p-3 shadow-[0_20px_50px_rgba(0,0,0,0.6)]">

                    {{-- 4 Corner Reticle Marks --}}
                    <span class="absolute top-1 left-1 font-mono text-[11px] text-amber-500 leading-none select-none" aria-hidden="true">⌜</span>
                    <span class="absolute top-1 right-1 font-mono text-[11px] text-amber-500 leading-none select-none" aria-hidden="true">⌝</span>
                    <span class="absolute bottom-1 left-1 font-mono text-[11px] text-amber-500 leading-none select-none" aria-hidden="true">⌞</span>
                    <span class="absolute bottom-1 right-1 font-mono text-[11px] text-amber-500 leading-none select-none" aria-hidden="true">⌟</span>

                    {{-- Photo Container --}}
                    <div class="relative overflow-hidden border border-zinc-800">
                        <img
                            src="{{ url('/img/moises-1.jpg') }}"
                            alt="{{ __('home.hero_photo_alt') }}"
                            class="w-full block object-cover contrast-[1.05]"
                            style="aspect-ratio: 4/5; object-position: top;"
                        />
                    </div>

                </div>

            </div>

        </div>

    </div>
</section>
