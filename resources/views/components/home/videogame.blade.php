<section id="videogame" class="videogame-section relative overflow-hidden">

  {{-- SVG squiggles interactive background --}}
  <svg id="vg-squiggles-stage"
       class="absolute inset-0 w-full h-full"
       xmlns="http://www.w3.org/2000/svg"
       style="z-index:0; pointer-events:none;"></svg>

  {{-- CRT scanlines overlay --}}
  <div class="vg-scanlines pointer-events-none absolute inset-0" style="z-index:1;"></div>

  {{-- Section content --}}
  <div class="container relative" style="z-index:2; padding-top: 6rem; padding-bottom: 6rem;">

    {{-- Top label --}}
    <div class="text-center mb-16">
      <span class="vg-label">⚔ Proyecto Especial ⚔</span>
      <h2 class="vg-title vg-animate-in" data-vg-stagger="0">
        THE DEVELOPER'S<br><span style="color:#00d4ff;">JOURNEY</span>
      </h2>
      <p class="vg-subtitle vg-animate-in" data-vg-stagger="1">
        Un Action-Platformer 2D — la gamificación de mi carrera
      </p>
    </div>

    {{-- Main grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start mb-16">

      {{-- LEFT: Story --}}
      <div class="vg-animate-in" data-vg-stagger="2">

        <h3 class="vg-heading mb-5">// El Por Qué</h3>

        <p class="vg-text mb-5">
          Desde pequeño fui un <span class="vg-highlight">amante de los juegos de pixel art</span>
          y los juegos retro. Y desde hace mucho tiempo me fascina la programación.
        </p>

        <p class="vg-text mb-5">
          Siempre tuve el sueño de crear mi propio videojuego — no por fama, sino por
          <span class="vg-highlight">entender</span>: cómo funciona un juego por dentro,
          cómo se crean los personajes, cómo se mueven, cómo interaccionan entre sí.
          Y el hecho de que pueda crear algo que otras personas puedan jugar es,
          para mí, <span class="vg-highlight">maravilloso</span>.
        </p>

        {{-- Emotional highlight quote --}}
        <blockquote class="vg-quote vg-animate-in mb-8" data-vg-stagger="3">
          Este proyecto es el inicio del camino, pero también es una
          <span class="vg-highlight">meta cumplida</span>.
          Un sueño hecho realidad de mi yo pequeño.<br><br>
          Le estoy diciendo a ese pequeño Moisés:
          <span class="vg-highlight">lo estamos logrando</span>.
          Y me siento orgulloso de eso.
        </blockquote>

        {{-- Tech stack pixel badges --}}
        <h3 class="vg-heading mt-10 mb-4">// Stack</h3>
        <div class="flex flex-wrap gap-3 mb-8">
          @php
            $vgStack = [
              ['name' => 'Phaser 3',     'icon' => '🎮', 'color' => '#00d4ff'],
              ['name' => 'Svelte',       'icon' => '🔥', 'color' => '#ff6b35'],
              ['name' => 'JavaScript',   'icon' => '⚡', 'color' => '#f7df1e'],
              ['name' => 'Photoshop',    'icon' => '🎨', 'color' => '#31a8ff'],
              ['name' => 'Tiled',        'icon' => '🗺',  'color' => '#39ff14'],
              ['name' => 'State Pattern','icon' => '🧠', 'color' => '#ff0080'],
            ];
          @endphp
          @foreach($vgStack as $tech)
            <span class="vg-badge vg-animate-in" data-vg-stagger="3"
                  style="--badge-color: {{ $tech['color'] }};">
              {{ $tech['icon'] }} {{ $tech['name'] }}
            </span>
          @endforeach
        </div>

        {{-- Game description --}}
        <h3 class="vg-heading mb-4">// Sobre el Juego</h3>
        <p class="vg-text vg-animate-in" data-vg-stagger="4">
          <span class="vg-highlight">The Developer's Journey</span> no es solo un juego de plataformas en 2D.
          Es la gamificación de mi currículum y mi carrera profesional. Construido desde cero para correr
          nativamente en el navegador usando <span class="vg-highlight">Phaser 3</span>, JavaScript y Svelte,
          este Action-Platformer te invita a explorar mis skills, enfrentar los &#39;bugs&#39; (literalmente)
          y descubrir cómo mi pasión por resolver problemas de software se traduce en código limpio y creativo.
        </p>
      </div>

      {{-- RIGHT: Real screenshots --}}
      <div class="vg-animate-in" data-vg-stagger="2">
        <h3 class="vg-heading mb-6">// En Acción</h3>

        {{-- Screenshot gallery in screen frame --}}
        <div class="vg-screen" id="vg-gallery">
          <div class="vg-screen-header">
            <span class="vg-screen-dot" style="background:#ff5f57;"></span>
            <span class="vg-screen-dot" style="background:#febc2e;"></span>
            <span class="vg-screen-dot" style="background:#28c840;"></span>
            <span class="vg-screen-title">THE DEVELOPER'S JOURNEY v1.0</span>
          </div>
          <div class="vg-screen-body vg-gallery-body">
            @php
              $screenshots = [
                ['src' => '/img/videogame/videogame_start.png',       'alt' => 'Pantalla de inicio'],
                ['src' => '/img/videogame/videogame_snow.png',         'alt' => 'Nivel de nieve'],
                ['src' => '/img/videogame/videogame_certificates.png', 'alt' => 'Pantalla de certificados'],
              ];
            @endphp
            @foreach($screenshots as $i => $shot)
              <img
                src="{{ url($shot['src']) }}"
                alt="{{ $shot['alt'] }}"
                class="vg-screenshot{{ $i === 0 ? ' vg-screenshot--active' : '' }}"
                data-index="{{ $i }}"
              />
            @endforeach
          </div>
          <div class="vg-gallery-nav">
            @foreach($screenshots as $i => $shot)
              <button
                class="vg-gallery-dot{{ $i === 0 ? ' vg-gallery-dot--active' : '' }}"
                data-target="{{ $i }}"
                aria-label="Ver captura {{ $i + 1 }}"
              ></button>
            @endforeach
          </div>
        </div>

        {{-- CTA below the gallery --}}
        <div class="text-center vg-animate-in mt-8" data-vg-stagger="6">
          <p class="vg-text mb-6" style="opacity:0.7;">¿Listo para jugar?</p>
          <a href="https://portfolio-videogame.vercel.app/"
             target="_blank"
             class="vg-cta-btn"
             rel="noopener noreferrer">
            ▶ JUGAR AHORA
          </a>
          <p class="vg-tiny-text mt-4">* Requiere teclado para jugar</p>
        </div>
      </div>

    </div>

  </div>

  {{-- Pixel art scroll indicator --}}
  <div class="vg-scroll-indicator" id="vg-scroll-indicator">
    <div class="vg-mouse-pixel"></div>
    <span class="vg-scroll-text">SCROLL</span>
  </div>

</section>
