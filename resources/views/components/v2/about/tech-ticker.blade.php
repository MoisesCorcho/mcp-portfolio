{{-- Cycling dynamic tech ticker in clean monospace container --}}
<div
    x-data="{
        index: 0,
        skills: {{ json_encode(config('portfolio.skills.cycling', [])) }},
        timer: null,
        start() {
            if (this.timer) return;
            this.timer = setInterval(() => {
                if (!document.hidden) {
                    this.index = (this.index + 1) % this.skills.length;
                }
            }, 2200);
        },
        init() {
            this.start();
            document.addEventListener('visibilitychange', () => {
                if (document.hidden) {
                    clearInterval(this.timer);
                    this.timer = null;
                } else {
                    this.start();
                }
            });
        }
    }"
    class="border border-zinc-800 bg-card p-3.5 flex items-center shadow-sm"
>
    <div class="flex items-center flex-wrap gap-x-2.5 gap-y-1 w-full">
        <span class="text-zinc-400 font-roboto-mono text-xs sm:text-sm uppercase tracking-wider whitespace-nowrap">
            {{ __('home.about_stack_prefix') }}
        </span>
        <span class="text-amber-500 font-mono font-bold text-2xl sm:text-3xl select-none leading-none" aria-hidden="true">[</span>

        {{-- Centered Clipping Window for Active Skill --}}
        <div class="h-9 sm:h-11 min-w-[130px] sm:min-w-[180px] overflow-hidden relative flex items-center">
            <template x-for="(skill, i) in skills" :key="i">
                <span
                    x-show="index === i"
                    x-transition:enter="transition ease-out duration-300 transform"
                    x-transition:enter-start="opacity-0 translate-y-3"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200 transform absolute"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 -translate-y-3"
                    class="font-oxanium font-extrabold text-xl sm:text-2xl text-amber-400 tracking-tight whitespace-nowrap"
                    x-text="skill"
                ></span>
            </template>
        </div>

        <span class="text-amber-500 font-mono font-bold text-2xl sm:text-3xl select-none leading-none" aria-hidden="true">]</span>
    </div>
</div>
