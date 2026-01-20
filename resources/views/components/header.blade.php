<header class="bg-white dark:bg-dark-primary shadow-sm sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
    <!-- Top Bar -->
    <div class="bg-dark-primary text-white text-sm py-2 hidden md:block">
        <div class="container-main flex justify-between items-center">
            <div class="flex items-center gap-4">
                <span>{{ now()->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY') }}</span>
                <span class="text-gray-400">|</span>
                <span>Mar del Plata, Argentina</span>
            </div>
            <div class="flex items-center gap-4">
                <!-- Dark Mode Toggle -->
                <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)"
                        class="p-1 rounded hover:bg-dark-secondary transition-colors"
                        :title="darkMode ? 'Modo claro' : 'Modo oscuro'">
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                    <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </button>
                <!-- Social Links -->
                <a href="https://www.facebook.com/TramaEducativaRadio" target="_blank" class="hover:text-trama-red transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <a href="https://twitter.com/TramaEducativa" target="_blank" class="hover:text-trama-red transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
                <a href="https://instagram.com/tramaeducativa" target="_blank" class="hover:text-trama-red transition-colors">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"/></svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <div class="container-main py-4">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <a href="/" class="flex items-center gap-3">
                <div class="w-12 h-12 bg-trama-red rounded-lg flex items-center justify-center">
                    <span class="text-white font-heading font-bold text-xl">TE</span>
                </div>
                <div class="hidden sm:block">
                    <h1 class="font-heading font-bold text-xl text-dark-primary dark:text-white leading-tight">
                        Trama Educativa
                    </h1>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Noticias de educacion</p>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <nav class="hidden lg:flex items-center gap-1">
                <a href="{{ route('home') }}" class="px-4 py-2 text-sm font-medium text-dark-primary dark:text-white hover:text-trama-red dark:hover:text-trama-red transition-colors">Inicio</a>
                <a href="/categoria/locales" class="px-4 py-2 text-sm font-medium text-dark-primary dark:text-white hover:text-trama-red dark:hover:text-trama-red transition-colors">Locales</a>
                <a href="/categoria/universidad" class="px-4 py-2 text-sm font-medium text-dark-primary dark:text-white hover:text-trama-red dark:hover:text-trama-red transition-colors">Universidad</a>
                <a href="/categoria/gremiales" class="px-4 py-2 text-sm font-medium text-dark-primary dark:text-white hover:text-trama-red dark:hover:text-trama-red transition-colors">Gremiales</a>
                <a href="/categoria/politica-educativa" class="px-4 py-2 text-sm font-medium text-dark-primary dark:text-white hover:text-trama-red dark:hover:text-trama-red transition-colors">Politica Educativa</a>
                <a href="/categoria/cultura" class="px-4 py-2 text-sm font-medium text-dark-primary dark:text-white hover:text-trama-red dark:hover:text-trama-red transition-colors">Cultura</a>
                <a href="#" class="px-4 py-2 text-sm font-medium text-dark-primary dark:text-white hover:text-trama-red dark:hover:text-trama-red transition-colors">Radio</a>
            </nav>

            <!-- Search & Mobile Menu -->
            <div class="flex items-center gap-2">
                <a href="{{ route('search') }}" class="p-2 text-dark-primary dark:text-white hover:text-trama-red transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </a>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 text-dark-primary dark:text-white hover:text-trama-red transition-colors">
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="lg:hidden bg-white dark:bg-dark-primary border-t dark:border-dark-secondary">
        <nav class="container-main py-4 space-y-2">
            <a href="{{ route('home') }}" class="block px-4 py-2 text-dark-primary dark:text-white hover:bg-light-secondary dark:hover:bg-dark-secondary rounded-lg transition-colors">Inicio</a>
            <a href="/categoria/locales" class="block px-4 py-2 text-dark-primary dark:text-white hover:bg-light-secondary dark:hover:bg-dark-secondary rounded-lg transition-colors">Locales</a>
            <a href="/categoria/universidad" class="block px-4 py-2 text-dark-primary dark:text-white hover:bg-light-secondary dark:hover:bg-dark-secondary rounded-lg transition-colors">Universidad</a>
            <a href="/categoria/gremiales" class="block px-4 py-2 text-dark-primary dark:text-white hover:bg-light-secondary dark:hover:bg-dark-secondary rounded-lg transition-colors">Gremiales</a>
            <a href="/categoria/politica-educativa" class="block px-4 py-2 text-dark-primary dark:text-white hover:bg-light-secondary dark:hover:bg-dark-secondary rounded-lg transition-colors">Politica Educativa</a>
            <a href="/categoria/cultura" class="block px-4 py-2 text-dark-primary dark:text-white hover:bg-light-secondary dark:hover:bg-dark-secondary rounded-lg transition-colors">Cultura</a>
            <a href="#" class="block px-4 py-2 text-dark-primary dark:text-white hover:bg-light-secondary dark:hover:bg-dark-secondary rounded-lg transition-colors">Radio</a>
            <a href="{{ route('search') }}" class="block px-4 py-2 text-dark-primary dark:text-white hover:bg-light-secondary dark:hover:bg-dark-secondary rounded-lg transition-colors">Buscar</a>
            <div class="pt-4 border-t dark:border-dark-secondary">
                <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)"
                        class="flex items-center gap-2 px-4 py-2 text-dark-primary dark:text-white w-full hover:bg-light-secondary dark:hover:bg-dark-secondary rounded-lg transition-colors">
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                    <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <span x-text="darkMode ? 'Modo claro' : 'Modo oscuro'"></span>
                </button>
            </div>
        </nav>
    </div>
</header>
