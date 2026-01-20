@extends('layouts.app')

@section('title', $query ? 'Buscar: ' . $query : 'Buscar')

@section('content')
<div class="container-main py-8">
    <!-- Search Header -->
    <header class="mb-8">
        <h1 class="font-heading text-3xl md:text-4xl font-bold dark:text-white mb-4">
            @if($query)
            Resultados para: <span class="text-trama-red">"{{ $query }}"</span>
            @else
            Buscar noticias
            @endif
        </h1>

        <!-- Search Form -->
        <form action="{{ route('search') }}" method="GET" class="max-w-2xl">
            <div class="relative">
                <input type="text"
                       name="q"
                       value="{{ $query }}"
                       placeholder="Buscar noticias..."
                       class="w-full px-6 py-4 rounded-lg border border-gray-200 dark:border-gray-700 bg-white dark:bg-dark-secondary text-dark-primary dark:text-white focus:outline-none focus:ring-2 focus:ring-trama-red focus:border-transparent">
                <button type="submit"
                        class="absolute right-2 top-1/2 -translate-y-1/2 bg-trama-red text-white px-6 py-2 rounded-lg hover:bg-trama-red-dark transition-colors">
                    Buscar
                </button>
            </div>
        </form>

        @if($query)
        <p class="text-gray-600 dark:text-gray-400 mt-4">
            Se encontraron {{ $articles->total() }} resultado(s)
        </p>
        @endif
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            @if($articles->count() > 0)
            <div class="space-y-6">
                @foreach($articles as $article)
                <article class="news-card p-4 flex gap-4">
                    <a href="{{ route('article.show', $article) }}" class="flex-shrink-0">
                        <img src="{{ $article->featured_image_url }}"
                             alt="{{ $article->title }}"
                             class="w-40 h-28 object-cover rounded">
                    </a>
                    <div class="flex-1">
                        <a href="{{ route('category', $article->category) }}"
                           class="text-xs font-semibold uppercase"
                           style="color: {{ $article->category->color }}">
                            {{ $article->category->name }}
                        </a>
                        <h3 class="font-semibold text-lg dark:text-white mt-1 leading-tight">
                            <a href="{{ route('article.show', $article) }}" class="hover:text-trama-red transition-colors">
                                {{ $article->title }}
                            </a>
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mt-2 line-clamp-2">
                            {{ $article->excerpt }}
                        </p>
                        <div class="flex items-center gap-4 mt-3 text-sm text-gray-500">
                            <span>{{ $article->author->name }}</span>
                            <span>|</span>
                            <time>{{ $article->published_at->diffForHumans() }}</time>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $articles->appends(['q' => $query])->links() }}
            </div>
            @else
            <div class="news-card p-8 text-center">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                @if($query)
                <h3 class="font-heading text-xl font-bold dark:text-white mb-2">No se encontraron resultados</h3>
                <p class="text-gray-600 dark:text-gray-400">No hay noticias que coincidan con tu busqueda "{{ $query }}".</p>
                <p class="text-gray-500 text-sm mt-2">Intenta con otras palabras clave.</p>
                @else
                <h3 class="font-heading text-xl font-bold dark:text-white mb-2">Ingresa un termino de busqueda</h3>
                <p class="text-gray-600 dark:text-gray-400">Escribe lo que buscas en el campo de arriba.</p>
                @endif
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <aside class="space-y-8">
            <!-- Categories -->
            <div class="bg-white dark:bg-dark-secondary rounded-lg p-6">
                <h3 class="font-heading font-bold text-lg mb-4 dark:text-white flex items-center gap-2">
                    <span class="w-1 h-6 bg-trama-red rounded-full"></span>
                    Buscar por Seccion
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
