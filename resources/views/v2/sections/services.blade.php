{{-- ====== Portfolio V2: Services & Capabilities Chamber ====== --}}
<section id="services" class="relative border-b border-zinc-800">
    {{-- ── 1. Section Header Strip ── --}}
    <div class="border-b border-zinc-800 p-6 sm:p-10 lg:px-14 lg:py-8 relative">
        <p class="text-xs font-roboto-mono font-semibold tracking-[0.2em] text-amber-500 uppercase mb-2">
            {{ __('home.services_label') }}
        </p>

        <h2 class="font-oxanium font-extrabold text-2xl sm:text-4xl lg:text-5xl uppercase tracking-tight text-white leading-tight sm:leading-tight lg:leading-[1.15]">
            {{ __('home.services_heading') }}
            <span class="text-amber-500">
                {{ __('home.services_heading_accent') }}
            </span>
        </h2>

        {{-- Amber Accent Ruler --}}
        <div class="flex items-center gap-2 mt-4 mb-3">
            <span class="h-[2px] w-20 bg-amber-500"></span>
            <span class="h-[2px] w-2.5 bg-amber-500/40"></span>
        </div>

        <p class="text-slate-400 font-roboto-mono text-xs sm:text-sm max-w-2xl leading-relaxed">
            {{ __('home.services_subtitle') }}
        </p>
    </div>

    {{-- ── 2. Services Grid (2x2 Orthogonal Matrix with CAD Intersections) ── --}}
    <div class="grid grid-cols-1 md:grid-cols-2 divide-y md:divide-y-0 divide-zinc-800 relative">

        {{-- Top Center CAD Pin (intersection of vertical divider and section header floor line) --}}
        <span class="hidden md:block absolute -top-1.5 left-1/2 -translate-x-1.5 w-3 h-3 bg-amber-500 z-20 border border-black pointer-events-none" aria-hidden="true"></span>

        {{-- Bottom Center CAD Pin (intersection of vertical divider and bottom floor line) --}}
        <span class="hidden md:block absolute -bottom-1.5 left-1/2 -translate-x-1.5 w-3 h-3 bg-amber-500 z-20 border border-black pointer-events-none" aria-hidden="true"></span>

        @foreach(config('portfolio.services', []) as $index => $service)
            <div class="p-6 sm:p-8 lg:p-10 flex flex-col justify-between bg-chamber/40 hover:bg-zinc-950/80 transition-colors duration-300 group relative overflow-hidden {{ $index % 2 === 0 ? 'md:border-r border-zinc-800' : '' }} {{ $index >= 2 ? 'md:border-t border-zinc-800' : '' }}">

                {{-- Center CAD Crosshair Node (exact junction of the 4 chambers, pinned to bottom-right of cell 0) --}}
                @if($index === 0)
                    <span class="hidden md:block absolute -bottom-1.5 -right-1.5 w-3 h-3 bg-amber-500 z-30 border border-black pointer-events-none" aria-hidden="true"></span>
                @endif

                {{-- 4 Corner Reticle Marks --}}
                <span class="absolute top-2 left-2 font-mono text-[10px] text-zinc-700/80 group-hover:text-amber-500/80 leading-none select-none transition-colors" aria-hidden="true">⌜</span>
                <span class="absolute top-2 right-2 font-mono text-[10px] text-zinc-700/80 group-hover:text-amber-500/80 leading-none select-none transition-colors" aria-hidden="true">⌝</span>
                <span class="absolute bottom-2 left-2 font-mono text-[10px] text-zinc-700/80 group-hover:text-amber-500/80 leading-none select-none transition-colors" aria-hidden="true">⌞</span>
                <span class="absolute bottom-2 right-2 font-mono text-[10px] text-zinc-700/80 group-hover:text-amber-500/80 leading-none select-none transition-colors" aria-hidden="true">⌟</span>

                {{-- Architectural Isometric Wireframe Schematic (Clear Technical Blueprint) --}}
                <div class="absolute top-5 right-5 sm:top-8 sm:right-8 pointer-events-none opacity-45 group-hover:opacity-100 transition-all duration-300 z-0">
                    @if($service['id'] === 'fullstack')
                        {{-- Schematic: Browser Application Window + Two-Tier Server Rack & Database Blade --}}
                        <svg class="w-28 h-28 sm:w-36 sm:h-36 text-zinc-700/70 group-hover:text-amber-400/60 transition-all duration-300 group-hover:scale-105" viewBox="0 0 128 128" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            {{-- Browser Client Window --}}
                            <rect x="16" y="16" width="76" height="50" rx="4" />
                            <line x1="16" y1="28" x2="92" y2="28" />
                            <circle cx="23" cy="22" r="1.5" fill="currentColor" />
                            <circle cx="28" cy="22" r="1.5" fill="currentColor" />
                            <circle cx="33" cy="22" r="1.5" fill="currentColor" />
                            <rect x="42" y="19" width="44" height="6" rx="2" />
                            {{-- Browser Wireframe Layout --}}
                            <rect x="22" y="34" width="16" height="26" rx="1.5" />
                            <rect x="43" y="34" width="43" height="11" rx="1.5" />
                            <rect x="43" y="49" width="20" height="11" rx="1.5" />
                            <rect x="66" y="49" width="20" height="11" rx="1.5" />

                            {{-- Interconnection Bus Pipeline --}}
                            <path d="M38 66 L38 82 L48 82" stroke-dasharray="2 2" />
                            <circle cx="38" cy="82" r="2" fill="currentColor" />

                            {{-- Server Rack Blade 1 (API Core) --}}
                            <rect x="48" y="72" width="66" height="18" rx="2" />
                            <circle cx="54" cy="81" r="1.5" />
                            <rect x="62" y="76" width="14" height="10" rx="1" />
                            <rect x="80" y="76" width="14" height="10" rx="1" />
                            <circle cx="102" cy="81" r="1.5" fill="currentColor" />
                            <circle cx="107" cy="81" r="1.5" fill="currentColor" />

                            {{-- Server Rack Blade 2 (Database Cluster) --}}
                            <rect x="48" y="94" width="66" height="18" rx="2" />
                            <circle cx="54" cy="103" r="1.5" />
                            {{-- Database Cylinders Icon on Blade 2 --}}
                            <path d="M62 99 C62 97.5, 76 97.5, 76 99 L76 107 C76 108.5, 62 108.5, 62 107 Z" />
                            <ellipse cx="69" cy="99" rx="7" ry="2" />
                            <ellipse cx="69" cy="103" rx="7" ry="2" />
                            <rect x="80" y="98" width="14" height="10" rx="1" />
                            <circle cx="102" cy="103" r="1.5" fill="currentColor" />
                            <circle cx="107" cy="103" r="1.5" fill="currentColor" />
                        </svg>
                    @elseif($service['id'] === 'mobile')
                        {{-- Schematic: Modern Smartphone Device with Dynamic Island, App Wireframe & Sync Waves --}}
                        <svg class="w-28 h-28 sm:w-36 sm:h-36 text-zinc-700/70 group-hover:text-amber-400/60 transition-all duration-300 group-hover:scale-105" viewBox="0 0 128 128" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            {{-- Outer Smartphone Chassis --}}
                            <rect x="34" y="10" width="60" height="108" rx="12" stroke-width="2" />
                            {{-- Inner Touch Screen Display --}}
                            <rect x="39" y="16" width="50" height="96" rx="8" />

                            {{-- Dynamic Island Top Notch --}}
                            <rect x="54" y="21" width="20" height="5" rx="2.5" fill="currentColor" />
                            <circle cx="50" cy="23.5" r="1" fill="currentColor" />

                            {{-- Mobile App Screen Elements --}}
                            <circle cx="47" cy="34" r="3" />
                            <line x1="54" y1="34" x2="78" y2="34" stroke-width="2" />
                            {{-- Hero Mobile Card with Sparkline --}}
                            <rect x="44" y="42" width="40" height="20" rx="2" />
                            <path d="M48 55 L54 49 L61 53 L68 47 L75 51 L80 48" stroke-width="1.5" />
                            {{-- Two Feature Cards --}}
                            <rect x="44" y="66" width="18" height="24" rx="2" />
                            <rect x="66" y="66" width="18" height="24" rx="2" />
                            {{-- Bottom Navigation Bar & Home Indicator --}}
                            <line x1="39" y1="96" x2="89" y2="96" />
                            <line x1="52" y1="108" x2="76" y2="108" stroke-width="2.5" />

                            {{-- Wireless / PWA Offline Sync Beacon Waves --}}
                            <path d="M98 24 C106 30, 110 39, 110 49" stroke-dasharray="2 2" />
                            <path d="M104 16 C116 25, 122 38, 122 53" stroke-dasharray="2 2" />
                            <circle cx="94" cy="30" r="2" fill="currentColor" />
                        </svg>
                    @elseif($service['id'] === 'devops')
                        {{-- Schematic: Cloud Platform + Git Pipeline Branch + Docker Cargo Container --}}
                        <svg class="w-28 h-28 sm:w-36 sm:h-36 text-zinc-700/70 group-hover:text-amber-400/60 transition-all duration-300 group-hover:scale-105" viewBox="0 0 128 128" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            {{-- Cloud Infrastructure --}}
                            <path d="M30 46 C24 46, 20 41, 20 35 C20 29, 25 25, 30 25 C31 18, 39 14, 48 14 C56 14, 63 18, 65 24 C68 23, 72 23, 75 25 C80 27, 82 32, 81 37 C86 38, 90 42, 90 47 C90 52, 85 56, 80 56 L30 56 Z" />
                            <line x1="38" y1="36" x2="72" y2="36" />
                            <line x1="44" y1="44" x2="66" y2="44" />

                            {{-- Git CI/CD Branch Pipeline Flow --}}
                            <path d="M55 56 L55 68 L78 68 L78 78" stroke-dasharray="2 2" />
                            <circle cx="55" cy="68" r="3" fill="currentColor" fill-opacity="0.3" />
                            <circle cx="78" cy="68" r="3" fill="currentColor" fill-opacity="0.3" />
                            <polyline points="74,74 78,78 82,74" />

                            {{-- Docker Shipping / Cloud Container Unit --}}
                            <rect x="24" y="78" width="80" height="38" rx="3" stroke-width="2" />
                            {{-- Twist-Lock Corner Castings --}}
                            <rect x="25" y="79" width="6" height="6" />
                            <rect x="97" y="79" width="6" height="6" />
                            <rect x="25" y="109" width="6" height="6" />
                            <rect x="97" y="109" width="6" height="6" />
                            {{-- Vertical Corrugation Ribs --}}
                            <line x1="38" y1="78" x2="38" y2="116" />
                            <line x1="48" y1="78" x2="48" y2="116" />
                            <line x1="58" y1="78" x2="58" y2="116" />
                            <line x1="64" y1="78" x2="64" y2="116" stroke-width="2.5" />
                            <line x1="70" y1="78" x2="70" y2="116" />
                            <line x1="80" y1="78" x2="80" y2="116" />
                            <line x1="90" y1="78" x2="90" y2="116" />
                        </svg>
                    @elseif($service['id'] === 'ai')
                        {{-- Schematic: AI Silicon Microchip + Neural Brain Mesh + Vector Coordinates --}}
                        <svg class="w-28 h-28 sm:w-36 sm:h-36 text-zinc-700/70 group-hover:text-amber-400/60 transition-all duration-300 group-hover:scale-105" viewBox="0 0 128 128" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            {{-- Outer Silicon Chip Package --}}
                            <rect x="34" y="34" width="60" height="60" rx="6" stroke-width="2" />
                            <rect x="42" y="42" width="44" height="44" rx="3" stroke-dasharray="3 3" />

                            {{-- Microchip Bus Pins (Top, Bottom, Left, Right) --}}
                            <line x1="44" y1="22" x2="44" y2="34" />
                            <line x1="54" y1="22" x2="54" y2="34" />
                            <line x1="74" y1="22" x2="74" y2="34" />
                            <line x1="84" y1="22" x2="84" y2="34" />

                            <line x1="44" y1="94" x2="44" y2="106" />
                            <line x1="54" y1="94" x2="54" y2="106" />
                            <line x1="74" y1="94" x2="74" y2="106" />
                            <line x1="84" y1="94" x2="84" y2="106" />

                            <line x1="22" y1="44" x2="34" y2="44" />
                            <line x1="22" y1="54" x2="34" y2="54" />
                            <line x1="22" y1="74" x2="34" y2="74" />
                            <line x1="22" y1="84" x2="34" y2="84" />

                            <line x1="94" y1="44" x2="106" y2="44" />
                            <line x1="94" y1="54" x2="106" y2="54" />
                            <line x1="94" y1="74" x2="106" y2="74" />
                            <line x1="94" y1="84" x2="106" y2="84" />

                            {{-- Neural Core Nucleus & Synaptic Vector Graph --}}
                            <circle cx="64" cy="64" r="5" fill="currentColor" fill-opacity="0.3" stroke-width="2" />
                            <circle cx="52" cy="52" r="3" fill="currentColor" fill-opacity="0.2" />
                            <circle cx="76" cy="52" r="3" fill="currentColor" fill-opacity="0.2" />
                            <circle cx="52" cy="76" r="3" fill="currentColor" fill-opacity="0.2" />
                            <circle cx="76" cy="76" r="3" fill="currentColor" fill-opacity="0.2" />
                            <circle cx="64" cy="48" r="2" />
                            <circle cx="64" cy="80" r="2" />

                            {{-- Synaptic Decision Vectors --}}
                            <line x1="54" y1="54" x2="60" y2="61" />
                            <line x1="74" y1="54" x2="68" y2="61" />
                            <line x1="54" y1="74" x2="60" y2="67" />
                            <line x1="74" y1="74" x2="68" y2="67" />
                            <line x1="64" y1="50" x2="64" y2="59" />
                            <line x1="64" y1="69" x2="64" y2="78" />

                            {{-- Reticle Coordinate Anchors --}}
                            <path d="M16 16 L22 16 L22 22" />
                            <path d="M112 16 L106 16 L106 22" />
                            <path d="M16 112 L22 112 L22 106" />
                            <path d="M112 112 L106 112 L106 106" />
                        </svg>
                    @endif
                </div>

                {{-- Content Block (Elevated over watermark with crisp contrast) --}}
                <div class="relative z-10">
                    {{-- Header Row: Index Number + Status Badge --}}
                    <div class="flex items-center justify-between gap-2 mb-6">
                        <span class="font-roboto-mono text-xs font-bold text-amber-500/80 tracking-widest uppercase">
                            0{{ $index + 1 }}
                        </span>
                        <span class="inline-flex items-center gap-1.5 px-2 py-0.5 border border-zinc-800 bg-zinc-900/80 text-[10px] font-roboto-mono text-zinc-400 uppercase tracking-wider">
                            <span class="w-1.5 h-1.5 bg-amber-500"></span>
                            {{ $service['badge'] }}
                        </span>
                    </div>

                    {{-- Service Title in Oxanium --}}
                    <h3 class="font-oxanium font-extrabold text-xl sm:text-2xl text-white uppercase tracking-tight group-hover:text-amber-400 transition-colors mb-4 max-w-[85%]">
                        {{ __($service['title_key']) }}
                    </h3>

                    {{-- Service Description in Roboto Mono --}}
                    <p class="font-roboto-mono text-xs sm:text-sm text-slate-400 leading-relaxed mb-6 max-w-[90%]">
                        {{ __($service['desc_key']) }}
                    </p>
                </div>

                {{-- Bottom Specifications & Technology Tags (Elevated over watermark) --}}
                <div class="pt-6 border-t border-zinc-800/80 relative z-10">
                    <p class="font-roboto-mono text-[11px] font-semibold text-zinc-500 uppercase tracking-widest mb-3 group-hover:text-zinc-300 transition-colors">
                        {{ $service['metric'] }}
                    </p>

                    <div class="flex flex-wrap gap-1.5">
                        @foreach($service['tags'] as $tag)
                            <span class="px-2 py-1 border border-zinc-800 bg-card text-[11px] font-roboto-mono text-zinc-400 group-hover:border-zinc-700 transition-colors">
                                {{ $tag }}
                            </span>
                        @endforeach
                    </div>
                </div>

            </div>
        @endforeach

    </div>
</section>
