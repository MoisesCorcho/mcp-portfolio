<div class="about-images-grid flex flex-col gap-4 max-w-[420px] mx-auto w-full">
    {{-- Photo 1: Piano & Music --}}
    <div class="about-img-item relative border border-zinc-700/80 bg-card p-2 shadow-[0_15px_35px_rgba(0,0,0,0.5)]">
        <x-v2.cad-corners />

        <div class="relative overflow-hidden border border-zinc-800 aspect-[16/9]">
            <img
                src="{{ url('/img/MoisesPiano.jpeg') }}"
                alt="{{ __('home.about_img_1_alt') }}"
                class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                loading="lazy"
                decoding="async"
                width="400"
                height="225"
            />
        </div>
    </div>

    {{-- Photos 2 & 3: Companion Pets (2-Column Grid) --}}
    <div class="grid grid-cols-2 gap-4">
        {{-- Pet at PC --}}
        <div class="about-img-item relative border border-zinc-700/80 bg-card p-2 shadow-[0_10px_25px_rgba(0,0,0,0.4)]">
            <x-v2.cad-corners size="text-[9px]" />

            <div class="relative overflow-hidden border border-zinc-800 aspect-square">
                <img
                    src="{{ url('/img/GataMascotaPc.jpeg') }}"
                    alt="{{ __('home.about_img_2_alt') }}"
                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                    loading="lazy"
                    decoding="async"
                    width="200"
                    height="200"
                />
            </div>
        </div>

        {{-- Companion Cat --}}
        <div class="about-img-item relative border border-zinc-700/80 bg-card p-2 shadow-[0_10px_25px_rgba(0,0,0,0.4)]">
            <x-v2.cad-corners size="text-[9px]" />

            <div class="relative overflow-hidden border border-zinc-800 aspect-square">
                <img
                    src="{{ url('/img/GataMascota.jpeg') }}"
                    alt="{{ __('home.about_img_3_alt') }}"
                    class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                    loading="lazy"
                    decoding="async"
                    width="200"
                    height="200"
                />
            </div>
        </div>
    </div>
</div>
