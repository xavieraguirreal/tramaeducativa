@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="container-main py-8">
    <!-- Bento Grid Section -->
    <section class="mb-12">
        <div class="bento-grid stagger-fade-in">
            <!-- Featured Article (2x2) -->
            @if($featuredArticle)
            <article class="bento-item bento-featured group">
                <a href="{{ route('article.show', $featuredArticle) }}" class="block h-full">
                    <img src="{{ $featuredArticle->featured_image_url }}"
                         alt="{{ $featuredArticle->title }}"
                         class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8">
                        <span class="category-tag mb-3" style="background-color: {{ $featuredArticle->category->color }}">
                            {{ $featuredArticle->category->name }}
                        </span>
                        <h2 class="font-heading text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-3 leading-tight bento-title">
                            {{ $featuredArticle->title }}
                        </h2>
                        <p class="text-gray-300 text-sm md:text-base mb-4 line-clamp-2 max-w-2xl">
                            {{ $featuredArticle->excerpt }}
                        </p>
                        <div class="flex flex-wrap items-center gap-4 text-gray-400 text-sm">
                            <span class="flex items-center gap-2">
                                <img src="{{ $featuredArticle->author->avatar_url }}" class="w-6 h-6 rounded-full" alt="">
                                {{ $featuredArticle->author->name }}
                            </span>
                            <span>{{ $featuredArticle->published_at->diffForHumans() }}</span>
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                {{ number_format($featuredArticle->views) }}
                            </span>
                        </div>
                    </div>
                </a>
            </article>
            @endif

            <!-- Other Articles -->
            @foreach($latestArticles->take(5) as $index => $article)
            <article class="bento-item bento-card group {{ $index === 0 ? 'bento-tall' : '' }}">
                <a href="{{ route('article.show', $article) }}" class="block h-full">
                    <div class="relative h-40 {{ $index === 0 ? 'md:h-full' : '' }} overflow-hidden">
                        <img src="{{ $article->featured_image_url }}"
                             alt="{{ $article->title }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-3 left-3">
                            <span class="category-tag text-xs" style="background-color: {{ $article->category->color }}">
                                {{ $article->category->name }}
                            </span>
                        </div>
                    </div>
                    <div class="p-4 {{ $index === 0 ? 'md:absolute md:bottom-0 md:left-0 md:right-0 md:bg-gradient-to-t md:from-black/90 md:to-transparent md:text-white' : '' }}">
                        <h3 class="font-semibold {{ $index === 0 ? 'text-lg md:text-xl md:text-white' : 'text-base' }} dark:text-white leading-tight bento-title">
                            {{ $article->title }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 {{ $index === 0 ? 'md:text-gray-300' : '' }} text-sm mt-2 line-clamp-2">
                            {{ $article->excerpt }}
                        </p>
                        <div class="flex items-center justify-between mt-3 text-xs text-gray-500 {{ $index === 0 ? 'md:text-gray-400' : '' }}">
                            <time>{{ $article->published_at->diffForHumans() }}</time>
                            <span class="flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                {{ number_format($article->views) }}
                            </span>
                        </div>
                    </div>
                </a>
            </article>
            @endforeach
        </div>
    </section>

    <!-- Ad Banner Top -->
    <x-ad-slot type="horizontal" id="ad-home-top" class="mb-8" />

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Mas Noticias Section -->
            <section>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="font-heading text-2xl font-bold text-dark-primary dark:text-white flex items-center gap-2">
                        <span class="w-1 h-8 bg-trama-red rounded-full"></span>
                        Mas Noticias
                    </h2>
                </div>
                <div class="space-y-4 stagger-fade-in">
                    @foreach($latestArticles->skip(5) as $article)
                    <article class="news-card p-4 flex gap-4 group hover:shadow-lg transition-all duration-300">
                        <a href="{{ route('article.show', $article) }}" class="flex-shrink-0 overflow-hidden rounded-lg">
                            <img src="{{ $article->featured_image_url }}"
                                 alt="{{ $article->title }}"
                                 class="w-32 h-24 object-cover group-hover:scale-110 transition-transform duration-500">
                        </a>
                        <div class="flex-1 min-w-0">
                            <a href="{{ route('category', $article->category) }}"
                               class="text-xs font-semibold uppercase"
                               style="color: {{ $article->category->color }}">
                                {{ $article->category->name }}
                            </a>
                            <h3 class="font-semibold dark:text-white leading-tight mt-1 bento-title">
                                <a href="{{ route('article.show', $article) }}" class="hover:text-trama-red transition-colors">
                                    {{ $article->title }}
                                </a>
                            </h3>
                            <div class="flex items-center gap-3 mt-2 text-xs text-gray-500">
                                <time>{{ $article->published_at->diffForHumans() }}</time>
                                <span>{{ $article->reading_time }} min</span>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </section>

            <!-- Por Categoría -->
            @if(!empty($articlesByCategory))
            @foreach($articlesByCategory as $slug => $data)
            @if($data['articles']->count() > 0)
            <section>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-heading text-xl font-bold dark:text-white flex items-center gap-2">
                        <span class="w-1 h-6 rounded-full" style="background-color: {{ $data['category']->color }}"></span>
                        {{ $data['category']->name }}
                    </h2>
                    <a href="{{ route('category', $data['category']) }}" class="text-sm font-medium hover:text-trama-red transition-colors" style="color: {{ $data['category']->color }}">
                        Ver todas →
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach($data['articles'] as $article)
                    <article class="news-card overflow-hidden group">
                        <a href="{{ route('article.show', $article) }}" class="block overflow-hidden">
                            <img src="{{ $article->featured_image_url }}"
                                 alt="{{ $article->title }}"
                                 class="w-full h-32 object-cover group-hover:scale-110 transition-transform duration-500">
                        </a>
                        <div class="p-3">
                            <h3 class="font-semibold text-sm dark:text-white leading-tight line-clamp-2">
                                <a href="{{ route('article.show', $article) }}" class="hover:text-trama-red transition-colors">
                                    {{ $article->title }}
                                </a>
                            </h3>
                            <time class="text-xs text-gray-500 mt-1 block">{{ $article->published_at->diffForHumans() }}</time>
                        </div>
                    </article>
                    @endforeach
                </div>
            </section>
            @endif
            @endforeach
            @endif

            <!-- Ad In-Content -->
            <x-ad-slot type="horizontal" id="ad-home-middle" />

            <!-- Categorias Section -->
            <section>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="font-heading text-2xl font-bold text-dark-primary dark:text-white flex items-center gap-2">
                        <span class="w-1 h-8 bg-trama-red rounded-full"></span>
                        Secciones
                    </h2>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($categories as $category)
                    <a href="{{ route('category', $category) }}"
                       class="news-card p-4 text-center group hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                        <div class="w-12 h-12 mx-auto mb-3 rounded-full flex items-center justify-center transition-transform duration-300 group-hover:scale-110"
                             style="background-color: {{ $category->color }}20">
                            @switch($category->slug)
                                @case('locales')
                                    <svg class="w-6 h-6" style="color: {{ $category->color }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    @break
                                @case('universidad')
                                    <svg class="w-6 h-6" style="color: {{ $category->color }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                                    </svg>
                                    @break
                                @case('gremiales')
                                    <svg class="w-6 h-6" style="color: {{ $category->color }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    @break
                                @case('politica-educativa')
                                    <svg class="w-6 h-6" style="color: {{ $category->color }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/>
                                    </svg>
                                    @break
                                @case('cultura')
                                    <svg class="w-6 h-6" style="color: {{ $category->color }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                                    </svg>
                                    @break
                                @case('ciencia-y-tecnologia')
                                    <svg class="w-6 h-6" style="color: {{ $category->color }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                    </svg>
                                    @break
                                @case('ambiente')
                                    <svg class="w-6 h-6" style="color: {{ $category->color }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    @break
                                @case('columnas')
                                @case('opinion')
                                    <svg class="w-6 h-6" style="color: {{ $category->color }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    @break
                                @default
                                    <svg class="w-6 h-6" style="color: {{ $category->color }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                    </svg>
                            @endswitch
                        </div>
                        <h3 class="font-semibold dark:text-white group-hover:text-trama-red transition-colors">
                            {{ $category->name }}
                        </h3>
                    </a>
                    @endforeach
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
                    @foreach($mostViewed as $index => $article)
                    <article class="flex gap-3 items-start group">
                        <span class="font-heading font-bold text-2xl text-trama-red/30 group-hover:text-trama-red/50 transition-colors">{{ $index + 1 }}</span>
                        <div>
                            <h4 class="font-medium text-sm dark:text-white leading-tight bento-title">
                                <a href="{{ route('article.show', $article) }}" class="hover:text-trama-red transition-colors">
                                    {{ Str::limit($article->title, 50) }}
                                </a>
                            </h4>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="text-xs font-medium" style="color: {{ $article->category->color }}">
                                    {{ $article->category->name }}
                                </span>
                                <span class="text-gray-400 text-xs">•</span>
                                <span class="text-gray-500 text-xs">{{ number_format($article->views) }} vistas</span>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>

            <!-- Ad Sidebar -->
            <x-ad-slot type="square" id="ad-sidebar-1" />

            <!-- Newsletter -->
            <div class="bg-trama-red text-white rounded-lg p-6">
                <h3 class="font-heading font-bold text-lg mb-2">Suscribite</h3>
                <p class="text-white/80 text-sm mb-4">
                    Recibe las noticias mas importantes en tu correo.
                </p>
                <form class="space-y-3">
                    <input type="email"
                           placeholder="Tu email"
                           class="w-full px-4 py-2 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/60 focus:outline-none focus:border-white transition-colors">
                    <button type="submit" class="w-full bg-white text-trama-red px-4 py-2 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                        Suscribirme
                    </button>
                </form>
            </div>
        </aside>
    </div>
</div>
@endsection
