{{-- ====== Portfolio V2: Credentials & Trajectory Chamber ====== --}}
<section id="experience" class="relative border-b border-zinc-800 v2-chamber-contain">
    {{-- ── 1. Section Header Strip ── --}}
    <x-v2.section-header
        :label="__('home.credentials_label')"
        :title="__('home.credentials_heading')"
        :accent="__('home.credentials_heading_accent')"
        :subtitle="__('home.credentials_subtitle')"
    />

    {{-- ── 2. Work Experience (Interactive Spine Timeline Chamber) ── --}}
    <x-v2.credentials.experience />

    {{-- ── 3. Formal Education & Industry Certifications (2-Column Grid) ── --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 divide-y lg:divide-y-0 lg:divide-x divide-zinc-800 relative">
        {{-- Center Column Intersection Pins on Desktop (5/12 = 41.666667%) --}}
        <x-v2.cad-pin class="hidden lg:block absolute -top-1.5 left-[41.666667%] -translate-x-1.5" />
        <x-v2.cad-pin class="hidden lg:block absolute -bottom-1.5 left-[41.666667%] -translate-x-1.5" />

        {{-- ── LEFT: Formal University Degree & Diploma (5 Cols) ── --}}
        <x-v2.credentials.education />

        {{-- ── RIGHT: Official Industry Certifications (7 Cols) ── --}}
        <x-v2.credentials.certifications />
    </div>
</section>
