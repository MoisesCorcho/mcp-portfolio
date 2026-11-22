{{-- ====== Portfolio V2 Credentials: Formal University Degree & Diploma ====== --}}
<div class="lg:col-span-5 p-6 sm:p-8 lg:p-10 flex flex-col justify-between bg-chamber/40">
    <div>
        <div class="flex items-center gap-2 mb-6">
            <span class="w-2 h-2 bg-amber-500"></span>
            <h3 class="font-oxanium font-bold text-base text-zinc-200 uppercase tracking-wider">
                {{ __('home.credentials_tab_education') }}
            </h3>
        </div>

        <div class="space-y-6">
            @foreach(config('portfolio.education', []) as $edu)
                <x-v2.extruded-box variant="card" depth="sm" :cad-pins="true" class="p-5 sm:p-6 block">
                    <span class="inline-block px-2 py-0.5 border border-zinc-800 bg-zinc-900/80 text-[10px] font-roboto-mono text-amber-400 font-semibold uppercase tracking-wider mb-2">
                        {{ $edu['type'] }}
                    </span>

                    <h4 class="font-oxanium font-extrabold text-lg sm:text-xl text-white uppercase tracking-tight mb-1">
                        {{ __($edu['degree_key']) }}
                    </h4>

                    <p class="font-roboto-mono text-xs sm:text-sm text-slate-300 mb-2">
                        {{ __($edu['institution_key']) }}
                    </p>

                    <div class="flex items-center justify-between text-[11px] font-roboto-mono text-zinc-500 pt-2 border-t border-zinc-800/80">
                        <span>{{ __($edu['period_key']) }}</span>
                        <span>{{ $edu['location'] }}</span>
                    </div>
                </x-v2.extruded-box>
            @endforeach
        </div>
    </div>

    {{-- Academic Seal Info Note --}}
    <div class="mt-8 pt-4 border-t border-zinc-800/80 text-[11px] font-roboto-mono text-zinc-500 flex items-center gap-2">
        <span class="text-amber-500">✔</span>
        <span>Título universitario oficial convalidado y habilitado para ejercicio profesional.</span>
    </div>
</div>
