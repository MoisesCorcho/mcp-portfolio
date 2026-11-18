{{-- ====== Portfolio V2: About Chamber ====== --}}
<section id="about" class="relative">
    {{-- ── 1. Top Section Header Strip (Full-width grid row) ── --}}
    <div class="border-b border-zinc-800 p-6 sm:p-10 lg:px-14 lg:py-8 relative">
        {{-- Clean section label --}}
        <p class="text-xs font-roboto-mono font-semibold tracking-[0.2em] text-amber-500 uppercase mb-2">
            {{ __('home.about_label') }}
        </p>

        {{-- Macro Heading in Oxanium (Solid High-Contrast) --}}
        <h2 class="font-oxanium font-extrabold text-2xl sm:text-4xl lg:text-5xl uppercase tracking-tight text-white leading-tight sm:leading-tight lg:leading-[1.15]">
            {{ __('home.about_heading') }}
            <span class="text-amber-500">
                {{ __('home.about_heading_accent') }}
            </span>
        </h2>

        {{-- Amber Accent Ruler --}}
        <div class="flex items-center gap-2 mt-4">
            <span class="h-[2px] w-20 bg-amber-500"></span>
            <span class="h-[2px] w-2.5 bg-amber-500/40"></span>
        </div>
    </div>

    {{-- ── 2. Main Content Grid (12 Columns with 1px Vertical Divider) ── --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 divide-y lg:divide-y-0 lg:divide-x divide-zinc-800 relative">

        {{-- Center Column Intersection Pins on desktop (5/12 division = 41.666%) --}}
        <span class="hidden lg:block absolute -top-1.5 left-[41.666667%] -translate-x-1.5 w-3 h-3 bg-amber-500 z-20 border border-black" aria-hidden="true"></span>
        <span class="hidden lg:block absolute -bottom-1.5 left-[41.666667%] -translate-x-1.5 w-3 h-3 bg-amber-500 z-20 border border-black" aria-hidden="true"></span>

        {{-- ── LEFT: Images Gallery in Orthogonal CAD Frames (5 Cols) ── --}}
        <div class="lg:col-span-5 p-6 sm:p-8 lg:p-10 flex flex-col justify-center bg-zinc-950/40">

            <div class="about-images-grid flex flex-col gap-4 max-w-[420px] mx-auto w-full">

                {{-- Photo 1: Piano & Music --}}
                <div class="about-img-item relative border border-zinc-700/80 bg-card p-2 shadow-[0_15px_35px_rgba(0,0,0,0.5)]">
                    <span class="absolute top-1 left-1 font-mono text-[10px] text-amber-500 leading-none select-none" aria-hidden="true">⌜</span>
                    <span class="absolute top-1 right-1 font-mono text-[10px] text-amber-500 leading-none select-none" aria-hidden="true">⌝</span>
                    <span class="absolute bottom-1 left-1 font-mono text-[10px] text-amber-500 leading-none select-none" aria-hidden="true">⌞</span>
                    <span class="absolute bottom-1 right-1 font-mono text-[10px] text-amber-500 leading-none select-none" aria-hidden="true">⌟</span>

                    <div class="relative overflow-hidden border border-zinc-800 aspect-[16/9]">
                        <img
                            src="{{ url('/img/MoisesPiano.jpeg') }}"
                            alt="{{ __('home.about_img_1_alt') }}"
                            class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                            loading="lazy"
                            decoding="async"
                            width="400"
                            height="225"
                        />
                    </div>
                </div>

                {{-- Photos 2 & 3: Companion Pets (2-Column Grid) --}}
                <div class="grid grid-cols-2 gap-4">

                    {{-- Pet at PC --}}
                    <div class="about-img-item relative border border-zinc-700/80 bg-card p-2 shadow-[0_10px_25px_rgba(0,0,0,0.4)]">
                        <span class="absolute top-1 left-1 font-mono text-[9px] text-amber-500 leading-none select-none" aria-hidden="true">⌜</span>
                        <span class="absolute top-1 right-1 font-mono text-[9px] text-amber-500 leading-none select-none" aria-hidden="true">⌝</span>
                        <span class="absolute bottom-1 left-1 font-mono text-[9px] text-amber-500 leading-none select-none" aria-hidden="true">⌞</span>
                        <span class="absolute bottom-1 right-1 font-mono text-[9px] text-amber-500 leading-none select-none" aria-hidden="true">⌟</span>

                        <div class="relative overflow-hidden border border-zinc-800 aspect-square">
                            <img
                                src="{{ url('/img/GataMascotaPc.jpeg') }}"
                                alt="{{ __('home.about_img_2_alt') }}"
                                class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                loading="lazy"
                                decoding="async"
                                width="200"
                                height="200"
                            />
                        </div>
                    </div>

                    {{-- Companion Cat --}}
                    <div class="about-img-item relative border border-zinc-700/80 bg-card p-2 shadow-[0_10px_25px_rgba(0,0,0,0.4)]">
                        <span class="absolute top-1 left-1 font-mono text-[9px] text-amber-500 leading-none select-none" aria-hidden="true">⌜</span>
                        <span class="absolute top-1 right-1 font-mono text-[9px] text-amber-500 leading-none select-none" aria-hidden="true">⌝</span>
                        <span class="absolute bottom-1 left-1 font-mono text-[9px] text-amber-500 leading-none select-none" aria-hidden="true">⌞</span>
                        <span class="absolute bottom-1 right-1 font-mono text-[9px] text-amber-500 leading-none select-none" aria-hidden="true">⌟</span>

                        <div class="relative overflow-hidden border border-zinc-800 aspect-square">
                            <img
                                src="{{ url('/img/GataMascota.jpeg') }}"
                                alt="{{ __('home.about_img_3_alt') }}"
                                class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                loading="lazy"
                                decoding="async"
                                width="200"
                                height="200"
                            />
                        </div>
                    </div>

                </div>

            </div>

        </div>

        {{-- ── RIGHT: Narrative & Technical Profile (7 Cols) ── --}}
        <div class="lg:col-span-7 p-6 sm:p-10 lg:p-14 flex flex-col justify-center">

            {{-- Quote Card --}}
            <div class="relative border border-zinc-800 bg-card p-6 mb-7 border-l-2 border-l-amber-500 shadow-[0_10px_30px_rgba(0,0,0,0.5)]">
                <p id="about-quote-text" class="text-slate-200 text-sm sm:text-base font-roboto-mono font-medium leading-relaxed italic">
                    {{ __('home.about_quote') }}
                </p>
            </div>

            {{-- Narrative Bio Paragraph 1 --}}
            <div class="text-slate-300 font-roboto-mono text-sm sm:text-base leading-relaxed mb-5 font-normal">
                {!! __('home.about_para_1') !!}
            </div>

            {{-- Narrative Bio Paragraph 2 --}}
            <div class="text-slate-400 font-roboto-mono text-sm sm:text-base leading-relaxed mb-8 font-normal">
                {!! __('home.about_para_2') !!}
            </div>

            {{-- Tech Stack Strip --}}
            <div class="mb-8 pt-6 border-t border-zinc-800/80">
                <p class="font-roboto-mono text-xs font-semibold tracking-[0.16em] uppercase text-zinc-400 flex items-center gap-2 mb-3">
                    <span class="w-1.5 h-1.5 bg-amber-500"></span>
                    {{ __('home.about_stack_label') }}
                </p>

                {{-- Cycling dynamic tech ticker in clean monospace container --}}
                <div
                    x-data="{
                        index: 0,
                        skills: {{ json_encode(config('portfolio.skills.cycling', [])) }},
                        init() {
                            setInterval(() => {
                                this.index = (this.index + 1) % this.skills.length;
                            }, 2200);
                        }
                    }"
                    class="border border-zinc-800 bg-card p-3.5 flex items-center shadow-sm"
                >
                    <div class="flex items-center flex-wrap gap-x-2.5 gap-y-1 w-full">
                        <span class="text-zinc-400 font-roboto-mono text-xs sm:text-sm uppercase tracking-wider whitespace-nowrap">
                            {{ __('home.about_stack_prefix') }}
                        </span>
                        <span class="text-amber-500 font-mono font-bold text-2xl sm:text-3xl select-none leading-none" aria-hidden="true">[</span>

                        {{-- Centered Clipping Window for Active Skill --}}
                        <div class="h-9 sm:h-11 min-w-[130px] sm:min-w-[180px] overflow-hidden relative flex items-center">
                            <template x-for="(skill, i) in skills" :key="i">
                                <span
                                    x-show="index === i"
                                    x-transition:enter="transition ease-out duration-300 transform"
                                    x-transition:enter-start="opacity-0 translate-y-3"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-200 transform absolute"
                                    x-transition:leave-start="opacity-100 translate-y-0"
                                    x-transition:leave-end="opacity-0 -translate-y-3"
                                    class="font-oxanium font-extrabold text-xl sm:text-2xl text-amber-400 tracking-tight whitespace-nowrap"
                                    x-text="skill"
                                ></span>
                            </template>
                        </div>

                        <span class="text-amber-500 font-mono font-bold text-2xl sm:text-3xl select-none leading-none" aria-hidden="true">]</span>
                    </div>
                </div>

                {{-- Technical Tags Matrix (Square 1px-Bordered Cells) --}}
                <div class="grid grid-cols-3 sm:grid-cols-6 gap-2 mt-3">
                    @foreach(config('portfolio.skills.featured', []) as $tech)
                        <div class="border border-zinc-800/80 bg-zinc-900/40 px-2 py-1.5 text-center text-[11px] font-roboto-mono font-medium text-zinc-400 hover:text-amber-400 hover:border-amber-500/50 transition-colors">
                            {{ $tech }}
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- GitHub Action Button --}}
            <div>
                <a
                    href="{{ config('portfolio.owner.github') }}"
                    target="_blank"
                    class="inline-flex items-center gap-3 px-6 py-3.5 bg-zinc-900/90 hover:bg-amber-500 hover:text-black text-zinc-200 font-roboto-mono font-bold text-xs uppercase tracking-wider transition-all duration-200 border border-zinc-700 hover:border-amber-400 shadow-sm"
                >
                    <svg class="w-4 h-4 fill-current transition-colors" viewBox="0 0 24 24">
                        <path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/>
                    </svg>
                    <span>{{ __('home.about_github_btn') }}</span>
                </a>
            </div>

        </div>

    </div>
</section>
