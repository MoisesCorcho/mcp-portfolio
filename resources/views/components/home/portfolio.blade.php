<!-- ====== Portfolio Section Start -->
<section
  id="portfolio"
  x-data="
        {
          selectedTab: 'all',
          activeClasses: 'bg-primary text-white',
          inactiveClasses: 'text-body-color hover:bg-primary hover:text-white',
        }
      "
  class="dark:bg-slate-900 pt-20 lg:pt-[120px] pb-12 lg:pb-[90px]"
>
  <div class="container">
    <div class="flex flex-wrap -mx-4">
      <div class="w-full px-4">
        <div class="text-center mx-auto mb-[60px] max-w-[510px]">
          <h2 class="font-bold text-3xl sm:text-4xl md:text-[40px] text-dark dark:text-slate-300 mb-4">
            Mis proyectos recientes
          </h2>
          <p class="text-base text-body-color">
            La mejor manera de aprender a programar es creando proyectos.
          </p>
        </div>
      </div>
    </div>
    <div class="flex flex-wrap justify-center -mx-4">
      <div class="w-full px-4">
        <ul class="flex flex-wrap justify-center mb-12 space-x-1">
          <li class="mb-1">
            <button
              @click="selectedTab = 'all' "
              :class="selectedTab == 'all' ? activeClasses : inactiveClasses "
              class="inline-block py-2 md:py-3 px-5 lg:px-8 rounded-lg text-base font-semibold text-center transition "
            >
              Todos Los Proyectos
            </button>
          </li>
          @foreach($tabs as $tab)
          <li class="mb-1">
            <button
              @click="selectedTab = '{{$tab}}' "
              :class="selectedTab === '{{$tab}}' ? activeClasses : inactiveClasses "
              class="inline-block py-2 md:py-3 px-5 lg:px-8 rounded-lg text-base font-semibold text-center transition ">
              {{$tab}}
            </button>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
    <div class="flex flex-wrap -mx-4">
      @foreach ($items as $item)
        <x-portfolio-item
            :title="$item->title"
            :categories="$item->categories->pluck('name')->toArray()"
            :image="$item->image"
            :github="$item->github ?? '#'">
        </x-portfolio-item>
      @endforeach
    </div>
  </div>
</section>
<!-- ====== Portfolio Section End -->
