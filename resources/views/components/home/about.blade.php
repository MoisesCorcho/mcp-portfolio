<!-- ====== About Section Start -->
<section id="about" class="dark:bg-slate-800 pt-20 lg:pt-[120px] pb-12 lg:pb-[90px] overflow-hidden">
  <div class="container">
    <div class="flex flex-wrap justify-between items-center -mx-4">
      <div class="w-full lg:w-6/12 px-4">
        <div class="flex items-center -mx-3 sm:-mx-4">
          <div class="w-full xl:w-1/2 px-3 sm:px-4">
            <div class="py-3 sm:py-4">
              <img
                src="{{ url('/img/gohanTorneo.jpeg') }}"
                alt=""
                class="rounded-2xl w-full"
              />
            </div>
            <div class="py-3 sm:py-4">
              <img
                src="{{ url('/img/gohan2.JPG') }}"
                alt=""
                class="rounded-2xl w-full"
              />
            </div>
          </div>
          <div class="w-full xl:w-1/2 px-3 sm:px-4">
            <div class="my-4 relative z-10">
              <img
                src="{{ url('/img/AdultSonGohan.jpg') }}"
                alt=""
                class="rounded-2xl w-full"
              />
              <x-about-dots></x-about-dots>
            </div>
          </div>
        </div>
      </div>
      <div class="w-full lg:w-1/2 xl:w-5/12 px-4">
        <div class="mt-10 lg:mt-0">
          <span class="font-semibold text-lg text-primary mb-2 block">
             <blockquote class="text-sm text-gray-500 italic py-2 px-3 border-l-4 border-amber-500">
                 "Not everything is achievable with hard work, but... It helps a lot"
             </blockquote>
          </span>
          <h2 class="font-bold text-3xl sm:text-4xl dark:text-slate-200 mb-8">
            {{__('Acerca de mi')}}
          </h2>
          <p class="text-base dark:text-slate-400 mb-8">
            Soy un desarrollador web enfocado en backend con 4 años de experiencia formado tanto en entornos académicos como empresariales. Mi enfoque en <span class="text-amber-500 font-bold">PHP</span> y <span class="text-amber-500 font-bold">Laravel</span> se ha fortalecido a través de proyectos reales y personales. Mi pasión por el aprendizaje y la resolución lógica de problemas se combina con habilidades de empatía y escucha activa, fortaleciendo la colaboración en situaciones laborales desaﬁantes.
          </p>

          <x-button-link href="" variant="black" target="_blank">
            Mira mi Github
          </x-button-link>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- ====== About Section End -->
