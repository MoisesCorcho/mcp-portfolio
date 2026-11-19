{{-- ====== Portfolio V2: Cyber-Industrial Marquee Telemetry Beam ====== --}}
<div class="relative border-y border-zinc-800 bg-floor overflow-hidden py-3">
    {{-- Intersection Nodes where the Marquee horizontal lines meet the continuous vertical rails --}}
    <span class="absolute -top-1.5 -left-1.5 w-3 h-3 bg-amber-500 z-20 border border-black pointer-events-none" aria-hidden="true"></span>
    <span class="absolute -top-1.5 -right-1.5 w-3 h-3 bg-amber-500 z-20 border border-black pointer-events-none" aria-hidden="true"></span>
    <span class="absolute -bottom-1.5 -left-1.5 w-3 h-3 bg-amber-500 z-20 border border-black pointer-events-none" aria-hidden="true"></span>
    <span class="absolute -bottom-1.5 -right-1.5 w-3 h-3 bg-amber-500 z-20 border border-black pointer-events-none" aria-hidden="true"></span>

    {{-- Left & Right Edge Gradient Fade Masks (Dissolves chips into the floor void) --}}
    <div class="absolute inset-y-0 left-0 w-16 sm:w-28 bg-gradient-to-r from-floor via-floor/90 to-transparent z-10 pointer-events-none" aria-hidden="true"></div>
    <div class="absolute inset-y-0 right-0 w-16 sm:w-28 bg-gradient-to-l from-floor via-floor/90 to-transparent z-10 pointer-events-none" aria-hidden="true"></div>

    {{-- Seamless Looping Marquee Track --}}
    <div
        class="marquee-track flex items-center gap-3 sm:gap-4 whitespace-nowrap hover:[animation-play-state:paused]"
        style="animation: marquee-scroll 38s linear infinite;"
    >
        @php
            $marqueeItems = config('portfolio.marquee', []);
        @endphp

        {{-- Render two identical sets to ensure infinite 0 -> -50% translateX loop --}}
        @for($set = 0; $set < 2; $set++)
            @foreach($marqueeItems as $tech)
                <div class="inline-flex items-center gap-2 px-3 py-1.5 border border-zinc-800/90 bg-card/70 hover:bg-card hover:border-amber-500/80 transition-all duration-200 group/chip select-none flex-shrink-0 shadow-sm cursor-default">
                    {{-- Active LED Status Indicator --}}
                    <span class="w-1.5 h-1.5 bg-amber-500 group-hover/chip:shadow-[0_0_8px_rgba(245,158,11,0.8)] group-hover/chip:scale-125 transition-all" aria-hidden="true"></span>

                    {{-- Technology Identifier --}}
                    <span class="font-roboto-mono text-xs font-semibold text-zinc-300 group-hover/chip:text-white uppercase tracking-wider transition-colors">
                        {{ $tech['name'] }}
                    </span>

                    {{-- Domain Taxonomy Chip --}}
                    <span class="px-1.5 py-0.5 border border-zinc-800 bg-zinc-900/90 text-[9px] font-roboto-mono font-medium text-amber-500/80 uppercase tracking-widest group-hover/chip:border-amber-500/30 group-hover/chip:text-amber-400 transition-colors">
                        {{ $tech['domain'] }}
                    </span>
                </div>
            @endforeach
        @endfor
    </div>
</div>
