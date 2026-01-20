@extends('layouts.app')

@section('title', $article->title)
@section('meta_description', $article->excerpt)
@section('og_type', 'article')
@section('og_image', $article->featured_image_url)

@section('meta')
<meta property="article:published_time" content="{{ $article->published_at->toISOString() }}">
<meta property="article:author" content="{{ $article->author->name }}">
<meta property="article:section" content="{{ $article->category->name }}">
@endsection

@section('content')
<article class="container-main py-8">
    <!-- Article Header -->
    <header class="max-w-4xl mx-auto mb-8">
        <div class="mb-4">
            <a href="{{ route('category', $article->category) }}"
               class="category-tag"
               style="background-color: {{ $article->category->color }}">
                {{ $article->category->name }}
            </a>
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
            <span>{{ number_format($article->views) }} lecturas</span>
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

    <!-- Article Body -->
    <div class="max-w-3xl mx-auto">
        <div class="prose prose-lg dark:prose-invert max-w-none mb-8">
            {!! nl2br(e($article->body)) !!}
        </div>

        <!-- Share Buttons -->
        <div class="flex items-center gap-4 py-6 border-t border-b border-gray-200 dark:border-gray-700 mb-8">
            <span class="font-medium dark:text-white">Compartir:</span>
            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($article->title) }}"
               target="_blank"
               rel="noopener"
               class="w-10 h-10 rounded-full bg-gray-100 dark:bg-dark-accent flex items-center justify-center hover:bg-trama-red hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                </svg>
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
               target="_blank"
               rel="noopener"
               class="w-10 h-10 rounded-full bg-gray-100 dark:bg-dark-accent flex items-center justify-center hover:bg-trama-red hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
            </a>
            <a href="https://wa.me/?text={{ urlencode($article->title . ' ' . request()->url()) }}"
               target="_blank"
               rel="noopener"
               class="w-10 h-10 rounded-full bg-gray-100 dark:bg-dark-accent flex items-center justify-center hover:bg-trama-red hover:text-white transition-colors">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                </svg>
            </a>
        </div>

        <!-- Author Box -->
        <div class="bg-gray-50 dark:bg-dark-secondary rounded-lg p-6 mb-8">
            <div class="flex items-start gap-4">
                <img src="{{ $article->author->avatar_url }}"
                     alt="{{ $article->author->name }}"
                     class="w-16 h-16 rounded-full object-cover">
                <div>
                    <h3 class="font-heading font-bold text-lg dark:text-white">{{ $article->author->name }}</h3>
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
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($relatedArticles as $related)
            <article class="news-card overflow-hidden">
                <a href="{{ route('article.show', $related) }}">
                    <img src="{{ $related->featured_image_url }}"
                         alt="{{ $related->title }}"
                         class="w-full h-40 object-cover hover:scale-105 transition-transform duration-300">
                </a>
                <div class="p-4">
                    <h3 class="font-semibold dark:text-white leading-tight">
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
