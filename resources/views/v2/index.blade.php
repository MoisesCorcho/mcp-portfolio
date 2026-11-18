<x-app-layout>

    {{-- ── 0. Continuous Spine: Top Fixed Navbar ── --}}
    @include('v2.sections.navbar')

    {{-- ── UNIFIED ARCHITECTURAL CHASSIS (Continuous Grid Spine) ── --}}
    <div
        id="v2-chassis"
        class="relative bg-canvas text-slate-200 font-roboto-mono overflow-hidden"
    >
        {{-- Continuous background coordinate grid (Tactical CAD blueprint plane) --}}
        <div
            class="absolute inset-0 pointer-events-none opacity-20"
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

            {{-- Chamber 4: Services & Capabilities --}}
            @include('v2.sections.services')

            {{-- Chamber 5: Projects Showroom --}}
            @include('v2.sections.projects')

            {{-- Chamber 6: Credentials & Trajectory --}}
            @include('v2.sections.credentials')

            {{-- Chamber 7: Contact --}}
            @include('v2.sections.contact')

            {{-- Chamber 8: Cyber-Industrial Footer Beam --}}
            @include('v2.sections.footer')

            {{-- Master Bottom Anchor Pins --}}
            <span class="absolute -bottom-1.5 -left-1.5 w-3 h-3 bg-amber-500 z-20 border border-black pointer-events-none" aria-hidden="true"></span>
            <span class="absolute -bottom-1.5 -right-1.5 w-3 h-3 bg-amber-500 z-20 border border-black pointer-events-none" aria-hidden="true"></span>

        </div>
    </div>

</x-app-layout>
