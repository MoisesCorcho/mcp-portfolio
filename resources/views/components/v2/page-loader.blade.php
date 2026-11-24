{{-- ====== Portfolio V2: Cyber-Industrial System Loader ====== --}}
<div
    x-data="{
        loaded: false,
        dismissed: false,
        init() {
            const dismiss = () => {
                if (this.loaded) return;
                this.loaded = true;
                setTimeout(() => { this.dismissed = true; }, 400);
            };

            if (document.readyState === 'complete') {
                setTimeout(dismiss, 100);
            } else {
                window.addEventListener('load', dismiss, { once: true });
            }

            // Safety fallback: dismiss after 2.2s even if external resources are slow
            setTimeout(dismiss, 2200);
        }
    }"
    x-show="!dismissed"
    x-transition:leave="transition-opacity ease-out duration-400"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 pointer-events-none"
    class="fixed inset-0 z-[100] flex flex-col items-center justify-center bg-canvas select-none"
    aria-hidden="true"
>
    <div class="relative flex flex-col items-center justify-center">
        {{-- Animated Cat Brand Logo with Wagging Tail --}}
        <div class="w-28 h-28 sm:w-36 sm:h-36 flex items-center justify-center">
            <x-v2.brand-logo 
                :animated="true" 
                class="w-full h-full text-white drop-shadow-[0_0_25px_rgba(245,158,11,0.35)]" 
            />
        </div>
    </div>
</div>
