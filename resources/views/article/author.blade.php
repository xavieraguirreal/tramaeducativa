@extends('layouts.app')

@section('title', $author->name)

@section('meta')
<meta name="description" content="{{ $author->bio }}">
<meta property="og:title" content="{{ $author->name }} - Trama Educativa">
<meta property="og:description" content="{{ $author->bio }}">
<meta property="og:type" content="profile">
@endsection

@section('content')
<div class="container-main py-8">
    <!-- Author Header -->
    <header class="mb-8">
        <div class="bg-white dark:bg-dark-secondary rounded-lg p-6 md:p-8">
            <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                <img src="{{ $author->avatar_url }}"
                     alt="{{ $author->name }}"
                     class="w-32 h-32 rounded-full object-cover border-4 border-trama-red">
                <div class="text-center md:text-left">
                    <h1 class="font-heading text-3xl md:text-4xl font-bold dark:text-white">
                        {{ $author->name }}
                    </h1>
                    @if($author->bio)
                    <p class="text-gray-600 dark:text-gray-400 mt-3 max-w-2xl">
                        {{ $author->bio }}
                    </p>
                    @endif
                    <div class="flex flex-wrap items-center justify-center md:justify-start gap-4 mt-4">
                        @if($author->email)
                        <a href="mailto:{{ $author->email }}" class="text-gray-500 hover:text-trama-red transition-colors flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            {{ $author->email }}
                        </a>
                        @endif
                        @if($author->social_links && isset($author->social_links['twitter']))
                        <a href="https://twitter.com/{{ ltrim($author->social_links['twitter'], '@') }}"
                           target="_blank"
                           rel="noopener"
                           class="text-gray-500 hover:text-trama-red transition-colors flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                            {{ $author->social_links['twitter'] }}
                        </a>
                        @endif
                    </div>
                    <p class="text-sm text-gray-500 mt-4">
                        {{ $articles->total() }} articulo(s) publicado(s)
                    </p>
                </div>
            </div>
        </div>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <h2 class="font-heading text-2xl font-bold dark:text-white mb-6 flex items-center gap-2">
                <span class="w-1 h-8 bg-trama-red rounded-full"></span>
                Articulos de {{ $author->name }}
            </h2>

            @if($articles->count() > 0)
            <div class="space-y-6">
                @foreach($articles as $article)
                <article class="news-card p-4 flex gap-4">
                    <a href="{{ route('article.show', $article) }}" class="flex-shrink-0">
                        <img src="{{ $article->featured_image_url }}"
                             alt="{{ $article->title }}"
                             class="w-40 h-28 object-cover rounded hover:opacity-90 transition-opacity">
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
                            <time>{{ $article->published_at->format('d M, Y') }}</time>
                            <span>|</span>
                            <span>{{ $article->reading_time }} min lectura</span>
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h3 class="font-heading text-xl font-bold dark:text-white mb-2">Sin articulos</h3>
                <p class="text-gray-600 dark:text-gray-400">Este autor aun no tiene articulos publicados.</p>
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
