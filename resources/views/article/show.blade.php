@extends('layouts.app')

@section('title', $article->title)
@section('meta_description', $article->excerpt)
@section('og_type', 'article')
@section('og_image', $article->featured_image_url)
@section('show_progress', true)

@section('meta')
<meta property="article:published_time" content="{{ $article->published_at->toISOString() }}">
<meta property="article:author" content="{{ $article->author->name }}">
<meta property="article:section" content="{{ $article->category->name }}">
@endsection

@section('content')
<article class="container-main py-8">
    <!-- Article Header -->
    <header class="max-w-4xl mx-auto mb-8">
        <!-- Breadcrumb -->
        <nav class="breadcrumbs mb-4" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">
                <svg class="w-4 h-4 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="sr-only">Inicio</span>
            </a>
            <span class="separator">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </span>
            <a href="{{ route('category', $article->category) }}">{{ $article->category->name }}</a>
            <span class="separator">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </span>
            <span class="current" title="{{ $article->title }}">{{ Str::limit($article->title, 40) }}</span>
        </nav>

        <div class="flex items-start justify-between gap-4 mb-4">
            <a href="{{ route('category', $article->category) }}"
               class="category-tag"
               style="background-color: {{ $article->category->color }}">
                {{ $article->category->name }}
            </a>

            <!-- Bookmark Button -->
            <div x-data="bookmark({ slug: '{{ $article->slug }}', title: '{{ addslashes($article->title) }}', image: '{{ $article->featured_image_url }}', category: '{{ $article->category->name }}' })">
                <button @click="toggle()"
                        class="bookmark-btn"
                        :class="{ 'saved': saved }"
                        :title="saved ? 'Quitar de mi lista' : 'Guardar para leer despues'">
                    <svg x-show="!saved" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                    </svg>
                    <svg x-show="saved" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                    </svg>
                </button>
            </div>
        </div>

        <h1 class="font-heading text-3xl md:text-4xl lg:text-5xl font-bold dark:text-white leading-tight mb-4">
            {{ $article->title }}
        </h1>

        <p class="text-xl text-gray-600 dark:text-gray-400 mb-6">
            {{ $article->excerpt }}
        </p>

        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 dark:text-gray-400 pb-6 border-b border-gray-200 dark:border-gray-700">
            <a href="{{ route('author', $article->author) }}" class="flex items-center gap-2 hover:opacity-80 transition-opacity">
                <img src="{{ $article->author->avatar_url }}"
                     alt="{{ $article->author->name }}"
                     class="w-10 h-10 rounded-full object-cover">
                <div>
                    <span class="font-medium dark:text-white hover:text-trama-red transition-colors">{{ $article->author->name }}</span>
                    @if($article->author->bio)
                    <p class="text-xs text-gray-500">{{ Str::limit($article->author->bio, 50) }}</p>
                    @endif
                </div>
            </a>
            <span class="text-gray-300 dark:text-gray-600">|</span>
            <time datetime="{{ $article->published_at->toISOString() }}">
                {{ $article->published_at->format('d M, Y - H:i') }} hs
            </time>
            <span class="text-gray-300 dark:text-gray-600">|</span>
            <span>{{ $article->reading_time }} min de lectura</span>
            <span class="text-gray-300 dark:text-gray-600">|</span>
            <span class="flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                {{ number_format($article->views) }}
            </span>
        </div>
    </header>

    <!-- Featured Image -->
    <figure class="max-w-4xl mx-auto mb-8">
        <img src="{{ $article->featured_image_url }}"
             alt="{{ $article->title }}"
             class="w-full h-auto rounded-lg shadow-lg">
        @if($article->featured_image_caption)
        <figcaption class="text-sm text-gray-500 dark:text-gray-400 mt-2 text-center">
            {{ $article->featured_image_caption }}
        </figcaption>
        @endif
    </figure>

    <!-- Audio TTS Player -->
    <div class="max-w-4xl mx-auto mb-6"
         x-data="ttsPlayer()"
         x-init="init()">
        <div class="tts-player">
            <button @click="togglePlay()"
                    class="tts-btn"
                    :class="{ 'playing': isPlaying }">
                <svg x-show="!isPlaying" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8 5v14l11-7z"/>
                </svg>
                <svg x-show="isPlaying" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/>
                </svg>
            </button>
            <div class="flex-1">
                <div class="flex items-center justify-between mb-1">
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                        <span x-show="!isPlaying && !isPaused">Escuchar artículo</span>
                        <span x-show="isPlaying">Reproduciendo...</span>
                        <span x-show="isPaused && !isPlaying">Pausado</span>
                    </span>
                    <span class="text-xs text-gray-500" x-text="progressText"></span>
                </div>
                <div class="tts-progress">
                    <div class="tts-progress-bar" :style="'width: ' + progress + '%'"></div>
                </div>
            </div>
            <button @click="stop()"
                    x-show="isPlaying || isPaused"
                    class="p-2 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 transition-colors"
                    title="Detener">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M6 6h12v12H6z"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Article Body with TOC -->
    <div class="max-w-4xl mx-auto" x-data="tableOfContents()">
        <div class="lg:flex lg:gap-8">
            <!-- TOC Sidebar (Desktop) -->
            <aside class="hidden lg:block lg:w-64 lg:flex-shrink-0">
                <div class="sticky top-24">
                    <nav x-show="headings.length > 0" class="toc-nav">
                        <h4 class="font-heading font-bold text-sm uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-3 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                            </svg>
                            Contenido
                        </h4>
                        <ul class="space-y-2 text-sm">
                            <template x-for="(heading, index) in headings" :key="index">
                                <li :class="{ 'pl-4': heading.level === 3 }">
                                    <a :href="'#' + heading.id"
                                       @click.prevent="scrollToHeading(heading.id)"
                                       class="toc-link"
                                       :class="{ 'active': activeId === heading.id }"
                                       x-text="heading.text">
                                    </a>
                                </li>
                            </template>
                        </ul>
                    </nav>
                </div>
            </aside>

            <!-- TOC Mobile (Collapsible) -->
            <div x-show="headings.length > 0" class="lg:hidden mb-6">
                <div class="bg-gray-50 dark:bg-dark-secondary rounded-lg overflow-hidden">
                    <button @click="tocOpen = !tocOpen"
                            class="w-full px-4 py-3 flex items-center justify-between text-left font-medium dark:text-white">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                            </svg>
                            Contenido del artículo
                        </span>
                        <svg class="w-5 h-5 transition-transform" :class="{ 'rotate-180': tocOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="tocOpen" x-collapse>
                        <ul class="px-4 pb-4 space-y-2 text-sm">
                            <template x-for="(heading, index) in headings" :key="index">
                                <li :class="{ 'pl-4': heading.level === 3 }">
                                    <a :href="'#' + heading.id"
                                       @click.prevent="scrollToHeading(heading.id); tocOpen = false"
                                       class="text-gray-600 dark:text-gray-400 hover:text-trama-red dark:hover:text-trama-red transition-colors"
                                       x-text="heading.text">
                                    </a>
                                </li>
                            </template>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1 min-w-0">
                <div id="article-content" class="prose prose-lg dark:prose-invert max-w-none mb-8 prose-headings:scroll-mt-24">
                    {!! $article->formatted_body !!}
                </div>
            </div>
        </div>

        <!-- Tags -->
        @if($article->tags->count() > 0)
        <div class="flex flex-wrap items-center gap-2 py-6 border-t border-gray-200 dark:border-gray-700">
            <span class="text-gray-500 dark:text-gray-400 text-sm mr-1">
                <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                Etiquetas:
            </span>
            @foreach($article->tags as $tag)
            <a href="{{ route('tag', $tag) }}"
               class="px-3 py-1 text-sm rounded-full bg-gray-100 dark:bg-dark-accent text-gray-700 dark:text-gray-300 hover:bg-trama-red hover:text-white transition-colors">
                #{{ $tag->name }}
            </a>
            @endforeach
        </div>
        @endif

        <!-- Reactions Section -->
        <div class="py-8 border-t border-gray-200 dark:border-gray-700" x-data="reactions({{ $article->id }})">
            <h3 class="font-heading font-bold text-lg dark:text-white mb-4 text-center">¿Que te parecio esta nota?</h3>
            <div class="flex flex-wrap justify-center gap-4">
                <button class="reaction-btn"
                        data-reaction-article="{{ $article->id }}"
                        data-reaction-type="informative"
                        @click="react('informative', $event)">
                    <span class="emoji">📰</span>
                    <span class="text-xs text-gray-600 dark:text-gray-400">Informativo</span>
                    <span class="count text-xs font-semibold text-gray-500">0</span>
                </button>
                <button class="reaction-btn"
                        data-reaction-article="{{ $article->id }}"
                        data-reaction-type="love"
                        @click="react('love', $event)">
                    <span class="emoji">❤️</span>
                    <span class="text-xs text-gray-600 dark:text-gray-400">Me gusta</span>
                    <span class="count text-xs font-semibold text-gray-500">0</span>
                </button>
                <button class="reaction-btn"
                        data-reaction-article="{{ $article->id }}"
                        data-reaction-type="important"
                        @click="react('important', $event)">
                    <span class="emoji">🔥</span>
                    <span class="text-xs text-gray-600 dark:text-gray-400">Importante</span>
                    <span class="count text-xs font-semibold text-gray-500">0</span>
                </button>
                <button class="reaction-btn"
                        data-reaction-article="{{ $article->id }}"
                        data-reaction-type="think"
                        @click="react('think', $event)">
                    <span class="emoji">🤔</span>
                    <span class="text-xs text-gray-600 dark:text-gray-400">Para pensar</span>
                    <span class="count text-xs font-semibold text-gray-500">0</span>
                </button>
            </div>
        </div>

        <!-- Share Buttons -->
        <div class="flex flex-wrap items-center justify-center gap-3 py-6 border-t border-b border-gray-200 dark:border-gray-700 mb-8">
            <span class="font-medium dark:text-white mr-2">Compartir:</span>
            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($article->title) }}"
               target="_blank"
               rel="noopener"
               class="w-10 h-10 rounded-full bg-gray-100 dark:bg-dark-accent flex items-center justify-center hover:bg-[#1DA1F2] hover:text-white transition-all duration-200 hover:scale-110">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                </svg>
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
               target="_blank"
               rel="noopener"
               class="w-10 h-10 rounded-full bg-gray-100 dark:bg-dark-accent flex items-center justify-center hover:bg-[#1877F2] hover:text-white transition-all duration-200 hover:scale-110">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
            </a>
            <a href="https://wa.me/?text={{ urlencode($article->title . ' ' . request()->url()) }}"
               target="_blank"
               rel="noopener"
               class="w-10 h-10 rounded-full bg-gray-100 dark:bg-dark-accent flex items-center justify-center hover:bg-[#25D366] hover:text-white transition-all duration-200 hover:scale-110">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
            </a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode($article->title) }}"
               target="_blank"
               rel="noopener"
               class="w-10 h-10 rounded-full bg-gray-100 dark:bg-dark-accent flex items-center justify-center hover:bg-[#0A66C2] hover:text-white transition-all duration-200 hover:scale-110">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                </svg>
            </a>
            <button onclick="navigator.clipboard.writeText('{{ request()->url() }}'); showToast('Link copiado al portapapeles')"
                    class="w-10 h-10 rounded-full bg-gray-100 dark:bg-dark-accent flex items-center justify-center hover:bg-trama-red hover:text-white transition-all duration-200 hover:scale-110"
                    title="Copiar link">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/>
                </svg>
            </button>
        </div>

        <!-- Author Box -->
        <div class="bg-gray-50 dark:bg-dark-secondary rounded-lg p-6 mb-8">
            <div class="flex items-start gap-4">
                <a href="{{ route('author', $article->author) }}">
                    <img src="{{ $article->author->avatar_url }}"
                         alt="{{ $article->author->name }}"
                         class="w-16 h-16 rounded-full object-cover hover:opacity-80 transition-opacity">
                </a>
                <div>
                    <a href="{{ route('author', $article->author) }}">
                        <h3 class="font-heading font-bold text-lg dark:text-white hover:text-trama-red transition-colors">{{ $article->author->name }}</h3>
                    </a>
                    @if($article->author->bio)
                    <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $article->author->bio }}</p>
                    @endif
                    @if($article->author->social_links)
                    <div class="flex gap-3 mt-3">
                        @if(isset($article->author->social_links['twitter']))
                        <a href="https://twitter.com/{{ ltrim($article->author->social_links['twitter'], '@') }}"
                           target="_blank"
                           rel="noopener"
                           class="text-gray-400 hover:text-trama-red transition-colors">
                            {{ $article->author->social_links['twitter'] }}
                        </a>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Related Articles -->
    @if($relatedArticles->count() > 0)
    <section class="max-w-4xl mx-auto mt-12">
        <h2 class="font-heading text-2xl font-bold dark:text-white mb-6 flex items-center gap-2">
            <span class="w-1 h-8 bg-trama-red rounded-full"></span>
            Tambien te puede interesar
            @if($relatedWithAI ?? false)
            <span class="text-xs font-normal px-2 py-1 bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 rounded-full ml-2">
                IA
            </span>
            @endif
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($relatedArticles as $item)
            @php
                $related = isset($item['article']) ? $item['article'] : $item;
                $similarity = isset($item['similarity_percent']) ? $item['similarity_percent'] : null;
            @endphp
            <article class="news-card overflow-hidden group">
                <a href="{{ route('article.show', $related) }}" class="block overflow-hidden relative">
                    <img src="{{ $related->featured_image_url }}"
                         alt="{{ $related->title }}"
                         class="w-full h-40 object-cover group-hover:scale-110 transition-transform duration-500">
                    @if($similarity)
                    <span class="absolute bottom-2 right-2 bg-purple-600 text-white text-xs px-2 py-0.5 rounded-full font-medium">
                        {{ $similarity }}
                    </span>
                    @endif
                </a>
                <div class="p-4">
                    <h3 class="font-semibold dark:text-white leading-tight bento-title">
                        <a href="{{ route('article.show', $related) }}" class="hover:text-trama-red transition-colors">
                            {{ Str::limit($related->title, 60) }}
                        </a>
                    </h3>
                    <time class="text-gray-500 text-xs mt-2 block">{{ $related->published_at->diffForHumans() }}</time>
                </div>
            </article>
            @endforeach
        </div>
    </section>
    @endif
</article>
@endsection
