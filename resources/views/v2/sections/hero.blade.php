{{-- ====== Portfolio V2: Hero Chamber ====== --}}
<section id="hero-section" class="relative">
    {{-- 2-Column Grid with 1px Vertical Divider --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 divide-y lg:divide-y-0 lg:divide-x divide-zinc-800 relative">

        {{-- Center Column Intersection Pins on desktop (7/12 division = 58.333%) --}}
        <x-v2.cad-pin class="hidden lg:block absolute -top-1.5 left-[58.333333%] -translate-x-1.5" />
        <x-v2.cad-pin class="hidden lg:block absolute -bottom-1.5 left-[58.333333%] -translate-x-1.5" />

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
                <x-v2.extruded-box
                    as="a"
                    href="#portfolio"
                    variant="amber"
                    depth="md"
                    :glow="true"
                    class="inline-flex items-center gap-2 px-6 py-3.5 font-roboto-mono font-bold text-xs uppercase tracking-wider"
                >
                    <span>{{ __('home.hero_cta_primary') }}</span>
                    <svg class="w-4 h-4 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="square" stroke-linejoin="miter" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </x-v2.extruded-box>

                <x-v2.extruded-box
                    as="a"
                    href="#about"
                    variant="zinc"
                    depth="md"
                    :glow="true"
                    class="inline-flex items-center gap-2 px-6 py-3.5 font-roboto-mono font-semibold text-xs uppercase tracking-wider"
                >
                    <span>{{ __('home.hero_cta_secondary') }}</span>
                </x-v2.extruded-box>
            </div>

            {{-- Social Section in Clean Industrial Square Cells --}}
            <div class="hero-social pt-6 border-t border-zinc-800/80">
                <p class="font-roboto-mono text-xs font-semibold tracking-[0.16em] uppercase text-zinc-500 mb-3">
                    {{ __('home.hero_social_label') }}
                </p>
                <x-v2.social-links :include-cv="true" />
            </div>

        </div>

        {{-- ── RIGHT: Profile Photo (5 Cols on desktop) ── --}}
        <div class="lg:col-span-5 p-6 sm:p-10 lg:p-14 flex flex-col items-center justify-center bg-zinc-950/30">

            <div class="relative w-full max-w-[420px] sm:max-w-[440px] lg:max-w-[480px]">

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
