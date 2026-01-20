<!DOCTYPE html>
<html lang="es" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina no encontrada - Trama Educativa</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light-secondary dark:bg-dark-primary min-h-screen flex flex-col">
    <!-- Simple Header -->
    <header class="bg-white dark:bg-dark-primary shadow-sm py-4">
        <div class="container-main">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-trama-red rounded-lg flex items-center justify-center">
                    <span class="text-white font-heading font-bold text-lg">TE</span>
                </div>
                <span class="font-heading font-bold text-xl text-dark-primary dark:text-white">Trama Educativa</span>
            </a>
        </div>
    </header>

    <!-- 404 Content -->
    <main class="flex-1 flex items-center justify-center p-8">
        <div class="text-center max-w-lg">
            <div class="mb-8">
                <span class="font-heading text-[150px] md:text-[200px] font-bold text-trama-red/20 leading-none">404</span>
            </div>
            <h1 class="font-heading text-3xl md:text-4xl font-bold dark:text-white mb-4">
                Pagina no encontrada
            </h1>
            <p class="text-gray-600 dark:text-gray-400 mb-8">
                Lo sentimos, la pagina que buscas no existe o fue movida.
                Puede que el enlace este desactualizado o haya un error en la direccion.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('home') }}" class="btn-primary">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Volver al inicio
                </a>
                <a href="{{ route('search') }}" class="px-6 py-3 rounded-lg border border-gray-300 dark:border-gray-600 text-dark-primary dark:text-white hover:bg-gray-100 dark:hover:bg-dark-secondary transition-colors inline-flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Buscar noticias
                </a>
            </div>
        </div>
    </main>

    <!-- Simple Footer -->
    <footer class="bg-white dark:bg-dark-secondary py-6 mt-auto">
        <div class="container-main text-center text-sm text-gray-500 dark:text-gray-400">
            <p>&copy; {{ date('Y') }} Trama Educativa - Cooperativa de Trabajo Minga Ltda</p>
        </div>
    </footer>
</body>
</html>
