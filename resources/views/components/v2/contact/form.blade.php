{{-- ====== Portfolio V2 Contact: Interactive Architectural AJAX Form ====== --}}
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
                <x-v2.extruded-box
                    as="button"
                    type="submit"
                    x-bind:disabled="loading"
                    variant="amber"
                    depth="md"
                    :glow="true"
                    class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 disabled:opacity-50 font-roboto-mono font-bold text-xs uppercase tracking-wider"
                >
                    <span x-show="!loading">{{ __('home.contact_submit_btn') }}</span>
                    <span x-show="loading" style="display: none;">{{ __('home.contact_sending') }}</span>
                    <svg x-show="!loading" class="w-4 h-4 stroke-[2.5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="square" stroke-linejoin="miter" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </x-v2.extruded-box>
            </div>
        </form>
    </div>
</div>
