<!-- ====== About Section Start -->
<section id="about" class="dark:bg-slate-800 pt-20 lg:pt-[120px] pb-12 lg:pb-[90px] overflow-hidden">
    <div class="container">
        <div class="flex flex-wrap justify-between items-center -mx-4">
            <div class="w-full lg:w-6/12 px-4">
                <div class="flex items-center -mx-3 sm:-mx-4">
                    <div class="w-full xl:w-1/2 px-3 sm:px-4">
                        <div class="py-3 sm:py-4">
                            <img src="{{ url('/img/MoisesPiano.jpeg') }}" alt="" class="rounded-2xl w-full" />
                        </div>
                        <div class="py-3 sm:py-4">
                            <img src="{{ url('/img/GataMascotaPc.jpeg') }}" alt="" class="rounded-2xl w-full" />
                        </div>
                    </div>
                    <div class="w-full xl:w-1/2 px-3 sm:px-4">
                        <div class="my-4 relative z-10">
                            <img src="{{ url('/img/GataMascota.jpeg') }}" alt="" class="rounded-2xl w-full" />
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
                        {{ __('Acerca de mi') }}
                    </h2>
                    <p class="text-base dark:text-slate-400 mb-6">
                        Mi formación como Ingeniero de Sistemas, culminada con honores, me ha dotado de una aguda
                        capacidad para el análisis y la resolución lógica de problemas. El conocimiento que he adquirido
                        en todo estos años permite construir soluciones robustas y eficientes. Consciente del valor del
                        trabajo en equipo, mi naturaleza comprensiva y mi habilidad para escuchar activamente
                        contribuyen a una dinámica colaborativa positiva y productiva.
                    </p>

                    <p class="text-base dark:text-slate-400 mb-6">
                        Cuando no estoy inmerso en el mundo de la programación, probablemente esté
                        compartiendo mimos con mis gatos o dejándome llevar por la música escuchándola o tocándola.
                        Estas pasiones, aunque personales, son parte de lo que me motiva y me aporta una perspectiva
                        única a la hora de colaborar y resolver problemas.
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
