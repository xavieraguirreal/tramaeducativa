@extends('layouts.app')

@section('title', $query ? 'Buscar: ' . $query : 'Buscar')

@section('content')
<div class="container-main py-8">
    <!-- Search Header -->
    <header class="mb-8">
        <h1 class="font-heading text-3xl md:text-4xl font-bold dark:text-white mb-6">
            @if($query)
            Resultados para: <span class="text-trama-red">"{{ $query }}"</span>
            @else
            Buscar noticias
            @endif
        </h1>

        <!-- Search Form with Filters -->
        <form action="{{ route('search') }}" method="GET" class="space-y-4" x-data="{ showFilters: {{ ($categorySlug || $dateFrom || $dateTo || $sort !== 'recent') ? 'true' : 'false' }} }">
            <!-- Main Search Input -->
            <div class="relative max-w-3xl">
                <input type="text"
                       name="q"
                       value="{{ $query }}"
                       placeholder="Buscar noticias..."
                       class="w-full px-6 py-4 pr-32 rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-dark-secondary text-dark-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-trama-red focus:border-transparent text-lg">
                <button type="submit"
                        class="absolute right-2 top-1/2 -translate-y-1/2 bg-trama-red text-white px-6 py-2.5 rounded-lg hover:bg-trama-red-dark transition-colors font-medium">
                    <span class="hidden sm:inline">Buscar</span>
                    <svg class="w-5 h-5 sm:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>
            </div>

            <!-- Toggle Filters Button -->
            <button type="button"
                    @click="showFilters = !showFilters"
                    class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 hover:text-trama-red transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                <span x-text="showFilters ? 'Ocultar filtros' : 'Mostrar filtros'"></span>
                <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': showFilters }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <!-- Filters Panel -->
            <div x-show="showFilters"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="bg-white dark:bg-dark-secondary rounded-xl p-6 border border-gray-200 dark:border-gray-700 max-w-3xl">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Category Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Seccion</label>
                        <select name="categoria"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-dark-accent text-dark-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-trama-red">
                            <option value="">Todas</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->slug }}" {{ $categorySlug === $cat->slug ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Date From -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Desde</label>
                        <input type="date"
                               name="desde"
                               value="{{ $dateFrom }}"
                               class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-dark-accent text-dark-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-trama-red">
                    </div>

                    <!-- Date To -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Hasta</label>
                        <input type="date"
                               name="hasta"
                               value="{{ $dateTo }}"
                               class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-dark-accent text-dark-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-trama-red">
                    </div>

                    <!-- Sort -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Ordenar por</label>
                        <select name="orden"
                                class="w-full px-4 py-2.5 rounded-lg border border-gray-200 dark:border-gray-600 bg-white dark:bg-dark-accent text-dark-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-trama-red">
                            <option value="recent" {{ $sort === 'recent' ? 'selected' : '' }}>Mas recientes</option>
                            <option value="oldest" {{ $sort === 'oldest' ? 'selected' : '' }}>Mas antiguos</option>
                            <option value="views" {{ $sort === 'views' ? 'selected' : '' }}>Mas leidos</option>
                        </select>
                    </div>
                </div>

                <!-- Filter Actions -->
                <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-200 dark:border-gray-600">
                    <a href="{{ route('search', ['q' => $query]) }}"
                       class="text-sm text-gray-500 hover:text-trama-red transition-colors">
                        Limpiar filtros
                    </a>
                    <button type="submit"
                            class="bg-trama-red text-white px-4 py-2 rounded-lg hover:bg-trama-red-dark transition-colors text-sm font-medium">
                        Aplicar filtros
                    </button>
                </div>
            </div>
        </form>

        <!-- Results Info & Active Filters -->
        @if($query || $categorySlug || $dateFrom || $dateTo)
        <div class="mt-6 flex flex-wrap items-center gap-3">
            <span class="text-gray-600 dark:text-gray-400">
                {{ $articles->total() }} resultado(s)
            </span>

            <!-- Active Filter Tags -->
            @if($selectedCategory)
            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-gray-100 dark:bg-dark-accent text-sm">
                <span class="w-2 h-2 rounded-full" style="background-color: {{ $selectedCategory->color }}"></span>
                {{ $selectedCategory->name }}
                <a href="{{ route('search', array_merge(request()->except('categoria'), ['q' => $query])) }}"
                   class="ml-1 text-gray-400 hover:text-trama-red">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </a>
            </span>
            @endif

            @if($dateFrom || $dateTo)
            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-gray-100 dark:bg-dark-accent text-sm text-gray-700 dark:text-gray-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ $dateFrom ?: '...' }} - {{ $dateTo ?: '...' }}
                <a href="{{ route('search', array_merge(request()->except(['desde', 'hasta']), ['q' => $query])) }}"
                   class="ml-1 text-gray-400 hover:text-trama-red">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </a>
            </span>
            @endif
        </div>
        @endif
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            @if($articles->count() > 0)
            <div class="space-y-4 stagger-fade-in">
                @foreach($articles as $article)
                <article class="news-card p-4 flex gap-4 group hover:shadow-lg transition-all duration-300">
                    <a href="{{ route('article.show', $article) }}" class="flex-shrink-0 overflow-hidden rounded-lg">
                        <img src="{{ $article->featured_image_url }}"
                             alt="{{ $article->title }}"
                             class="w-32 h-24 md:w-40 md:h-28 object-cover group-hover:scale-110 transition-transform duration-500">
                    </a>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            <a href="{{ route('category', $article->category) }}"
                               class="text-xs font-semibold uppercase"
                               style="color: {{ $article->category->color }}">
                                {{ $article->category->name }}
                            </a>
                            <span class="text-gray-300">•</span>
                            <time class="text-xs text-gray-500">{{ $article->published_at->format('d/m/Y') }}</time>
                        </div>
                        <h3 class="font-semibold text-lg dark:text-white leading-tight">
                            <a href="{{ route('article.show', $article) }}" class="hover:text-trama-red transition-colors">
                                {{ $article->title }}
                            </a>
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mt-2 line-clamp-2 hidden sm:block">
                            {{ $article->excerpt }}
                        </p>

                        <!-- Tags -->
                        @if($article->tags->count() > 0)
                        <div class="flex flex-wrap gap-1 mt-2">
                            @foreach($article->tags->take(3) as $tag)
                            <a href="{{ route('tag', $tag) }}"
                               class="text-xs px-2 py-0.5 rounded-full bg-gray-100 dark:bg-dark-accent text-gray-500 dark:text-gray-400 hover:bg-trama-red hover:text-white transition-colors">
                                #{{ $tag->name }}
                            </a>
                            @endforeach
                        </div>
                        @endif

                        <div class="flex items-center gap-4 mt-3 text-xs text-gray-500">
                            <span class="flex items-center gap-1">
                                <img src="{{ $article->author->avatar_url }}" class="w-5 h-5 rounded-full" alt="">
                                {{ $article->author->name }}
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                {{ number_format($article->views) }}
                            </span>
                            <span>{{ $article->reading_time }} min</span>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $articles->appends(request()->query())->links() }}
            </div>
            @else
            <div class="news-card p-12 text-center">
                <svg class="w-20 h-20 mx-auto text-gray-300 dark:text-gray-600 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                @if($query)
                <h3 class="font-heading text-xl font-bold dark:text-white mb-2">No se encontraron resultados</h3>
                <p class="text-gray-600 dark:text-gray-400">No hay noticias que coincidan con tu busqueda.</p>
                <p class="text-gray-500 text-sm mt-2">Intenta con otras palabras clave o ajusta los filtros.</p>
                @else
                <h3 class="font-heading text-xl font-bold dark:text-white mb-2">Ingresa un termino de busqueda</h3>
                <p class="text-gray-600 dark:text-gray-400">Escribe lo que buscas en el campo de arriba.</p>
                @endif
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <aside class="space-y-8">
            <!-- Quick Categories -->
            <div class="bg-white dark:bg-dark-secondary rounded-xl p-6">
                <h3 class="font-heading font-bold text-lg mb-4 dark:text-white flex items-center gap-2">
                    <span class="w-1 h-6 bg-trama-red rounded-full"></span>
                    Buscar por Seccion
                </h3>
                <div class="space-y-2">
                    @foreach($categories as $cat)
                    <a href="{{ route('search', ['q' => $query, 'categoria' => $cat->slug]) }}"
                       class="flex items-center justify-between p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-dark-accent transition-colors group {{ $categorySlug === $cat->slug ? 'bg-gray-50 dark:bg-dark-accent' : '' }}">
                        <span class="flex items-center gap-3">
                            <span class="w-3 h-3 rounded-full" style="background-color: {{ $cat->color }}"></span>
                            <span class="dark:text-white group-hover:text-trama-red transition-colors">{{ $cat->name }}</span>
                        </span>
                        @if($categorySlug === $cat->slug)
                        <svg class="w-5 h-5 text-trama-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        @endif
                    </a>
                    @endforeach
                </div>
            </div>

            <!-- Search Tips -->
            <div class="bg-gray-50 dark:bg-dark-accent rounded-xl p-6">
                <h3 class="font-heading font-bold text-lg mb-4 dark:text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-trama-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                    </svg>
                    Tips de busqueda
                </h3>
                <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                    <li class="flex items-start gap-2">
                        <span class="text-trama-red mt-1">•</span>
                        Usa palabras clave especificas
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-trama-red mt-1">•</span>
                        Filtra por seccion para resultados mas precisos
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-trama-red mt-1">•</span>
                        Usa el rango de fechas para noticias recientes
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="text-trama-red mt-1">•</span>
                        Ordena por "Mas leidos" para contenido popular
                    </li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="bg-trama-red text-white rounded-xl p-6">
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
