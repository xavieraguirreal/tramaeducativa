@php
    // Obtener artículos destacados recientes para el ticker
    $tickerArticles = \App\Models\Article::published()
        ->featured()
        ->with('category')
        ->orderByDesc('published_at')
        ->take(5)
        ->get();

    // Si no hay destacados, mostrar los más recientes
    if ($tickerArticles->isEmpty()) {
        $tickerArticles = \App\Models\Article::published()
            ->with('category')
            ->orderByDesc('published_at')
            ->take(5)
            ->get();
    }
@endphp

@if($tickerArticles->isNotEmpty())
<div class="breaking-news-ticker bg-trama-red text-white overflow-hidden"
     x-data="{ paused: false }"
     @mouseenter="paused = true"
     @mouseleave="paused = false">
    <div class="container-main flex items-center">
        <!-- Label -->
        <div class="flex-shrink-0 flex items-center gap-2 py-2 pr-4 border-r border-white/20 mr-4">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
            </span>
            <span class="font-bold text-sm uppercase tracking-wide">Destacado</span>
        </div>

        <!-- Ticker Content -->
        <div class="flex-1 overflow-hidden">
            <div class="ticker-content flex items-center gap-8"
                 :class="{ 'paused': paused }">
                @foreach($tickerArticles as $article)
                <a href="{{ route('article.show', $article) }}"
                   class="ticker-item flex items-center gap-3 whitespace-nowrap hover:underline py-2">
                    <span class="text-white/60 text-xs font-medium uppercase">{{ $article->category->name }}</span>
                    <span class="text-sm font-medium">{{ Str::limit($article->title, 80) }}</span>
                </a>
                @endforeach
                <!-- Duplicamos para loop continuo -->
                @foreach($tickerArticles as $article)
                <a href="{{ route('article.show', $article) }}"
                   class="ticker-item flex items-center gap-3 whitespace-nowrap hover:underline py-2">
                    <span class="text-white/60 text-xs font-medium uppercase">{{ $article->category->name }}</span>
                    <span class="text-sm font-medium">{{ Str::limit($article->title, 80) }}</span>
                </a>
                @endforeach
            </div>
        </div>

        <!-- Close Button (opcional) -->
        <button class="flex-shrink-0 p-2 ml-2 hover:bg-white/10 rounded transition-colors hidden"
                onclick="this.closest('.breaking-news-ticker').remove()"
                title="Cerrar">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
</div>
@endif
