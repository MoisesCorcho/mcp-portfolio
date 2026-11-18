{{-- ====== Portfolio V2: Contact Chamber ====== --}}
<section id="contact" class="relative">
    {{-- ── 1. Section Header Strip ── --}}
    <div class="border-b border-zinc-800 p-6 sm:p-10 lg:px-14 lg:py-8 relative">
        <p class="text-xs font-roboto-mono font-semibold tracking-[0.2em] text-amber-500 uppercase mb-2">
            {{ __('home.contact_label') }}
        </p>

        <h2 class="font-oxanium font-extrabold text-3xl sm:text-4xl lg:text-5xl uppercase tracking-tight text-white leading-tight sm:leading-tight lg:leading-[1.15]">
            {{ __('home.contact_heading') }}
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-amber-500 to-orange-500 inline-block py-1 sm:py-1.5 box-decoration-clone">
                {{ __('home.contact_heading_accent') }}
            </span>
        </h2>

        {{-- Amber Accent Ruler --}}
        <div class="flex items-center gap-2 mt-4 mb-3">
            <span class="h-[2px] w-20 bg-amber-500"></span>
            <span class="h-[2px] w-2.5 bg-amber-500/40"></span>
        </div>

        <p class="text-slate-400 font-roboto-mono text-xs sm:text-sm max-w-2xl leading-relaxed">
            {{ __('home.contact_subtitle') }}
        </p>
    </div>

    {{-- ── 2. Contact Grid (2 Columns with 1px Vertical Divider) ── --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 divide-y lg:divide-y-0 lg:divide-x divide-zinc-800 relative">

        {{-- Center Column Intersection Pins on Desktop (5/12 = 41.666%) --}}
        <span class="hidden lg:block absolute -top-1.5 left-[41.666667%] -translate-x-1.5 w-3 h-3 bg-amber-500 z-20 border border-black pointer-events-none" aria-hidden="true"></span>
        <span class="hidden lg:block absolute -bottom-1.5 left-[41.666667%] -translate-x-1.5 w-3 h-3 bg-amber-500 z-20 border border-black pointer-events-none" aria-hidden="true"></span>

        {{-- ── LEFT: Direct Channels & Information (5 Cols) ── --}}
        <div class="lg:col-span-5 p-6 sm:p-10 lg:p-12 flex flex-col justify-between bg-chamber/40">
            <div>
                <h3 class="font-oxanium font-bold text-xl text-white uppercase tracking-tight mb-3">
                    {{ __('home.contact_left_heading') }}
                </h3>

                <p class="font-roboto-mono text-xs sm:text-sm text-slate-400 leading-relaxed mb-8">
                    {{ __('home.contact_left_text') }}
                </p>

                {{-- Direct Channels List in Orthogonal CAD Cells --}}
                <div class="space-y-4">
                    {{-- Email --}}
                    <a
                        href="mailto:{{ config('portfolio.owner.email') }}"
                        class="p-4 border border-zinc-800 bg-card hover:border-amber-500/80 transition-colors flex items-center gap-4 group"
                    >
                        <div class="w-10 h-10 border border-zinc-700 bg-zinc-900 flex items-center justify-center text-amber-400 group-hover:border-amber-500 transition-colors flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="1.8" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="overflow-hidden">
                            <span class="block text-[10px] font-roboto-mono uppercase text-zinc-500 tracking-wider">
                                {{ __('home.contact_email_label') }}
                            </span>
                            <span class="block text-xs sm:text-sm font-roboto-mono text-zinc-200 group-hover:text-amber-400 transition-colors truncate">
                                {{ config('portfolio.owner.email') }}
                            </span>
                        </div>
                    </a>

                    {{-- Location --}}
                    <div class="p-4 border border-zinc-800 bg-card flex items-center gap-4">
                        <div class="w-10 h-10 border border-zinc-700 bg-zinc-900 flex items-center justify-center text-amber-400 flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="1.8" d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="block text-[10px] font-roboto-mono uppercase text-zinc-500 tracking-wider">
                                {{ __('home.contact_location_label') }}
                            </span>
                            <span class="block text-xs sm:text-sm font-roboto-mono text-zinc-200">
                                {{ __('home.contact_location_value') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Social Matrix --}}
            <div class="pt-8 border-t border-zinc-800/80 mt-8">
                <span class="block text-[11px] font-roboto-mono uppercase text-zinc-500 tracking-wider mb-3">
                    {{ __('home.contact_social_label') }}
                </span>
                <div class="flex items-center gap-2">
                    <a href="{{ config('portfolio.owner.github') }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 border border-zinc-800 bg-zinc-900/80 hover:border-amber-500 hover:text-amber-400 text-zinc-400 flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 0C5.374 0 0 5.373 0 12c0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23A11.509 11.509 0 0112 5.803c1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12c0-6.627-5.373-12-12-12z"/></svg>
                    </a>
                    <a href="{{ config('portfolio.owner.linkedin') }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 border border-zinc-800 bg-zinc-900/80 hover:border-amber-500 hover:text-amber-400 text-zinc-400 flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    <a href="{{ config('portfolio.owner.instagram') }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 border border-zinc-800 bg-zinc-900/80 hover:border-amber-500 hover:text-amber-400 text-zinc-400 flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 48 48"><path d="M 16.5 5 C 10.16639 5 5 10.16639 5 16.5 L 5 31.5 C 5 37.832757 10.166209 43 16.5 43 L 31.5 43 C 37.832938 43 43 37.832938 43 31.5 L 43 16.5 C 43 10.166209 37.832757 5 31.5 5 L 16.5 5 z M 16.5 8 L 31.5 8 C 36.211243 8 40 11.787791 40 16.5 L 40 31.5 C 40 36.211062 36.211062 40 31.5 40 L 16.5 40 C 11.787791 40 8 36.211243 8 31.5 L 8 16.5 C 8 11.78761 11.78761 8 16.5 8 z M 34 12 C 32.895 12 32 12.895 32 14 C 32 15.105 32.895 16 34 16 C 35.105 16 36 15.105 36 14 C 36 12.895 35.105 12 34 12 z M 24 14 C 18.495178 14 14 18.495178 14 24 C 14 29.504822 18.495178 34 24 34 C 29.504822 34 34 29.504822 34 24 C 34 18.495178 29.504822 14 24 14 z M 24 17 C 27.883178 17 31 20.116822 31 24 C 31 27.883178 27.883178 31 24 31 C 20.116822 31 17 27.883178 17 24 C 17 20.116822 20.116822 17 24 17 z"/></svg>
                    </a>
                </div>
            </div>
        </div>

        {{-- ── RIGHT: Direct Architectural Form (7 Cols) ── --}}
        <div class="lg:col-span-7 p-6 sm:p-10 lg:p-12 bg-zinc-950/50">
            <div
                x-data="{
                    formData: { name: '', email: '', body: '' },
                    errors: {},
                    loading: false,
                    successMessage: '',
                    submitForm() {
                        this.loading = true;
                        this.errors = {};
                        this.successMessage = '';

                        fetch('/contact/submit', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify(this.formData)
                        })
                        .then(response => {
                            if (response.status === 200) return response.json();
                            throw response;
                        })
                        .then(() => {
                            this.formData = { name: '', email: '', body: '' };
                            this.successMessage = @js(__('home.contact_success'));
                        })
                        .catch(async response => {
                            if (response.status === 422) {
                                const res = await response.json();
                                this.errors = res.errors;
                            }
                        })
                        .finally(() => { this.loading = false; });
                    }
                }"
            >
                {{-- Success Toast Notification --}}
                <template x-if="successMessage">
                    <div class="mb-6 p-4 border border-emerald-500/40 bg-emerald-500/10 text-emerald-400 font-roboto-mono text-xs flex items-center gap-2">
                        <span class="w-2 h-2 bg-emerald-400 animate-pulse"></span>
                        <span x-text="successMessage"></span>
                    </div>
                </template>

                <form x-on:submit.prevent="submitForm" class="space-y-6">
                    @csrf

                    {{-- Name Field --}}
                    <div>
                        <label for="v2-contact-name" class="block font-roboto-mono text-xs font-semibold uppercase tracking-wider text-zinc-300 mb-2">
                            {{ __('home.contact_name_label') }}
                        </label>
                        <input
                            id="v2-contact-name"
                            type="text"
                            name="name"
                            x-model="formData.name"
                            placeholder="{{ __('home.contact_name_placeholder') }}"
                            class="w-full px-4 py-3 bg-card border border-zinc-800 text-zinc-200 font-roboto-mono text-xs sm:text-sm focus:border-amber-500 focus:outline-none transition-colors"
                            :class="errors.name && 'border-red-500'"
                            required
                        />
                        <template x-if="errors.name">
                            <p x-text="errors.name[0]" class="mt-1 font-roboto-mono text-[11px] text-red-400"></p>
                        </template>
                    </div>

                    {{-- Email Field --}}
                    <div>
                        <label for="v2-contact-email" class="block font-roboto-mono text-xs font-semibold uppercase tracking-wider text-zinc-300 mb-2">
                            {{ __('home.contact_email_field_label') }}
                        </label>
                        <input
                            id="v2-contact-email"
                            type="email"
                            name="email"
                            x-model="formData.email"
                            placeholder="{{ __('home.contact_email_placeholder') }}"
                            class="w-full px-4 py-3 bg-card border border-zinc-800 text-zinc-200 font-roboto-mono text-xs sm:text-sm focus:border-amber-500 focus:outline-none transition-colors"
                            :class="errors.email && 'border-red-500'"
                            required
                        />
                        <template x-if="errors.email">
                            <p x-text="errors.email[0]" class="mt-1 font-roboto-mono text-[11px] text-red-400"></p>
                        </template>
                    </div>

                    {{-- Message Field --}}
                    <div>
                        <label for="v2-contact-body" class="block font-roboto-mono text-xs font-semibold uppercase tracking-wider text-zinc-300 mb-2">
                            {{ __('home.contact_message_label') }}
                        </label>
                        <textarea
                            id="v2-contact-body"
                            name="body"
                            x-model="formData.body"
                            rows="5"
                            placeholder="{{ __('home.contact_message_placeholder') }}"
                            class="w-full px-4 py-3 bg-card border border-zinc-800 text-zinc-200 font-roboto-mono text-xs sm:text-sm focus:border-amber-500 focus:outline-none transition-colors resize-y"
                            :class="errors.body && 'border-red-500'"
                            required
                        ></textarea>
                        <template x-if="errors.body">
                            <p x-text="errors.body[0]" class="mt-1 font-roboto-mono text-[11px] text-red-400"></p>
                        </template>
                    </div>

                    {{-- Submit Button --}}
                    <div>
                        <button
                            type="submit"
                            :disabled="loading"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 bg-amber-500 hover:bg-amber-400 disabled:opacity-50 text-black font-roboto-mono font-bold text-xs uppercase tracking-wider transition-all duration-200 border border-amber-300 shadow-[0_0_20px_rgba(245,158,11,0.25)]"
                        >
                            <span x-show="!loading">{{ __('home.contact_submit_btn') }}</span>
                            <span x-show="loading" style="display: none;">{{ __('home.contact_sending') }}</span>
                            <svg x-show="!loading" class="w-4 h-4 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="square" stroke-linejoin="miter" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</section>
