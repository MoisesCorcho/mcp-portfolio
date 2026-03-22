<?php

return [

    // ── Layout ──────────────────────────────────────────────────────────────
    'meta_description' => 'Moisés Corcho Pérez — Desarrollador Web Backend con 4 años de experiencia en Laravel, PHP y MySQL.',
    'page_title'        => 'Moisés Corcho — Dev Portfolio',

    // ── Navbar ───────────────────────────────────────────────────────────────
    'nav_about'   => 'Acerca de mi',
    'nav_projects' => 'Proyectos',
    'nav_contact' => 'Contacto',
    'nav_cta'     => 'Contáctame',
    'nav_lang_switch_title_to_en' => 'Switch to English',
    'nav_lang_switch_title_to_es' => 'Cambiar a Español',

    // ── Footer ───────────────────────────────────────────────────────────────
    'footer_made_with' => '© :year Moisés Corcho Pérez. Hecho con ❤️',

    // ── Hero ─────────────────────────────────────────────────────────────────
    'hero_badge'         => 'Disponible para proyectos',
    'hero_greeting'      => 'Mi nombre es',
    'hero_subtitle'      => 'Desarrollador web backend con <strong class="text-slate-200 font-semibold">+4 años de experiencia</strong> construyendo aplicaciones robustas con <span class="text-amber-400 font-semibold">Laravel</span>, <span class="text-amber-400 font-semibold">PHP</span> y MySQL. Apasionado por el código limpio y las arquitecturas escalables.',
    'hero_cta_primary'   => 'Ver mis proyectos',
    'hero_cta_secondary' => 'Sobre mí',
    'hero_social_label'  => 'Redes sociales',
    'hero_photo_alt'     => 'Moisés Corcho Pérez',

    // ── Marquee ──────────────────────────────────────────────────────────────
    'marquee_items' => ['Laravel', 'PHP', 'MySQL', 'Docker', 'Git', 'Backend Dev', 'Clean Code', 'API REST', 'Laravel', 'PHP', 'MySQL', 'Docker', 'Git', 'Backend Dev', 'Clean Code', 'API REST'],

    // ── About ────────────────────────────────────────────────────────────────
    'about_parallax_bg'    => 'SOBRE MÍ',
    'about_label'          => 'Acerca de mí',
    'about_heading'        => 'Quién soy',
    'about_heading_accent' => 'más allá del código',
    'about_quote'          => '"Not everything is achievable with hard work, but… it helps a lot."',
    'about_para_1'         => 'Mi formación como <strong class="text-slate-200">Ingeniero de Sistemas</strong>, culminada con honores, me dotó de una aguda capacidad para el análisis y la resolución lógica de problemas. El conocimiento acumulado a lo largo de estos años me permite construir soluciones robustas y eficientes.',
    'about_para_2'         => 'Cuando no estoy inmerso en el código, probablemente estoy compartiendo mimos con mis gatos o dejándome llevar por la música — escuchándola o tocándola. Estas pasiones me aportan perspectiva y creatividad a la hora de colaborar.',
    'about_stack_label'    => 'Stack técnico',
    'about_stack_prefix'   => 'Desarrollo con',
    'about_github_btn'     => 'Ver mi GitHub',
    'about_img_piano_alt'  => 'Moisés tocando piano',
    'about_img_cat_pc_alt' => 'Gata con PC',
    'about_img_cat_alt'    => 'Gata mascota',

    // ── Portfolio ────────────────────────────────────────────────────────────
    'portfolio_label'        => 'Portafolio',
    'portfolio_heading'      => 'Mis proyectos',
    'portfolio_heading_accent' => 'recientes',
    'portfolio_subtitle'     => 'La mejor manera de aprender a programar es creando proyectos.',
    'portfolio_tab_all'      => 'Todos los proyectos',

    // ── Experience ───────────────────────────────────────────────────────────
    'experience_parallax_bg'    => 'EXPERIENCIA',
    'experience_label'          => 'Trayectoria',
    'experience_heading'        => 'Experiencia',
    'experience_heading_accent' => 'profesional',

    'experience_jobs' => [
        [
            'role'        => 'Full Stack Developer',
            'company'     => 'DVLOPER',
            'date'        => 'Febrero 2026 – Actualidad',
            'description' => 'Como desarrollador en DVLOPER, participé en la arquitectura y desarrollo de múltiples productos digitales complejos para distintos clientes (bajo NDA):<br><br>• <strong class="text-slate-200">Plataforma HR Tech B2B (TicWorks):</strong> Participación en migración del core a PHP 8.2, dockerización, centralización de configuraciones sensibles en archivos .env  y optimización de flujos dinámicos de postulación.<br>• <strong class="text-slate-200">SaaS de IA para Instagram (Lia):</strong> Lideré la UI y el ecosistema de monetización usando React, Zustand, Stripe Checkout y Laravel Cashier v16 bajo principios de Clean Architecture.<br>• <strong class="text-slate-200">Exchange Corporativo Europeo (Flusso):</strong> Rebranding responsivo pixel-perfect de su landing page usando Vue 3 e Inertia.js sobre Laravel 12.',
            'stack'       => ['PHP 8.2/8.3', 'Laravel', 'React', 'Vue 3', 'Inertia.js', 'Stripe', 'Tailwind', 'Docker'],
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
    ],

    // ── Videogame ────────────────────────────────────────────────────────────
    'vg_label'              => '⚔ Proyecto Especial ⚔',
    'vg_subtitle'           => 'Un Action-Platformer 2D — la gamificación de mi carrera',
    'vg_why_heading'        => '// El Por Qué',
    'vg_why_p1'             => 'Desde pequeño fui un <span class="vg-highlight">amante de los juegos de pixel art</span> y los juegos retro. Y desde hace mucho tiempo me fascina la programación.',
    'vg_why_p2'             => 'Siempre tuve el sueño de crear mi propio videojuego — no por fama, sino por <span class="vg-highlight">entender</span>: cómo funciona un juego por dentro, cómo se crean los personajes, cómo se mueven, cómo interaccionan entre sí. Y el hecho de que pueda crear algo que otras personas puedan jugar es, para mí, <span class="vg-highlight">maravilloso</span>.',
    'vg_quote'              => 'Este proyecto es el inicio del camino, pero también es una <span class="vg-highlight">meta cumplida</span>. Un sueño hecho realidad de mi yo pequeño.<br><br>Le estoy diciendo a ese pequeño Moisés: <span class="vg-highlight">lo estamos logrando</span>. Y me siento orgulloso de eso.',
    'vg_stack_heading'      => '// Stack',
    'vg_about_game_heading' => '// Sobre el Juego',
    'vg_about_game_text'    => '<span class="vg-highlight">The Developer\'s Journey</span> no es solo un juego de plataformas en 2D. Es la gamificación de mi currículum y mi carrera profesional. Construido desde cero para correr nativamente en el navegador usando <span class="vg-highlight">Phaser 3</span>, JavaScript y Svelte, este Action-Platformer te invita a explorar mis skills, enfrentar los \'bugs\' (literalmente) y descubrir cómo mi pasión por resolver problemas de software se traduce en código limpio y creativo.',
    'vg_action_heading'     => '// En Acción',
    'vg_ready_to_play'      => '¿Listo para jugar?',
    'vg_play_btn'           => '▶ JUGAR AHORA',
    'vg_github_btn'         => '⌥ VER EN GITHUB',
    'vg_keyboard_note'      => '* Requiere teclado para jugar',
    'vg_screenshot_start_alt'        => 'Pantalla de inicio',
    'vg_screenshot_snow_alt'         => 'Nivel de nieve',
    'vg_screenshot_certificates_alt' => 'Pantalla de certificados',
    'vg_gallery_dot_aria'            => 'Ver captura :number',

    // ── Contact ──────────────────────────────────────────────────────────────
    'contact_parallax_bg'   => 'CONTACTO',
    'contact_label'         => 'Contacto',
    'contact_heading'       => '¿Trabajamos',
    'contact_heading_accent' => 'juntos?',
    'contact_subtitle'      => 'Si sientes que mi experiencia satisface tus necesidades, no dudes en escribirme.',
    'contact_left_heading'  => 'Hablemos',
    'contact_left_text'     => 'Estoy abierto a oportunidades de trabajo, colaboraciones en proyectos freelance o simplemente a conectar con otras personas del sector.',
    'contact_email_label'   => 'Correo',
    'contact_location_label' => 'Ubicación',
    'contact_location_value' => 'Colombia — Disponible remoto',
    'contact_social_label'  => 'Redes sociales',
    'contact_name_label'    => 'Nombre',
    'contact_name_placeholder' => 'Tu nombre completo',
    'contact_email_field_label' => 'Email',
    'contact_email_placeholder' => 'tu@email.com',
    'contact_message_label' => 'Mensaje',
    'contact_message_placeholder' => 'Cuéntame sobre tu proyecto o idea...',
    'contact_submit_btn'    => 'Enviar mensaje',
    'contact_sending'       => 'Enviando…',
    'contact_success'       => 'Gracias por tu mensaje. Te responderé lo antes posible.',

];
