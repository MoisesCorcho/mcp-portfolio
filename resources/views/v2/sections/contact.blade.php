{{-- ====== Portfolio V2: Contact Chamber ====== --}}
<section id="contact" class="relative v2-chamber-contain">
    {{-- ── 1. Section Header Strip ── --}}
    <x-v2.section-header
        :label="__('home.contact_label')"
        :title="__('home.contact_heading')"
        :accent="__('home.contact_heading_accent')"
        :subtitle="__('home.contact_subtitle')"
    />

    {{-- ── 2. Contact Grid (2 Columns with 1px Vertical Divider) ── --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 divide-y lg:divide-y-0 lg:divide-x divide-zinc-800 relative">

        {{-- Center Column Intersection Pins on Desktop (5/12 = 41.666%) --}}
        <x-v2.cad-pin class="hidden lg:block absolute -top-1.5 left-[41.666667%] -translate-x-1.5" />
        <x-v2.cad-pin class="hidden lg:block absolute -bottom-1.5 left-[41.666667%] -translate-x-1.5" />

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
                    {{-- Email with Direct Link and Quick-Copy Action --}}
                    <div
                        x-data="{ copied: false }"
                        class="p-4 border border-zinc-800 bg-card hover:border-amber-500/80 transition-colors flex items-center justify-between gap-3 group"
                    >
                        <a
                            href="mailto:{{ config('portfolio.owner.email') }}"
                            class="flex items-center gap-4 overflow-hidden flex-1"
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

                        <x-v2.extruded-box
                            as="button"
                            type="button"
                            variant="zinc"
                            depth="sm"
                            @click="navigator.clipboard.writeText('{{ config('portfolio.owner.email') }}'); copied = true; setTimeout(() => copied = false, 2000)"
                            class="px-2.5 py-1.5 hover:border-amber-500 hover:text-amber-400 text-zinc-400 text-[10px] font-roboto-mono uppercase tracking-wider flex items-center gap-1.5 flex-shrink-0"
                            x-bind:title="copied ? '{{ __('home.contact_copied') }}' : '{{ __('home.contact_copy') }}'"
                        >
                            <span x-show="!copied">{{ __('home.contact_copy') }}</span>
                            <span x-show="copied" style="display: none;" class="text-amber-400 font-bold flex items-center gap-1">
                                <span class="text-amber-500">✓</span> {{ __('home.contact_copied') }}
                            </span>
                        </x-v2.extruded-box>
                    </div>

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
                <x-v2.social-links />
            </div>
        </div>

        {{-- ── RIGHT: Direct Architectural Form (7 Cols) ── --}}
        <x-v2.contact.form />

    </div>
</section>
