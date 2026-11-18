<x-app-layout>

    {{-- ── 0. Continuous Spine: Top Fixed Navbar ── --}}
    @include('v2.sections.navbar')

    {{-- ── UNIFIED ARCHITECTURAL CHASSIS (Continuous Grid Spine) ── --}}
    <div
        id="v2-chassis"
        class="relative bg-canvas text-slate-200 font-roboto-mono overflow-hidden"
    >
        {{-- Continuous background coordinate grid --}}
        <div
            class="absolute inset-0 pointer-events-none opacity-30"
            style="background-image: linear-gradient(to right, rgba(245, 158, 11, 0.05) 1px, transparent 1px), linear-gradient(to bottom, rgba(245, 158, 11, 0.05) 1px, transparent 1px); background-size: 56px 56px;"
        ></div>

        {{-- Master Continuous Vertical Rails (max-w-7xl with unbroken border-x) --}}
        <div class="max-w-7xl mx-auto border-x border-b border-zinc-800 relative bg-chamber/60 backdrop-blur-sm">

            {{-- Chamber 1: Hero --}}
            @include('v2.sections.hero')

            {{-- Chamber 2: Marquee Floor Beam --}}
            @include('v2.sections.marquee')

            {{-- Chamber 3: About --}}
            @include('v2.sections.about')

            {{-- Master Bottom Anchor Pins --}}
            <span class="absolute -bottom-1.5 -left-1.5 w-3 h-3 bg-amber-500 z-20 border border-black" aria-hidden="true"></span>
            <span class="absolute -bottom-1.5 -right-1.5 w-3 h-3 bg-amber-500 z-20 border border-black" aria-hidden="true"></span>

        </div>
    </div>

    {{-- Remaining V1 sections mounted until V2 chambers are built --}}
    <x-home.portfolio></x-home.portfolio>
    <x-home.experience></x-home.experience>
    <x-home.contact></x-home.contact>

</x-app-layout>
