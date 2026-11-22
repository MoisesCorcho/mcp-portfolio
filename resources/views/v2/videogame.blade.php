<x-app-layout>

    {{-- ── Continuous Spine: Top Fixed Navbar ── --}}
    @include('v2.sections.navbar')

    {{-- ── Breadcrumb & Return Bar ── --}}
    <div class="border-b border-zinc-800 bg-chamber/80 backdrop-blur-sm sticky top-16 sm:top-20 z-40">
        <div class="max-w-7xl mx-auto border-x border-zinc-800 px-4 sm:px-8 lg:px-12 py-3 flex items-center justify-between text-xs font-roboto-mono">
            <a
                href="/"
                class="inline-flex items-center gap-2 text-zinc-300 hover:text-amber-400 font-semibold transition-colors duration-200 group"
            >
                <span class="group-hover:-translate-x-1 transition-transform duration-200">←</span>
                <span>{{ __('home.back_to_home') }}</span>
            </a>

            <div class="flex items-center gap-3">
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 border border-amber-500/30 bg-amber-500/10 text-amber-400 text-[11px] font-semibold tracking-wider uppercase">
                    <span class="w-1.5 h-1.5 bg-amber-400 animate-pulse"></span>
                    <span>Special Project</span>
                </span>
                <span class="text-zinc-500 hidden md:inline">
                    Phaser 3 + Svelte + Pixel Art
                </span>
            </div>
        </div>
    </div>

    {{-- ── Dedicated Videogame Chamber ── --}}
    <main class="min-h-screen bg-void">
        <x-home.videogame></x-home.videogame>
    </main>

</x-app-layout>
