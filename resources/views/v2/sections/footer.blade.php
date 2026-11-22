{{-- ====== Portfolio V2: Cyber-Industrial Footer Beam ====== --}}
<footer class="border-t border-zinc-800 bg-floor relative">
    <div class="p-6 sm:px-10 lg:px-14 py-8 flex flex-col sm:flex-row items-center justify-between gap-6">

        {{-- Brand & Role --}}
        <div class="flex items-center gap-3">
            <span class="w-8 h-8 bg-amber-500 text-black font-oxanium font-extrabold text-sm flex items-center justify-center border border-amber-300 shadow-[0_0_15px_rgba(245,158,11,0.25)] select-none">
                {{ config('portfolio.owner.brand_initial', 'M') }}
            </span>
            <div class="flex flex-col text-left">
                <span class="font-oxanium font-bold text-sm sm:text-base tracking-tight text-white uppercase">
                    {{ config('portfolio.owner.brand_name', 'Moisés Corcho') }}<span class="text-amber-500">.</span>
                </span>
                <span class="text-[10px] font-roboto-mono text-zinc-500 uppercase tracking-widest">
                    {{ __('home.v2_footer_role') }}
                </span>
            </div>
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
