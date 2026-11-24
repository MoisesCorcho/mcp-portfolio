<div
    x-data="ragAssistant()"
    @open-rag-drawer.window="openDrawer()"
    x-cloak
    class="relative z-50"
>
    {{-- Floating Action Trigger (Bottom-Right HUD node) --}}
    <div
        x-show="!isOpen"
        x-transition:enter="transition-opacity ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed bottom-6 right-6 z-40 print:hidden"
    >
        <x-v2.extruded-box
            as="button"
            type="button"
            @click="openDrawer()"
            variant="zinc"
            depth="sm"
            :glow="true"
            class="group flex items-center gap-3 px-4 py-3 bg-chamber/95 border-amber-500/40 text-amber-400 hover:border-amber-400 shadow-2xl transition-all duration-200 font-roboto-mono text-xs font-bold uppercase tracking-wider select-none cursor-pointer"
            title="{{ __('home.rag_drawer_title') }}"
            aria-label="{{ __('home.rag_drawer_title') }}"
        >
            <span class="relative flex h-2.5 w-2.5">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
            </span>
            <span class="hidden sm:inline text-zinc-200 group-hover:text-amber-400 transition-colors">AI ADVISOR</span>
            <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
            </svg>
        </x-v2.extruded-box>
    </div>

    {{-- Backdrop Overlay --}}
    <div
        x-show="isOpen"
        x-transition:enter="transition-opacity ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="closeDrawer()"
        class="fixed inset-0 bg-black/75 backdrop-blur-sm"
        aria-hidden="true"
    ></div>

    {{-- Cyber-Industrial HUD Drawer Panel --}}
    <aside
        x-show="isOpen"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="translate-x-full"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200 transform"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        @keydown.escape.window="closeDrawer()"
        class="fixed top-0 right-0 h-full w-full max-w-xl bg-chamber border-l border-zinc-800 shadow-2xl flex flex-col font-roboto-mono text-zinc-300 overflow-hidden"
        role="dialog"
        aria-modal="true"
        aria-labelledby="rag-drawer-title"
    >
        {{-- CAD Reticle Corner Pins --}}
        <x-v2.cad-pin class="absolute top-2 left-2" />
        <x-v2.cad-pin class="absolute bottom-2 left-2" />

        {{-- ── Drawer Header ── --}}
        <header class="p-4 sm:p-5 border-b border-zinc-800 bg-canvas/80 backdrop-blur-md flex items-center justify-between shrink-0">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 border border-amber-500/40 bg-amber-500/10 flex items-center justify-center text-amber-500 shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span class="text-[10px] uppercase font-bold text-emerald-400 tracking-widest">{{ __('home.rag_drawer_badge') }}</span>
                    </div>
                    <h2 id="rag-drawer-title" class="font-oxanium font-bold text-sm sm:text-base text-zinc-100 uppercase tracking-wider">
                        {{ __('home.rag_drawer_title') }}
                    </h2>
                </div>
            </div>

            <div class="flex items-center gap-2">
                {{-- Voice Mode Toggle Button --}}
                <button
                    type="button"
                    @click="toggleVoice()"
                    class="h-8 px-2.5 border text-xs font-bold uppercase transition-all duration-150 flex items-center gap-1.5 cursor-pointer"
                    :class="voiceEnabled ? 'border-amber-500 bg-amber-500/20 text-amber-300' : 'border-zinc-800 bg-zinc-900/60 text-zinc-400 hover:text-zinc-200'"
                    :title="voiceEnabled ? 'Voz activada (Haga clic para silenciar)' : 'Voz desactivada (Haga clic para activar síntesis de voz)'"
                >
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 003-3V5a3 3 0 10-6 0v6a3 3 0 003 3z" />
                    </svg>
                    <span class="text-[10px] hidden sm:inline" x-text="voiceEnabled ? 'VOZ: ON' : 'VOZ: OFF'"></span>
                </button>

                {{-- Close Drawer Button --}}
                <button
                    type="button"
                    @click="closeDrawer()"
                    class="w-8 h-8 border border-zinc-800 bg-zinc-900/60 text-zinc-400 hover:text-amber-400 hover:border-amber-500 transition-colors flex items-center justify-center cursor-pointer"
                    aria-label="Cerrar panel"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </header>

        {{-- ── Chat Conversation Body ── --}}
        <div
            x-ref="messageList"
            class="flex-1 overflow-y-auto p-4 sm:p-5 space-y-4 text-xs scroll-smooth"
        >
            {{-- Initial Welcome & Suggestions Box --}}
            <template x-if="messages.length === 0">
                <div class="space-y-4">
                    <div class="p-4 border border-zinc-800 bg-zinc-900/40 relative">
                        <div class="flex items-center gap-2 text-amber-500 mb-2 font-bold uppercase tracking-wider text-[11px]">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>{{ __('home.rag_welcome_title') }}</span>
                        </div>
                        <p class="text-zinc-400 leading-relaxed text-xs">
                            {{ __('home.rag_welcome_desc') }}
                        </p>
                    </div>

                    <div class="space-y-2">
                        <span class="text-[10px] font-bold uppercase tracking-widest text-zinc-500">Preguntas sugeridas:</span>
                        <div class="grid grid-cols-1 gap-2">
                            <button
                                type="button"
                                @click="askPreset('{{ __('home.rag_suggestion_1') }}')"
                                class="w-full text-left p-2.5 border border-zinc-800 bg-zinc-900/60 hover:border-amber-500 hover:bg-amber-500/10 text-zinc-300 hover:text-amber-300 transition-colors text-xs flex items-center justify-between group cursor-pointer"
                            >
                                <span>{{ __('home.rag_suggestion_1') }}</span>
                                <span class="text-amber-500 opacity-0 group-hover:opacity-100 transition-opacity">→</span>
                            </button>
                            <button
                                type="button"
                                @click="askPreset('{{ __('home.rag_suggestion_2') }}')"
                                class="w-full text-left p-2.5 border border-zinc-800 bg-zinc-900/60 hover:border-amber-500 hover:bg-amber-500/10 text-zinc-300 hover:text-amber-300 transition-colors text-xs flex items-center justify-between group cursor-pointer"
                            >
                                <span>{{ __('home.rag_suggestion_2') }}</span>
                                <span class="text-amber-500 opacity-0 group-hover:opacity-100 transition-opacity">→</span>
                            </button>
                            <button
                                type="button"
                                @click="askPreset('{{ __('home.rag_suggestion_3') }}')"
                                class="w-full text-left p-2.5 border border-zinc-800 bg-zinc-900/60 hover:border-amber-500 hover:bg-amber-500/10 text-zinc-300 hover:text-amber-300 transition-colors text-xs flex items-center justify-between group cursor-pointer"
                            >
                                <span>{{ __('home.rag_suggestion_3') }}</span>
                                <span class="text-amber-500 opacity-0 group-hover:opacity-100 transition-opacity">→</span>
                            </button>
                            <button
                                type="button"
                                @click="askPreset('{{ __('home.rag_suggestion_4') }}')"
                                class="w-full text-left p-2.5 border border-zinc-800 bg-zinc-900/60 hover:border-amber-500 hover:bg-amber-500/10 text-zinc-300 hover:text-amber-300 transition-colors text-xs flex items-center justify-between group cursor-pointer"
                            >
                                <span>{{ __('home.rag_suggestion_4') }}</span>
                                <span class="text-amber-500 opacity-0 group-hover:opacity-100 transition-opacity">→</span>
                            </button>
                        </div>
                    </div>
                </div>
            </template>

            {{-- Message History Stream --}}
            <template x-for="(msg, index) in messages" :key="index">
                <div :class="msg.role === 'user' ? 'flex justify-end' : 'flex justify-start'">
                    <div
                        class="max-w-[88%] p-3.5 space-y-2 border transition-all"
                        :class="msg.role === 'user'
                            ? 'bg-amber-500/10 border-amber-500/40 text-amber-200'
                            : 'bg-zinc-900/80 border-zinc-800 text-zinc-200'"
                    >
                        {{-- Message Header Tag --}}
                        <div class="flex items-center justify-between text-[10px] font-bold uppercase tracking-wider text-zinc-500 border-b border-zinc-800/60 pb-1.5 mb-1.5">
                            <span x-text="msg.role === 'user' ? 'USUARIO' : 'AI TECHNICAL ADVISOR'"></span>
                            <template x-if="msg.role === 'assistant' && msg.content">
                                <button
                                    type="button"
                                    @click="speak(msg.content)"
                                    class="text-zinc-400 hover:text-amber-400 flex items-center gap-1 cursor-pointer"
                                    title="Reproducir audio"
                                >
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" />
                                    </svg>
                                    <span class="text-[9px]">AUDIO</span>
                                </button>
                            </template>
                        </div>

                        {{-- Message Text Content --}}
                        <div class="whitespace-pre-wrap leading-relaxed select-text" x-text="msg.content"></div>

                        {{-- Citations / Grounding Sources --}}
                        <template x-if="msg.sources && msg.sources.length > 0">
                            <div class="pt-2 border-t border-zinc-800/60 space-y-1">
                                <div class="text-[9px] uppercase tracking-wider text-amber-500 font-bold">
                                    {{ __('home.rag_sources_label') }}
                                </div>
                                <div class="flex flex-wrap gap-1.5">
                                    <template x-for="src in msg.sources" :key="src.id">
                                        <span
                                            class="inline-flex items-center gap-1 px-1.5 py-0.5 bg-black/40 border border-zinc-800 text-[9px] text-zinc-400"
                                            :title="'Similitud: ' + (src.score * 100).toFixed(1) + '%'"
                                        >
                                            <span class="text-amber-500 font-bold">#</span>
                                            <span x-text="src.title + ' (' + src.section + ')'"></span>
                                        </span>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </template>

            {{-- Loading / Typing indicator --}}
            <template x-if="isLoading && messages[messages.length - 1]?.role !== 'assistant'">
                <div class="flex justify-start">
                    <div class="p-3 border border-zinc-800 bg-zinc-900/60 flex items-center gap-2 text-zinc-400 text-xs">
                        <span class="w-2 h-2 rounded-full bg-amber-500 animate-ping"></span>
                        <span class="text-[11px] font-bold tracking-wider uppercase">Procesando consulta en Pinecone...</span>
                    </div>
                </div>
            </template>
        </div>

        {{-- ── Drawer Footer / Input Toolbar ── --}}
        <footer class="p-3 sm:p-4 border-t border-zinc-800 bg-canvas/90 shrink-0 space-y-2">
            {{-- Audio listening indicator --}}
            <div x-show="isListening" class="flex items-center gap-2 px-3 py-1.5 bg-amber-500/10 border border-amber-500 text-amber-400 text-xs">
                <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
                <span class="text-[11px] font-bold uppercase tracking-wider">{{ __('home.rag_listening') }}</span>
            </div>

            <form @submit.prevent="submitMessage()" class="flex items-center gap-2">
                {{-- Speech-To-Text Microphone Button --}}
                <button
                    type="button"
                    @click="toggleMicrophone()"
                    class="h-10 w-10 border flex items-center justify-center transition-colors cursor-pointer shrink-0"
                    :class="isListening ? 'border-red-500 bg-red-500/20 text-red-400 animate-pulse' : 'border-zinc-800 bg-zinc-900 hover:border-amber-500 text-zinc-300 hover:text-amber-400'"
                    :title="isListening ? 'Detener micrófono' : 'Hablar por micrófono'"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 003-3V5a3 3 0 10-6 0v6a3 3 0 003 3z" />
                    </svg>
                </button>

                {{-- Text Input --}}
                <div class="flex-1 relative">
                    <input
                        type="text"
                        x-model="userInput"
                        :disabled="isLoading"
                        placeholder="{{ __('home.rag_input_placeholder') }}"
                        class="w-full h-10 px-3.5 bg-zinc-900 border border-zinc-800 text-zinc-100 placeholder-zinc-500 focus:outline-none focus:border-amber-500 font-roboto-mono text-xs transition-colors disabled:opacity-50"
                    />
                </div>

                {{-- Extruded Send Button --}}
                <x-v2.extruded-box
                    as="button"
                    type="submit"
                    variant="amber"
                    depth="sm"
                    class="h-10 px-4 font-roboto-mono font-bold text-xs uppercase tracking-wider flex items-center justify-center shrink-0 cursor-pointer disabled:opacity-50"
                    ::disabled="isLoading || !userInput.trim()"
                >
                    <span x-show="!isLoading">{{ __('home.rag_send') }}</span>
                    <span x-show="isLoading" class="animate-pulse">...</span>
                </x-v2.extruded-box>
            </form>

            <div class="flex items-center justify-between text-[10px] text-zinc-600 uppercase tracking-widest pt-1">
                <span>EST. TTFT: ~40MS // SSE STREAMING</span>
                <span>PINECONE & OPENAI GROUNDED</span>
            </div>
        </footer>
    </aside>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('ragAssistant', () => ({
        isOpen: false,
        isLoading: false,
        isListening: false,
        speaking: false,
        voiceEnabled: true,
        userInput: '',
        messages: [],
        recognition: null,
        currentAudio: null,

        init() {
            this.initSpeechRecognition();
        },

        openDrawer() {
            this.isOpen = true;
            document.body.classList.add('overflow-hidden');
        },

        closeDrawer() {
            this.isOpen = false;
            document.body.classList.remove('overflow-hidden');
            if (this.isListening && this.recognition) {
                this.recognition.stop();
                this.isListening = false;
            }
            if (this.currentAudio) {
                this.currentAudio.pause();
                this.currentAudio = null;
            }
            if ('speechSynthesis' in window) {
                window.speechSynthesis.cancel();
            }
        },

        toggleVoice() {
            this.voiceEnabled = !this.voiceEnabled;
            if (!this.voiceEnabled) {
                if (this.currentAudio) {
                    this.currentAudio.pause();
                    this.currentAudio = null;
                }
                if ('speechSynthesis' in window) {
                    window.speechSynthesis.cancel();
                }
            }
        },

        askPreset(question) {
            this.userInput = question;
            this.submitMessage();
        },

        initSpeechRecognition() {
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
            if (!SpeechRecognition) return;

            this.recognition = new SpeechRecognition();
            this.recognition.lang = document.documentElement.lang === 'en' ? 'en-US' : 'es-CO';
            this.recognition.continuous = false;
            this.recognition.interimResults = false;

            this.recognition.onstart = () => {
                this.isListening = true;
            };

            this.recognition.onend = () => {
                this.isListening = false;
            };

            this.recognition.onerror = (e) => {
                this.isListening = false;
            };

            this.recognition.onresult = (event) => {
                const transcript = event.results[0][0].transcript;
                this.userInput = transcript;
                this.submitMessage();
            };
        },

        toggleMicrophone() {
            if (!this.recognition) {
                alert('El reconocimiento de voz por micrófono no está soportado en este navegador.');
                return;
            }

            if (this.isListening) {
                this.recognition.stop();
                this.isListening = false;
            } else {
                this.recognition.start();
            }
        },

        async speak(text) {
            if (this.currentAudio) {
                this.currentAudio.pause();
                this.currentAudio = null;
            }
            if ('speechSynthesis' in window) {
                window.speechSynthesis.cancel();
            }

            // Sanitize technical markdown links, tags, and formatting for fluid audio delivery
            const cleanText = text
                .replace(/https?:\/\/\S+/g, '')
                .replace(/[#*_`\[\]\(\)]/g, ' ')
                .replace(/\s+/g, ' ')
                .trim();

            if (!cleanText) return;

            // 1. Attempt ElevenLabs backend synthesis first (for cloned voice)
            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                const response = await fetch('/api/rag/tts', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken || '',
                        'Accept': 'audio/mpeg'
                    },
                    body: JSON.stringify({ text: cleanText.substring(0, 500) })
                });

                if (response.ok) {
                    const blob = await response.blob();
                    const audioUrl = URL.createObjectURL(blob);
                    this.currentAudio = new Audio(audioUrl);
                    this.currentAudio.onended = () => { this.currentAudio = null; };
                    await this.currentAudio.play();
                    return;
                }
            } catch (err) {
                // Silently fallback to native browser synthesis
            }

            // 2. Native Web Speech Synthesis Fallback
            if ('speechSynthesis' in window) {
                const utterance = new SpeechSynthesisUtterance(cleanText);
                utterance.lang = document.documentElement.lang === 'en' ? 'en-US' : 'es-ES';
                utterance.rate = 1.05;
                window.speechSynthesis.speak(utterance);
            }
        },

        async submitMessage() {
            const query = this.userInput.trim();
            if (!query || this.isLoading) return;

            this.messages.push({
                role: 'user',
                content: query,
                sources: []
            });

            this.userInput = '';
            this.isLoading = true;
            this.scrollToBottom();

            // Prepare history payload for context continuity (last 4 interactions)
            const historyPayload = this.messages.slice(-5, -1).map(m => ({
                role: m.role,
                content: m.content
            }));

            // Placeholder for assistant stream
            const assistantIndex = this.messages.length;
            this.messages.push({
                role: 'assistant',
                content: '',
                sources: []
            });

            try {
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                const response = await fetch('/api/rag/chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken || '',
                        'Accept': 'text/event-stream'
                    },
                    body: JSON.stringify({
                        message: query,
                        history: historyPayload
                    })
                });

                if (!response.ok) {
                    throw new Error('Error al conectar con el motor RAG (HTTP ' + response.status + ')');
                }

                const reader = response.body.getReader();
                const decoder = new TextDecoder('utf-8');
                let buffer = '';

                while (true) {
                    const { done, value } = await reader.read();
                    if (done) break;

                    buffer += decoder.decode(value, { stream: true });
                    const lines = buffer.split('\n');
                    buffer = lines.pop() || '';

                    let currentEvent = 'message';
                    for (const line of lines) {
                        const trimmed = line.trim();
                        if (trimmed.startsWith('event: ')) {
                            currentEvent = trimmed.substring(7).trim();
                        } else if (trimmed.startsWith('data: ')) {
                            const rawData = trimmed.substring(6).trim();
                            try {
                                const parsed = JSON.parse(rawData);
                                if (currentEvent === 'context' && parsed.sources) {
                                    this.messages[assistantIndex].sources = parsed.sources;
                                } else if (currentEvent === 'token' && parsed.token) {
                                    this.messages[assistantIndex].content += parsed.token;
                                    this.scrollToBottom();
                                } else if (currentEvent === 'error') {
                                    this.messages[assistantIndex].content += '\n[Error: ' + parsed.error + ']';
                                }
                            } catch (err) {
                                // Ignore non-json lines
                            }
                        }
                    }
                }

                // If voice is enabled, speak the completed answer
                if (this.voiceEnabled && this.messages[assistantIndex].content) {
                    this.speak(this.messages[assistantIndex].content);
                }
            } catch (error) {
                this.messages[assistantIndex].content = 'Ocurrió un error al procesar tu consulta: ' + error.message;
            } finally {
                this.isLoading = false;
                this.scrollToBottom();
            }
        },

        scrollToBottom() {
            this.$nextTick(() => {
                const container = this.$refs.messageList;
                if (container) {
                    container.scrollTop = container.scrollHeight;
                }
            });
        }
    }));
});
</script>
