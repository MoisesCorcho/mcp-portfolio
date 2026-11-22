{{-- ====== Portfolio V2: Cyber-Industrial Navbar ====== --}}
<header
    x-data="{ navOpen: false }"
    class="sticky top-0 z-50 w-full border-b border-zinc-800 bg-chamber/90 backdrop-blur-md overflow-x-clip"
>
    {{-- Continuous 1280px Grid Rail Spine --}}
    <div class="max-w-7xl mx-auto border-x border-zinc-800 relative px-4 sm:px-8 lg:px-12 flex items-center justify-between h-16 sm:h-20">

        {{-- CAD Intersection Pins at bottom junction of the navbar and continuous rails --}}
        <x-v2.cad-pin class="absolute -bottom-1.5 -left-1.5" />
        <x-v2.cad-pin class="absolute -bottom-1.5 -right-1.5" />

        {{-- ── Left: Brand Identifier ── --}}
        <a href="/" class="flex items-center gap-3 group">
            <span class="w-8 h-8 sm:w-9 sm:h-9 bg-amber-500 text-black font-oxanium font-extrabold text-sm sm:text-base flex items-center justify-center border border-amber-300 shadow-[0_0_15px_rgba(245,158,11,0.25)] select-none shrink-0">
                {{ config('portfolio.owner.brand_initial', 'M') }}
            </span>
            <span class="font-oxanium font-bold text-base sm:text-lg tracking-tight text-white group-hover:text-amber-400 transition-colors uppercase">
                {{ config('portfolio.owner.brand_name', 'Moisés Corcho') }}<span class="text-amber-500">.</span>
            </span>
        </a>

        {{-- ── Center: Desktop Navigation Links ── --}}
        <nav class="hidden lg:flex items-center gap-1 font-roboto-mono text-xs font-semibold tracking-wider uppercase">
            <a
                href="{{ request()->routeIs('home') || request()->routeIs('v2.home') ? '#about' : '/#about' }}"
                class="px-3.5 py-2 text-zinc-300 hover:text-amber-400 hover:bg-amber-500/10 border border-transparent hover:border-zinc-800 transition-all duration-200"
            >
                {{ __('home.nav_about') }}
            </a>
            <a
                href="{{ request()->routeIs('home') || request()->routeIs('v2.home') ? '#services' : '/#services' }}"
                class="px-3.5 py-2 text-zinc-300 hover:text-amber-400 hover:bg-amber-500/10 border border-transparent hover:border-zinc-800 transition-all duration-200"
            >
                {{ __('home.nav_services') }}
            </a>
            <a
                href="{{ request()->routeIs('home') || request()->routeIs('v2.home') ? '#portfolio' : '/#portfolio' }}"
                class="px-3.5 py-2 text-zinc-300 hover:text-amber-400 hover:bg-amber-500/10 border border-transparent hover:border-zinc-800 transition-all duration-200"
            >
                {{ __('home.nav_projects') }}
            </a>
            <a
                href="{{ request()->routeIs('home') || request()->routeIs('v2.home') ? '#experience' : '/#experience' }}"
                class="px-3.5 py-2 text-zinc-300 hover:text-amber-400 hover:bg-amber-500/10 border border-transparent hover:border-zinc-800 transition-all duration-200"
            >
                {{ __('home.nav_experience') }}
            </a>
            <a
                href="/videogame"
                class="px-3.5 py-2 transition-all duration-200 flex items-center gap-1.5 border {{ request()->routeIs('videogame') || request()->routeIs('v2.videogame') ? 'border-amber-500 text-amber-400 bg-amber-500/10' : 'text-zinc-300 hover:text-amber-400 hover:bg-amber-500/10 border-transparent hover:border-zinc-800' }}"
            >
                <span>{{ __('home.nav_videogame') }}</span>
                <span class="text-[10px] text-amber-500">↗</span>
            </a>
            <a
                href="{{ request()->routeIs('home') || request()->routeIs('v2.home') ? '#contact' : '/#contact' }}"
                class="px-3.5 py-2 text-zinc-300 hover:text-amber-400 hover:bg-amber-500/10 border border-transparent hover:border-zinc-800 transition-all duration-200"
            >
                {{ __('home.nav_contact') }}
            </a>
        </nav>

        {{-- ── Right: Language Switcher & Contact CTA ── --}}
        <div class="hidden lg:flex items-center gap-3">
            {{-- Orthogonal Language Switcher Cell --}}
            <x-v2.extruded-box
                as="a"
                href="{{ route('lang.switch', app()->getLocale() === 'es' ? 'en' : 'es') }}"
                variant="zinc"
                depth="sm"
                :glow="true"
                class="w-10 h-10 text-zinc-100 font-roboto-mono text-xs font-bold flex items-center justify-center select-none"
                title="{{ app()->getLocale() === 'es' ? __('home.nav_lang_switch_title_to_en') : __('home.nav_lang_switch_title_to_es') }}"
            >
                {{ app()->getLocale() === 'es' ? 'EN' : 'ES' }}
            </x-v2.extruded-box>

            {{-- Primary Action CTA Button (Zero Rounded Corners) --}}
            <x-v2.extruded-box
                as="a"
                href="#contact"
                variant="amber"
                depth="sm"
                :glow="true"
                class="inline-flex items-center gap-2 px-5 py-2.5 font-roboto-mono font-bold text-xs uppercase tracking-wider"
            >
                <span>{{ __('home.nav_cta') }}</span>
                <svg class="w-3.5 h-3.5 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="square" stroke-linejoin="miter" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </x-v2.extruded-box>
        </div>

        {{-- ── Mobile Hamburger Toggle (Orthogonal 40x40 Cell) ── --}}
        <div class="flex items-center gap-2 lg:hidden">
            <x-v2.extruded-box
                as="a"
                href="{{ route('lang.switch', app()->getLocale() === 'es' ? 'en' : 'es') }}"
                variant="zinc"
                depth="sm"
                class="w-10 h-10 text-zinc-100 font-roboto-mono text-xs font-bold flex items-center justify-center select-none"
            >
                {{ app()->getLocale() === 'es' ? 'EN' : 'ES' }}
            </x-v2.extruded-box>

            <button
                @click="navOpen = !navOpen"
                type="button"
                :aria-expanded="navOpen ? 'true' : 'false'"
                aria-label="Toggle Navigation"
                class="w-10 h-10 border border-zinc-800 bg-zinc-900/80 hover:border-amber-500 text-zinc-300 hover:text-amber-400 transition-colors flex flex-col items-center justify-center gap-1.5 focus:outline-none"
            >
                <span class="w-5 h-[2px] bg-current transition-transform duration-200" :class="navOpen && 'rotate-45 translate-y-2'"></span>
                <span class="w-5 h-[2px] bg-current transition-opacity duration-200" :class="navOpen && 'opacity-0'"></span>
                <span class="w-5 h-[2px] bg-current transition-transform duration-200" :class="navOpen && '-rotate-45 -translate-y-2'"></span>
            </button>
        </div>
    </div>

    {{-- ── Mobile Dropdown Drawer (Architectural Chamber) ── --}}
    <div
        x-show="navOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="lg:hidden border-b border-zinc-800 bg-card border-t border-zinc-800"
        style="display: none;"
    >
        <div class="max-w-7xl mx-auto border-x border-zinc-800 px-6 py-6 flex flex-col gap-3 font-roboto-mono text-xs uppercase tracking-wider font-semibold">
            <a
                @click="navOpen = false"
                href="{{ request()->routeIs('home') || request()->routeIs('v2.home') ? '#about' : '/#about' }}"
                class="py-3 px-4 border border-zinc-800 bg-zinc-950/60 text-zinc-200 hover:text-amber-400 hover:border-amber-500 transition-colors"
            >
                {{ __('home.nav_about') }}
            </a>
            <a
                @click="navOpen = false"
                href="{{ request()->routeIs('home') || request()->routeIs('v2.home') ? '#services' : '/#services' }}"
                class="py-3 px-4 border border-zinc-800 bg-zinc-950/60 text-zinc-200 hover:text-amber-400 hover:border-amber-500 transition-colors"
            >
                {{ __('home.nav_services') }}
            </a>
            <a
                @click="navOpen = false"
                href="{{ request()->routeIs('home') || request()->routeIs('v2.home') ? '#portfolio' : '/#portfolio' }}"
                class="py-3 px-4 border border-zinc-800 bg-zinc-950/60 text-zinc-200 hover:text-amber-400 hover:border-amber-500 transition-colors"
            >
                {{ __('home.nav_projects') }}
            </a>
            <a
                @click="navOpen = false"
                href="{{ request()->routeIs('home') || request()->routeIs('v2.home') ? '#experience' : '/#experience' }}"
                class="py-3 px-4 border border-zinc-800 bg-zinc-950/60 text-zinc-200 hover:text-amber-400 hover:border-amber-500 transition-colors"
            >
                {{ __('home.nav_experience') }}
            </a>
            <a
                @click="navOpen = false"
                href="/videogame"
                class="py-3 px-4 border bg-zinc-950/60 transition-colors flex items-center justify-between {{ request()->routeIs('videogame') || request()->routeIs('v2.videogame') ? 'border-amber-500 text-amber-400' : 'border-zinc-800 text-zinc-200 hover:text-amber-400 hover:border-amber-500' }}"
            >
                <span>{{ __('home.nav_videogame') }}</span>
                <span class="text-amber-500">↗</span>
            </a>
            <a
                @click="navOpen = false"
                href="{{ request()->routeIs('home') || request()->routeIs('v2.home') ? '#contact' : '/#contact' }}"
                class="py-3 px-4 border border-zinc-800 bg-zinc-950/60 text-zinc-200 hover:text-amber-400 hover:border-amber-500 transition-colors"
            >
                {{ __('home.nav_contact') }}
            </a>

            <div class="pt-3">
                <x-v2.extruded-box
                    as="a"
                    @click="navOpen = false"
                    href="{{ request()->routeIs('home') || request()->routeIs('v2.home') ? '#contact' : '/#contact' }}"
                    variant="amber"
                    depth="sm"
                    :glow="true"
                    class="w-full flex items-center justify-center gap-2 py-3 font-roboto-mono font-bold text-xs uppercase tracking-wider"
                >
                    <span>{{ __('home.nav_cta') }}</span>
                    <svg class="w-4 h-4 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="square" stroke-linejoin="miter" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </x-v2.extruded-box>
            </div>
        </div>
    </div>
</header>
