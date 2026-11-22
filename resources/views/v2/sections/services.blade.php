{{-- ====== Portfolio V2: Services & Capabilities Chamber ====== --}}
<section id="services" class="relative border-b border-zinc-800">
    {{-- ── 1. Section Header Strip ── --}}
    <x-v2.section-header
        :label="__('home.services_label')"
        :title="__('home.services_heading')"
        :accent="__('home.services_heading_accent')"
        :subtitle="__('home.services_subtitle')"
    />

    {{-- ── 2. Services Grid (2x2 Orthogonal Matrix with CAD Intersections) ── --}}
    <div class="grid grid-cols-1 md:grid-cols-2 divide-y md:divide-y-0 divide-zinc-800 relative">

        {{-- Top Center CAD Pin (intersection of vertical divider and section header floor line) --}}
        <x-v2.cad-pin class="hidden md:block absolute -top-1.5 left-1/2 -translate-x-1.5" />

        {{-- Bottom Center CAD Pin (intersection of vertical divider and bottom floor line) --}}
        <x-v2.cad-pin class="hidden md:block absolute -bottom-1.5 left-1/2 -translate-x-1.5" />

        @foreach(config('portfolio.services', []) as $index => $service)
            <x-v2.services.card :service="$service" :index="$index" />
        @endforeach

    </div>
</section>
