@php
$experience = [
    [
        'role'        => 'PHP Developer',
        'company'     => 'TICWorks',
        'date'        => 'Marzo 2026 – Abril 2026',
        'description' => 'Participé activamente en la modernización y el mantenimiento evolutivo de la plataforma TICWorks, colaborando en la migración técnica del motor de PHP 7.2 hacia PHP 8.2. Implementamos PHPStan para análisis estático preventivo y optimizamos el sistema de logging. Reforcé la seguridad en módulos críticos (Auth, Jobs, Payments) y mejoré la experiencia de postulación con flujos dinámicos.',
        'stack'       => ['PHP 8.2', 'Laravel', 'MySQL', 'PHPStan', 'Docker', 'Git', 'Composer'],
    ],
    [
        'role'        => 'Full Stack Developer (Laravel & React)',
        'company'     => 'Lia',
        'date'        => 'Febrero 2026 – Marzo 2026',
        'description' => 'Lideré el desarrollo del ecosistema de monetización y la maduración de la UI de Lia (IA). Implementé el flujo de suscripciones con Stripe Checkout y Laravel Cashier v16. Desarrollé un Paywall con interceptores dinámicos y gestión de estado con Zustand, asegurando soporte para Dark Mode e internacionalización bajo Clean Architecture.',
        'stack'       => ['PHP 8.3', 'Laravel 11', 'React', 'Zustand', 'Stripe', 'TypeScript', 'Tailwind', 'TDD'],
    ],
    [
        'role'        => 'Laravel / Vue Fullstack Developer',
        'company'     => 'Flusso',
        'date'        => 'Febrero 2026 – Marzo 2026',
        'description' => 'Ejecuté el rebranding completo de la Landing Page de Flusso, traduciendo diseños de Figma a una interfaz pixel-perfect de alta fidelidad. Implementé una experiencia 100% responsiva utilizando Tailwind CSS y Vue 3 con Inertia.js y Laravel 12, garantizando una implementación pulida y moderna del punto de entrada principal.',
        'stack'       => ['PHP 8.3', 'Laravel 12', 'Vue 3', 'Inertia.js', 'Tailwind', 'Git'],
    ],
    [
        'role'        => 'Laravel Backend Developer',
        'company'     => 'andrestelocambia',
        'date'        => 'Diciembre 2025 – Febrero 2026',
        'description' => 'Realicé un rebranding completo de la Landing Page y el Panel de Usuario de la plataforma de Exchange andrestelocambia, migrando la interfaz de Bootstrap a Tailwind CSS. Refactorización de módulos críticos como el flujo de envío de dinero. Implementación de OAuth con Google y Google Reviews vía SerpApi.',
        'stack'       => ['PHP 8.3', 'Laravel 11', 'jQuery', 'Docker', 'Git', 'Tailwind'],
    ],
    [
        'role'        => 'Laravel / Flutter Semi Senior Developer',
        'company'     => 'Imagine Apps',
        'date'        => 'Octubre 2025 – Noviembre 2025',
        'description' => 'Participé en la refactorización y modernización de un backend desarrollado en Laravel, migrándolo de Laravel 10 a Laravel 12. Mejoras de arquitectura, mantenimiento de código y preparación del sistema para una posterior reimplementación con FastAPI.',
        'stack'       => ['PHP 8.3', 'Laravel 12', 'jQuery', 'Docker', 'Flutter', 'Git'],
    ],
    [
        'role'        => 'PHP Backend Developer',
        'company'     => 'DVLOPER',
        'date'        => 'Febrero 2025 – Octubre 2025',
        'description' => 'Desarrollador FullStack utilizando el stack TALL. Responsable de la creación de módulos frontend con Livewire 3 y Tailwind CSS 3, así como del mantenimiento y desarrollo de nuevas funcionalidades en el backend con Laravel 11.',
        'stack'       => ['PHP 8.4', 'Laravel 11/12', 'Livewire 3', 'Tailwind 3', 'Docker', 'Git'],
    ],
    [
        'role'        => 'Analista DARC',
        'company'     => 'Universidad Cooperativa de Colombia',
        'date'        => 'Julio 2024 – Diciembre 2024',
        'description' => 'Responsable de la gestión integral de los procesos académicos. Desarrollé una guía valorada por la dirección para ejecutar de forma óptima los procesos asociados al cargo. Desarrollé un Sistema de Gestión de Activos para el área de TI.',
        'stack'       => ['Excel', 'Oracle PeopleSoft', 'PHP 8.4', 'Laravel 12', 'Livewire 3'],
    ],
    [
        'role'        => 'Analista de Desarrollo Junior',
        'company'     => 'DISTRACOM',
        'date'        => 'Noviembre 2023 – Febrero 2024',
        'description' => 'Proporcioné soporte integral a las estaciones de combustible. Creé desde cero y modifiqué scripts SQL que optimizaron significativamente las operaciones diarias al automatizar tareas manuales.',
        'stack'       => ['Excel', 'SQL Server'],
    ],
];
@endphp

{{-- ====== Experience Section ====== --}}
<section id="experience" class="exp-section relative overflow-hidden pt-24">

    {{-- Parallax bg text --}}
    <div class="bg-text" style="top: 50%; left: 50%; transform: translate(-50%, -50%);" data-parallax-bg>EXPERIENCIA</div>

    {{-- Stars background --}}
    <div class="exp-stars" aria-hidden="true"></div>
    <div class="exp-vignette" aria-hidden="true"></div>

    {{-- Section header --}}
    <div class="container relative z-10 mb-12">
        <div class="text-center reveal-up">
            <span class="section-label justify-center" data-scramble data-original="Trayectoria">Trayectoria</span>
            <h2 class="heading-glow font-display font-extrabold text-3xl sm:text-4xl lg:text-5xl text-slate-100 mb-4"
                style="font-family:var(--font-display); overflow:hidden;"
                data-clip-reveal>
                Experiencia <span class="gradient-text-static">profesional</span>
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
<h3 class="exp-role">{{ $job['role'] }}</h3>
                <div class="exp-company-row">
                    <span class="exp-company">{{ $job['company'] }}</span>
                    <span class="exp-date">{{ $job['date'] }}</span>
                </div>
                <p class="exp-description">{{ $job['description'] }}</p>
                <div class="exp-stack">
                    @foreach($job['stack'] as $tech)
                        <span class="exp-tag">{{ $tech }}</span>
                    @endforeach
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
