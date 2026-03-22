@php
$experience = __('home.experience_jobs');
@endphp

{{-- ====== Experience Section ====== --}}
<section id="experience" class="exp-section relative overflow-hidden pt-24">

    {{-- Parallax bg text --}}
    <div class="bg-text" style="top: 50%; left: 50%; transform: translate(-50%, -50%);" data-parallax-bg>{{ __('home.experience_parallax_bg') }}</div>

    {{-- Stars background — 3 layers (sm/md/lg) animated via JS box-shadow --}}
    <div class="exp-stars" aria-hidden="true">
        <div class="exp-stars__layer exp-stars__sm" id="exp-stars-sm"></div>
        <div class="exp-stars__layer exp-stars__md" id="exp-stars-md"></div>
        <div class="exp-stars__layer exp-stars__lg" id="exp-stars-lg"></div>
    </div>
    <div class="exp-vignette" aria-hidden="true"></div>

    {{-- Section header --}}
    <div class="container relative z-10 mb-12">
        <div class="text-center reveal-up">
            <span class="section-label justify-center" data-scramble data-original="{{ __('home.experience_label') }}">{{ __('home.experience_label') }}</span>
            <h2 class="heading-glow font-display font-extrabold text-3xl sm:text-4xl lg:text-5xl text-slate-100 mb-4"
                style="font-family:var(--font-display); overflow:hidden;"
                data-clip-reveal>
                {{ __('home.experience_heading') }} <span class="gradient-text-static">{{ __('home.experience_heading_accent') }}</span>
            </h2>
            <span class="section-line mx-auto" style="width:60px;"></span>
        </div>
    </div>

    {{-- Pinned carousel --}}
    <div class="exp-carousel-outer">
      <div class="exp-scene">
        <div class="exp-track" id="exp-track">
            @foreach($experience as $i => $job)
            <div class="exp-card glass" data-exp-index="{{ $i }}">
                <div class="exp-card__body">
                    <h3 class="exp-role">{{ $job['role'] }}</h3>
                    <div class="exp-company-row">
                        <span class="exp-company">{{ $job['company'] }}</span>
                        <span class="exp-date">{{ $job['date'] }}</span>
                    </div>
                    <div class="exp-description">
                        <span class="exp-description__inner">{!! $job['description'] !!}</span>
                    </div>
                    <div class="exp-stack">
                        @foreach($job['stack'] as $tech)
                            <span class="exp-tag">{{ $tech }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
      </div>
    </div>

    {{-- Progress bar --}}
    <div class="exp-progress-bar">
        <div class="exp-progress-fill" id="exp-progress"></div>
    </div>

</section>
