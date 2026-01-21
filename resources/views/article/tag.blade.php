@extends('layouts.app')

@section('title', 'Etiqueta: ' . $tag->name)

@section('content')
<div class="container-main py-8">
    <!-- Tag Header -->
    <header class="mb-8">
        <div class="flex items-center gap-4 mb-4">
            <div class="w-16 h-16 rounded-full bg-trama-red/10 flex items-center justify-center">
                <svg class="w-8 h-8 text-trama-red" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
            </div>
            <div>
                <span class="text-gray-500 dark:text-gray-400 text-sm uppercase tracking-wider">Etiqueta</span>
                <h1 class="font-heading text-3xl md:text-4xl font-bold dark:text-white">
                    #{{ $tag->name }}
                </h1>
            </div>
        </div>
        <div class="h-1 rounded-full bg-gradient-to-r from-trama-red to-transparent"></div>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            @if($articles->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 stagger-fade-in">
                @foreach($articles as $article)
                <article class="news-card overflow-hidden group">
                    <a href="{{ route('article.show', $article) }}">
                        <img src="{{ $article->featured_image_url }}"
                             alt="{{ $article->title }}"
                             class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                    </a>
                    <div class="p-4">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="category-tag text-[10px]" style="background-color: {{ $article->category->color }}">
                                {{ $article->category->name }}
                            </span>
                        </div>
                        <h3 class="font-semibold text-lg dark:text-white leading-tight">
                            <a href="{{ route('article.show', $article) }}" class="hover:text-trama-red transition-colors">
                                {{ $article->title }}
                            </a>
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mt-2 line-clamp-2">
                            {{ $article->excerpt }}
                        </p>

                        <!-- Tags -->
                        @if($article->tags->count() > 0)
                        <div class="flex flex-wrap gap-1.5 mt-3">
                            @foreach($article->tags->take(3) as $articleTag)
                            <a href="{{ route('tag', $articleTag) }}"
                               class="text-xs px-2 py-0.5 rounded-full bg-gray-100 dark:bg-dark-accent text-gray-600 dark:text-gray-400 hover:bg-trama-red hover:text-white transition-colors">
                                #{{ $articleTag->name }}
                            </a>
                            @endforeach
                        </div>
                        @endif

                        <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                            <div class="flex items-center gap-2">
                                <img src="{{ $article->author->avatar_url }}"
                                     alt="{{ $article->author->name }}"
                                     class="w-8 h-8 rounded-full object-cover">
                                <span class="text-sm text-gray-600 dark:text-gray-400">{{ $article->author->name }}</span>
                            </div>
                            <time class="text-gray-500 text-xs">{{ $article->published_at->diffForHumans() }}</time>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $articles->links() }}
            </div>
            @else
            <div class="news-card p-8 text-center">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                <h3 class="font-heading text-xl font-bold dark:text-white mb-2">No hay articulos</h3>
                <p class="text-gray-600 dark:text-gray-400">Aun no hay noticias publicadas con esta etiqueta.</p>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <aside class="space-y-8">
            <!-- Categories -->
            <div class="bg-white dark:bg-dark-secondary rounded-lg p-6">
                <h3 class="font-heading font-bold text-lg mb-4 dark:text-white flex items-center gap-2">
                    <span class="w-1 h-6 bg-trama-red rounded-full"></span>
                    Secciones
                </h3>
                <div class="space-y-2">
                    @foreach($categories as $cat)
                    <a href="{{ route('category', $cat) }}"
                       class="flex items-center gap-3 p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-dark-accent transition-colors group">
                        <span class="w-3 h-3 rounded-full" style="background-color: {{ $cat->color }}"></span>
                        <span class="dark:text-white group-hover:text-trama-red transition-colors">{{ $cat->name }}</span>
                    </a>
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
