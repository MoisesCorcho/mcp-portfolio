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
                    {{ __('home.v2_footer_architect') }}
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
        <div class="flex items-center gap-2">
            <a
                href="{{ config('portfolio.owner.github') }}"
                target="_blank"
                rel="noopener noreferrer"
                class="w-9 h-9 border border-zinc-800 bg-zinc-900/80 hover:border-amber-500 hover:text-amber-400 text-zinc-400 flex items-center justify-center transition-colors"
                aria-label="GitHub"
            >
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/></svg>
            </a>
            <a
                href="{{ config('portfolio.owner.linkedin') }}"
                target="_blank"
                rel="noopener noreferrer"
                class="w-9 h-9 border border-zinc-800 bg-zinc-900/80 hover:border-amber-500 hover:text-amber-400 text-zinc-400 flex items-center justify-center transition-colors"
                aria-label="LinkedIn"
            >
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
            </a>
            <a
                href="{{ config('portfolio.owner.instagram') }}"
                target="_blank"
                rel="noopener noreferrer"
                class="w-9 h-9 border border-zinc-800 bg-zinc-900/80 hover:border-amber-500 hover:text-amber-400 text-zinc-400 flex items-center justify-center transition-colors"
                aria-label="Instagram"
            >
                <svg class="w-4 h-4 fill-current" viewBox="0 0 48 48"><path d="M 16.5 5 C 10.16639 5 5 10.16639 5 16.5 L 5 31.5 C 5 37.832757 10.166209 43 16.5 43 L 31.5 43 C 37.832938 43 43 37.832938 43 31.5 L 43 16.5 C 43 10.166209 37.832757 5 31.5 5 L 16.5 5 z M 16.5 8 L 31.5 8 C 36.211243 8 40 11.787791 40 16.5 L 40 31.5 C 40 36.211062 36.211062 40 31.5 40 L 16.5 40 C 11.787791 40 8 36.211243 8 31.5 L 8 16.5 C 8 11.78761 11.78761 8 16.5 8 z M 34 12 C 32.895 12 32 12.895 32 14 C 32 15.105 32.895 16 34 16 C 35.105 16 36 15.105 36 14 C 36 12.895 35.105 12 34 12 z M 24 14 C 18.495178 14 14 18.495178 14 24 C 14 29.504822 18.495178 34 24 34 C 29.504822 34 34 29.504822 34 24 C 34 18.495178 29.504822 14 24 14 z M 24 17 C 27.883178 17 31 20.116822 31 24 C 31 27.883178 27.883178 31 24 31 C 20.116822 31 17 27.883178 17 24 C 17 20.116822 20.116822 17 24 17 z"/></svg>
            </a>
        </div>

    </div>
</footer>
