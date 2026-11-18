{{-- ====== Portfolio V2: Marquee Floor Beam ====== --}}
<div class="relative border-y border-zinc-800 bg-floor overflow-hidden py-3">
    {{-- Intersection Nodes where the Marquee horizontal lines meet the continuous vertical rails --}}
    <span class="absolute -top-1.5 -left-1.5 w-3 h-3 bg-amber-500 z-20 border border-black" aria-hidden="true"></span>
    <span class="absolute -top-1.5 -right-1.5 w-3 h-3 bg-amber-500 z-20 border border-black" aria-hidden="true"></span>
    <span class="absolute -bottom-1.5 -left-1.5 w-3 h-3 bg-amber-500 z-20 border border-black" aria-hidden="true"></span>
    <span class="absolute -bottom-1.5 -right-1.5 w-3 h-3 bg-amber-500 z-20 border border-black" aria-hidden="true"></span>

    <div class="marquee-track flex gap-12 whitespace-nowrap" style="animation: marquee-scroll 25s linear infinite;">
        @php $items = __('home.marquee_items'); @endphp
        @foreach($items as $item)
            <span class="text-xs font-roboto-mono font-semibold tracking-[0.25em] uppercase text-amber-500/70">{{ $item }}</span>
            <span class="text-zinc-700">·</span>
        @endforeach
    </div>
</div>
