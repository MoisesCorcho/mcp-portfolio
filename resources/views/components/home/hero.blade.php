<!-- ====== Hero Section Start -->
<div class="relative pt-[60px] lg:pt-[80px] pb-[110px] bg-white dark:bg-slate-900">
    <div class="container">
        <div class="flex flex-wrap -mx-4">
            <div class="w-full lg:w-5/12 px-4">
                <div class="hero-content">
                    <h1
                        class="text-dark dark:text-slate-200 font-bold text-4xl sm:text-[42px] lg:text-[40px] xl:text-[42px] leading-snug mb-6">
                        {{ __('Mi nombre es') }} <br />
                        <span class="rounded-md text-amber-600">Moisés Corcho Pérez</span>.
                    </h1>
                    <p class="text-base mb-8 max-w-[520px] dark:text-slate-200">
                        Soy un desarrollador web enfocado en backend con 4 años de experiencia formado tanto en entornos
                        académicos como empresariales. Mi enfoque en <span class="text-amber-500 font-bold">PHP</span> y
                        <span class="text-amber-500 font-bold">Laravel</span> se ha fortalecido a través de proyectos
                        reales y personales. Mi pasión por el aprendizaje y la resolución lógica de problemas se combina
                        con habilidades de empatía y escucha activa, fortaleciendo la colaboración en situaciones
                        laborales desaﬁantes.
                    <ul class="flex flex-wrap items-center">
                        <li>
                            <x-button-link href="#portfolio" variant="primary" class="rounded-lg">
                                Mis proyectos
                            </x-button-link>
                        </li>
                    </ul>
                    <div class="clients pt-16">
                        <h6 class="font-normal text-xs flex items-center text-body-color dark:text-slate-300 mb-4">
                            Mis redes sociales
                            <span class="w-8 h-[1px] bg-body-color inline-block ml-2"></span>
                        </h6>
                        <x-social-icons></x-social-icons>
                    </div>
                </div>
            </div>
            <div class="hidden lg:block lg:w-1/12 px-4"></div>
            <div class="w-full lg:w-6/12 px-4">
                <div class="lg:text-right lg:ml-auto">
                    <div class="relative inline-block z-10 pt-11 lg:pt-0">
                        <img src="{{ url('/img/moises-1.jpg') }}" alt="hero" class="max-w-full lg:ml-auto" />
                        <span class="absolute -left-8 -bottom-8 z-[-1]">
                            <svg width="93" height="93" viewBox="0 0 93 93" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <circle cx="2.5" cy="2.5" r="2.5" fill="#3056D3" />
                                <circle cx="2.5" cy="24.5" r="2.5" fill="#3056D3" />
                                <circle cx="2.5" cy="46.5" r="2.5" fill="#3056D3" />
                                <circle cx="2.5" cy="68.5" r="2.5" fill="#3056D3" />
                                <circle cx="2.5" cy="90.5" r="2.5" fill="#3056D3" />
                                <circle cx="24.5" cy="2.5" r="2.5" fill="#3056D3" />
                                <circle cx="24.5" cy="24.5" r="2.5" fill="#3056D3" />
                                <circle cx="24.5" cy="46.5" r="2.5" fill="#3056D3" />
                                <circle cx="24.5" cy="68.5" r="2.5" fill="#3056D3" />
                                <circle cx="24.5" cy="90.5" r="2.5" fill="#3056D3" />
                                <circle cx="46.5" cy="2.5" r="2.5" fill="#3056D3" />
                                <circle cx="46.5" cy="24.5" r="2.5" fill="#3056D3" />
                                <circle cx="46.5" cy="46.5" r="2.5" fill="#3056D3" />
                                <circle cx="46.5" cy="68.5" r="2.5" fill="#3056D3" />
                                <circle cx="46.5" cy="90.5" r="2.5" fill="#3056D3" />
                                <circle cx="68.5" cy="2.5" r="2.5" fill="#3056D3" />
                                <circle cx="68.5" cy="24.5" r="2.5" fill="#3056D3" />
                                <circle cx="68.5" cy="46.5" r="2.5" fill="#3056D3" />
                                <circle cx="68.5" cy="68.5" r="2.5" fill="#3056D3" />
                                <circle cx="68.5" cy="90.5" r="2.5" fill="#3056D3" />
                                <circle cx="90.5" cy="2.5" r="2.5" fill="#3056D3" />
                                <circle cx="90.5" cy="24.5" r="2.5" fill="#3056D3" />
                                <circle cx="90.5" cy="46.5" r="2.5" fill="#3056D3" />
                                <circle cx="90.5" cy="68.5" r="2.5" fill="#3056D3" />
                                <circle cx="90.5" cy="90.5" r="2.5" fill="#3056D3" />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ====== Hero Section End -->
