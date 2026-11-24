{{-- ====== Portfolio V2: Cyber-Industrial Footer Beam ====== --}}
<footer class="border-t border-zinc-800 bg-floor relative">
    <div class="p-6 sm:px-10 lg:px-14 py-8 flex flex-col sm:flex-row items-center justify-between gap-6">

        {{-- Brand & Role --}}
        <div class="flex items-center gap-4">
            <a href="/" class="group flex items-center my-auto" aria-label="Home">
                <x-v2.brand-logo class="h-11 sm:h-13 w-auto text-white group-hover:text-amber-400 group-hover:drop-shadow-[0_0_12px_rgba(245,158,11,0.5)] transition-all duration-200 shrink-0 select-none" />
            </a>
            <span class="text-[10px] sm:text-[11px] font-roboto-mono text-zinc-500 uppercase tracking-widest border-l border-zinc-800 pl-4 py-1">
                {{ __('home.v2_footer_role') }}
            </span>
        </div>

        {{-- Copyright & Location --}}
        <div class="text-center sm:text-left">
            <p class="font-roboto-mono text-xs text-zinc-500">
                © {{ date('Y') }} {{ config('portfolio.owner.name') }}. {{ __('home.v2_footer_rights') }}
            </p>
            <p class="font-roboto-mono text-[11px] text-zinc-600 mt-1">
                {{ config('portfolio.owner.location') }} · {{ __('home.contact_location_value') }}
            </p>
        </div>

        {{-- Social Icons Matrix (Square Orthogonal Cells) --}}
        <x-v2.social-links size="sm" />

    </div>
</footer>
