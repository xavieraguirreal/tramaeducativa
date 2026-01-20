@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="container-main py-8">
    <!-- Hero Section -->
    <section class="mb-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Featured News -->
            <div class="lg:col-span-2">
                <article class="news-card group relative h-[400px] overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=800&h=400&fit=crop"
                         alt="Noticia destacada"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <span class="category-tag mb-3">Politica Educativa</span>
                        <h2 class="font-heading text-2xl md:text-3xl font-bold text-white mb-2 leading-tight">
                            <a href="#" class="hover:text-trama-red transition-colors">
                                Docentes bonaerenses en alerta por nuevas paritarias: exigen recomposicion salarial
                            </a>
                        </h2>
                        <p class="text-gray-300 text-sm mb-3 line-clamp-2">
                            Los gremios docentes de la provincia de Buenos Aires mantienen el estado de alerta y movilizacion tras las ultimas propuestas del gobierno provincial en materia salarial.
                        </p>
                        <div class="flex items-center gap-4 text-gray-400 text-sm">
                            <span>Por Aylen Aurellio</span>
                            <span>|</span>
                            <time>Hace 2 horas</time>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Side News -->
            <div class="space-y-4">
                <article class="news-card p-4 flex gap-4">
                    <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=150&h=100&fit=crop"
                         alt="Universidad"
                         class="w-24 h-20 object-cover rounded flex-shrink-0">
                    <div>
                        <span class="text-trama-red text-xs font-semibold uppercase">Universidad</span>
                        <h3 class="font-semibold text-sm dark:text-white leading-tight mt-1">
                            <a href="#" class="hover:text-trama-red transition-colors">
                                La UNMdP abre inscripcion para nuevas carreras en 2026
                            </a>
                        </h3>
                        <time class="text-gray-500 text-xs mt-2 block">Hace 4 horas</time>
                    </div>
                </article>

                <article class="news-card p-4 flex gap-4">
                    <img src="https://images.unsplash.com/photo-1529390079861-591de354faf5?w=150&h=100&fit=crop"
                         alt="Gremiales"
                         class="w-24 h-20 object-cover rounded flex-shrink-0">
                    <div>
                        <span class="text-trama-red text-xs font-semibold uppercase">Gremiales</span>
                        <h3 class="font-semibold text-sm dark:text-white leading-tight mt-1">
                            <a href="#" class="hover:text-trama-red transition-colors">
                                SUTEBA Mar del Plata convoca a asamblea provincial
                            </a>
                        </h3>
                        <time class="text-gray-500 text-xs mt-2 block">Hace 5 horas</time>
                    </div>
                </article>

                <article class="news-card p-4 flex gap-4">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&h=100&fit=crop"
                         alt="Cultura"
                         class="w-24 h-20 object-cover rounded flex-shrink-0">
                    <div>
                        <span class="text-trama-red text-xs font-semibold uppercase">Cultura</span>
                        <h3 class="font-semibold text-sm dark:text-white leading-tight mt-1">
                            <a href="#" class="hover:text-trama-red transition-colors">
                                Festival de cine independiente llega a Mar del Plata
                            </a>
                        </h3>
                        <time class="text-gray-500 text-xs mt-2 block">Hace 6 horas</time>
                    </div>
                </article>

                <article class="news-card p-4 flex gap-4">
                    <img src="https://images.unsplash.com/photo-1532094349884-543bc11b234d?w=150&h=100&fit=crop"
                         alt="Ciencia"
                         class="w-24 h-20 object-cover rounded flex-shrink-0">
                    <div>
                        <span class="text-trama-red text-xs font-semibold uppercase">Ciencia</span>
                        <h3 class="font-semibold text-sm dark:text-white leading-tight mt-1">
                            <a href="#" class="hover:text-trama-red transition-colors">
                                Investigadores del CONICET desarrollan nueva tecnologia
                            </a>
                        </h3>
                        <time class="text-gray-500 text-xs mt-2 block">Hace 8 horas</time>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Locales Section -->
            <section>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="font-heading text-2xl font-bold text-dark-primary dark:text-white flex items-center gap-2">
                        <span class="w-1 h-8 bg-trama-red rounded-full"></span>
                        Locales
                    </h2>
                    <a href="#" class="text-trama-red text-sm font-medium hover:underline">Ver mas</a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @for ($i = 0; $i < 4; $i++)
                    <article class="news-card overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1577896851231-70ef18881754?w=400&h=200&fit=crop"
                             alt="Noticia local"
                             class="w-full h-48 object-cover">
                        <div class="p-4">
                            <span class="text-trama-red text-xs font-semibold uppercase">Locales</span>
                            <h3 class="font-semibold text-lg dark:text-white mt-2 leading-tight">
                                <a href="#" class="hover:text-trama-red transition-colors">
                                    Mejoras en infraestructura escolar para el ciclo lectivo 2026
                                </a>
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mt-2 line-clamp-2">
                                El Consejo Escolar de General Pueyrredon anuncio obras de refaccion en 15 escuelas del distrito.
                            </p>
                            <time class="text-gray-500 text-xs mt-3 block">Hace {{ $i + 1 }} horas</time>
                        </div>
                    </article>
                    @endfor
                </div>
            </section>

            <!-- Universidad Section -->
            <section>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="font-heading text-2xl font-bold text-dark-primary dark:text-white flex items-center gap-2">
                        <span class="w-1 h-8 bg-trama-red rounded-full"></span>
                        Universidad
                    </h2>
                    <a href="#" class="text-trama-red text-sm font-medium hover:underline">Ver mas</a>
                </div>
                <div class="space-y-4">
                    @for ($i = 0; $i < 3; $i++)
                    <article class="news-card p-4 flex gap-4">
                        <img src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?w=200&h=150&fit=crop"
                             alt="Universidad"
                             class="w-32 h-24 object-cover rounded flex-shrink-0">
                        <div class="flex-1">
                            <span class="text-trama-red text-xs font-semibold uppercase">UNMdP</span>
                            <h3 class="font-semibold dark:text-white mt-1 leading-tight">
                                <a href="#" class="hover:text-trama-red transition-colors">
                                    Nuevos convenios de intercambio estudiantil con universidades europeas
                                </a>
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mt-2 line-clamp-2">
                                La Universidad Nacional de Mar del Plata firmo acuerdos con instituciones de Espana, Italia y Alemania.
                            </p>
                            <time class="text-gray-500 text-xs mt-2 block">Hace {{ $i + 10 }} horas</time>
                        </div>
                    </article>
                    @endfor
                </div>
            </section>
        </div>

        <!-- Sidebar -->
        <aside class="space-y-8">
            <!-- Radio Widget -->
            <div class="bg-dark-primary text-white rounded-lg p-6">
                <h3 class="font-heading font-bold text-lg mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-trama-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"/>
                    </svg>
                    Radio Trama
                </h3>
                <p class="text-gray-400 text-sm mb-4">
                    Escuchanos todos los lunes a las 20:00 hs por Radio de la Azotea FM 88.7
                </p>
                <a href="#" class="btn-primary w-full text-center block">
                    Escuchar en vivo
                </a>
            </div>

            <!-- Most Read -->
            <div class="bg-white dark:bg-dark-secondary rounded-lg p-6">
                <h3 class="font-heading font-bold text-lg mb-4 dark:text-white flex items-center gap-2">
                    <span class="w-1 h-6 bg-trama-red rounded-full"></span>
                    Mas Leidas
                </h3>
                <div class="space-y-4">
                    @for ($i = 1; $i <= 5; $i++)
                    <article class="flex gap-3 items-start">
                        <span class="font-heading font-bold text-2xl text-trama-red/30">{{ $i }}</span>
                        <div>
                            <h4 class="font-medium text-sm dark:text-white leading-tight">
                                <a href="#" class="hover:text-trama-red transition-colors">
                                    Titulo de noticia muy leida numero {{ $i }}
                                </a>
                            </h4>
                            <time class="text-gray-500 text-xs">{{ now()->subHours($i * 3)->diffForHumans() }}</time>
                        </div>
                    </article>
                    @endfor
                </div>
            </div>

            <!-- Newsletter -->
            <div class="bg-trama-red text-white rounded-lg p-6">
                <h3 class="font-heading font-bold text-lg mb-2">Suscribite</h3>
                <p class="text-white/80 text-sm mb-4">
                    Recibe las noticias mas importantes en tu correo.
                </p>
                <form class="space-y-3">
                    <input type="email"
                           placeholder="Tu email"
                           class="w-full px-4 py-2 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/60 focus:outline-none focus:border-white">
                    <button type="submit" class="w-full bg-white text-trama-red px-4 py-2 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                        Suscribirme
                    </button>
                </form>
            </div>
        </aside>
    </div>
</div>
@endsection
