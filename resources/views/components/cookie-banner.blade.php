<!-- Cookie/Privacy Banner -->
<div x-data="{
    shown: !localStorage.getItem('cookie_consent'),
    accept() {
        localStorage.setItem('cookie_consent', 'true');
        this.shown = false;
    }
}"
     x-show="shown"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="translate-y-full opacity-0"
     x-transition:enter-end="translate-y-0 opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="translate-y-0 opacity-100"
     x-transition:leave-end="translate-y-full opacity-0"
     class="fixed bottom-0 left-0 right-0 z-[100] p-4 md:p-0"
     style="display: none;">

    <div class="max-w-4xl mx-auto md:mb-6">
        <div class="bg-white dark:bg-dark-secondary rounded-2xl shadow-2xl border border-gray-100 dark:border-dark-accent overflow-hidden">
            <div class="p-5 md:p-6">
                <div class="flex flex-col md:flex-row md:items-center gap-4">
                    <!-- Icon & Text -->
                    <div class="flex-1">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 w-10 h-10 bg-trama-red/10 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-trama-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-heading font-bold text-dark-primary dark:text-white text-sm md:text-base">
                                    Notitia et Securitas
                                    <span class="text-gray-400 font-normal text-xs ml-2">(Información y Seguridad)</span>
                                </h3>
                                <p class="text-gray-600 dark:text-gray-400 text-sm mt-1 leading-relaxed">
                                    Este sitio utiliza cookies y tecnologías similares para mejorar tu experiencia.
                                    Tus datos están protegidos mediante conexión <span class="inline-flex items-center gap-1 text-green-600 font-medium"><svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>SSL</span> segura.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Accept Button -->
                    <div class="flex-shrink-0">
                        <button @click="accept()"
                                class="w-full md:w-auto px-6 py-2.5 bg-trama-red hover:bg-trama-red-dark text-white font-semibold rounded-xl transition-all duration-200 hover:scale-105 hover:shadow-lg">
                            Accepto
                            <span class="text-white/70 text-xs ml-1">(Acepto)</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="bg-gray-50 dark:bg-dark-accent px-5 py-3 flex flex-wrap items-center justify-between gap-2 text-xs text-gray-500 dark:text-gray-400">
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    Conexión segura SSL/TLS
                </span>
                <span>ISSN 3072-7383</span>
            </div>
        </div>
    </div>
</div>
