{{-- ====== Portfolio Section ====== --}}
<section
    id="portfolio"
    x-data="{
        selectedTab: 'all',
        get activeTabClasses() { return 'filter-tab active'; },
        get inactiveTabClasses() { return 'filter-tab'; },
    }"
    class="relative pt-24 lg:pt-32 pb-20 lg:pb-28 overflow-hidden"
    style="background: linear-gradient(180deg, #020617 0%, #0f172a 40%, #020617 100%);"
>
    {{-- Decorative oversized bg text (parallax via JS) --}}
    <div class="bg-text" style="top: 50%; left: 50%; transform: translate(-50%, -50%);" data-parallax-bg>PROYECTOS</div>

    {{-- Decorative background --}}
    <div style="position:absolute; width:700px; height:700px; background:rgba(245,158,11,0.04); top:50%; left:50%; transform:translate(-50%,-50%); border-radius:50%; filter:blur(120px); pointer-events:none;"></div>
    <div class="dot-grid absolute inset-0 opacity-20 pointer-events-none"></div>

    <div class="container relative z-10">

        {{-- Section header --}}
        <div class="text-center mb-14 reveal-up">
            <span class="section-label justify-center" data-scramble data-original="Portafolio">Portafolio</span>
            <h2 class="font-display font-extrabold text-3xl sm:text-4xl lg:text-5xl text-slate-100 mb-4"
                style="font-family:var(--font-display); overflow:hidden;"
                data-clip-reveal>
                Mis proyectos
                <span class="gradient-text-static">recientes</span>
            </h2>
            <p class="text-slate-400 max-w-md mx-auto" style="font-family:var(--font-body); font-size:0.95rem;">
                La mejor manera de aprender a programar es creando proyectos.
            </p>
            <span class="section-line mx-auto mt-4" style="width:60px;"></span>
        </div>

        {{-- Category filter tabs --}}
        <div class="flex flex-wrap justify-center gap-2 mb-12 reveal-up">
            <button
                @click="selectedTab = 'all'"
                :class="selectedTab === 'all' ? activeTabClasses : inactiveTabClasses"
                class="filter-tab"
            >
                Todos los proyectos
            </button>

            @foreach($tabs as $tab)
                <button
                    @click="selectedTab = '{{ $tab }}'"
                    :class="selectedTab === '{{ $tab }}' ? activeTabClasses : inactiveTabClasses"
                    class="filter-tab"
                >
                    {{ $tab }}
                </button>
            @endforeach
        </div>

        {{-- Cards grid --}}
        <div class="stagger-parent grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach($items as $item)
                <x-portfolio-item
                    :title="$item->title"
                    :categories="$item->categories->pluck('name')->toArray()"
                    :image="$item->image"
                    :github="$item->github ?? '#'"
                ></x-portfolio-item>
            @endforeach
        </div>

    </div>
</section>
