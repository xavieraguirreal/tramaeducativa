@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="container-main py-8">
    <!-- Hero Section -->
    <section class="mb-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Featured News -->
            @if($featuredArticle)
            <div class="lg:col-span-2">
                <article class="news-card group relative h-[400px] overflow-hidden">
                    <img src="{{ $featuredArticle->featured_image_url }}"
                         alt="{{ $featuredArticle->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <a href="{{ route('category', $featuredArticle->category) }}" class="category-tag mb-3" style="background-color: {{ $featuredArticle->category->color }}">
                            {{ $featuredArticle->category->name }}
                        </a>
                        <h2 class="font-heading text-2xl md:text-3xl font-bold text-white mb-2 leading-tight">
                            <a href="{{ route('article.show', $featuredArticle) }}" class="hover:text-trama-red transition-colors">
                                {{ $featuredArticle->title }}
                            </a>
                        </h2>
                        <p class="text-gray-300 text-sm mb-3 line-clamp-2">
                            {{ $featuredArticle->excerpt }}
                        </p>
                        <div class="flex items-center gap-4 text-gray-400 text-sm">
                            <span>Por {{ $featuredArticle->author->name }}</span>
                            <span>|</span>
                            <time>{{ $featuredArticle->published_at->diffForHumans() }}</time>
                        </div>
                    </div>
                </article>
            </div>
            @endif

            <!-- Side News -->
            <div class="space-y-4">
                @foreach($latestArticles->take(4) as $article)
                <article class="news-card p-4 flex gap-4">
                    <img src="{{ $article->featured_image_url }}"
                         alt="{{ $article->title }}"
                         class="w-24 h-20 object-cover rounded flex-shrink-0">
                    <div>
                        <a href="{{ route('category', $article->category) }}"
                           class="text-xs font-semibold uppercase"
                           style="color: {{ $article->category->color }}">
                            {{ $article->category->name }}
                        </a>
                        <h3 class="font-semibold text-sm dark:text-white leading-tight mt-1">
                            <a href="{{ route('article.show', $article) }}" class="hover:text-trama-red transition-colors">
                                {{ Str::limit($article->title, 60) }}
                            </a>
                        </h3>
                        <time class="text-gray-500 text-xs mt-2 block">{{ $article->published_at->diffForHumans() }}</time>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Ultimas Noticias Section -->
            <section>
                <div class="flex items-center justify-between mb-6">
                    <h2 class="font-heading text-2xl font-bold text-dark-primary dark:text-white flex items-center gap-2">
                        <span class="w-1 h-8 bg-trama-red rounded-full"></span>
                        Ultimas Noticias
                    </h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($latestArticles as $article)
                    <article class="news-card overflow-hidden">
                        <a href="{{ route('article.show', $article) }}">
                            <img src="{{ $article->featured_image_url }}"
                                 alt="{{ $article->title }}"
                                 class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300">
                        </a>
                        <div class="p-4">
                            <a href="{{ route('category', $article->category) }}"
                               class="text-xs font-semibold uppercase"
                               style="color: {{ $article->category->color }}">
                                {{ $article->category->name }}
                            </a>
                            <h3 class="font-semibold text-lg dark:text-white mt-2 leading-tight">
                                <a href="{{ route('article.show', $article) }}" class="hover:text-trama-red transition-colors">
                                    {{ $article->title }}
                                </a>
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 text-sm mt-2 line-clamp-2">
                                {{ $article->excerpt }}
                            </p>
                            <div class="flex items-center justify-between mt-3">
                                <time class="text-gray-500 text-xs">{{ $article->published_at->diffForHumans() }}</time>
                                <span class="text-gray-400 text-xs">{{ $article->reading_time }} min lectura</span>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </section>

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
                       class="news-card p-4 text-center hover:shadow-lg transition-shadow group">
                        <div class="w-12 h-12 mx-auto mb-3 rounded-full flex items-center justify-center"
                             style="background-color: {{ $category->color }}20">
                            <span class="text-2xl font-bold" style="color: {{ $category->color }}">
                                {{ substr($category->name, 0, 1) }}
                            </span>
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
                    <article class="flex gap-3 items-start">
                        <span class="font-heading font-bold text-2xl text-trama-red/30">{{ $index + 1 }}</span>
                        <div>
                            <h4 class="font-medium text-sm dark:text-white leading-tight">
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
