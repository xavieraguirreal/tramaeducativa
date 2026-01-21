<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use App\Models\Tag;
use App\Services\EmbeddingsService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $featuredArticle = Article::published()
            ->featured()
            ->with(['category', 'author'])
            ->recent()
            ->first();

        $latestArticles = Article::published()
            ->with(['category', 'author'])
            ->recent()
            ->when($featuredArticle, fn($q) => $q->where('id', '!=', $featuredArticle->id))
            ->take(6)
            ->get();

        $categories = Category::where('is_active', true)
            ->orderBy('order')
            ->get();

        $mostViewed = Article::published()
            ->with(['category'])
            ->mostViewed()
            ->take(5)
            ->get();

        return view('home', compact(
            'featuredArticle',
            'latestArticles',
            'categories',
            'mostViewed'
        ));
    }

    public function show(Article $article)
    {
        if ($article->status !== 'published') {
            abort(404);
        }

        $article->incrementViews();
        $article->load(['category', 'author', 'tags']);

        $relatedArticles = Article::published()
            ->where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->with(['category', 'author'])
            ->recent()
            ->take(3)
            ->get();

        $categories = Category::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('article.show', compact('article', 'relatedArticles', 'categories'));
    }

    public function category(Category $category)
    {
        $articles = Article::published()
            ->where('category_id', $category->id)
            ->with(['category', 'author'])
            ->recent()
            ->paginate(12);

        $categories = Category::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('article.category', compact('category', 'articles', 'categories'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q', '');
        $categorySlug = $request->input('categoria');
        $dateFrom = $request->input('desde');
        $dateTo = $request->input('hasta');
        $sort = $request->input('orden', 'recent');
        $searchType = $request->input('tipo', 'text'); // 'text' or 'semantic'

        $categories = Category::where('is_active', true)
            ->orderBy('order')
            ->get();

        $selectedCategory = $categorySlug ? $categories->firstWhere('slug', $categorySlug) : null;
        $semanticResults = null;
        $semanticError = null;

        // Semantic search
        if ($searchType === 'semantic' && $query && strlen($query) >= 3) {
            try {
                $embeddings = app(EmbeddingsService::class);
                $result = $embeddings->searchArticles($query, 20);
                $semanticResults = collect($result['results'])->map(fn($r) => $r['article']);

                return view('article.search', compact(
                    'query',
                    'categories',
                    'selectedCategory',
                    'categorySlug',
                    'dateFrom',
                    'dateTo',
                    'sort',
                    'searchType',
                    'semanticResults'
                ));
            } catch (\Exception $e) {
                $semanticError = 'Error en busqueda semantica. Mostrando resultados de texto.';
                $searchType = 'text';
            }
        }

        // Text search (default)
        $articlesQuery = Article::published()
            ->with(['category', 'author', 'tags']);

        if ($query) {
            $articlesQuery->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('excerpt', 'like', "%{$query}%")
                    ->orWhere('body', 'like', "%{$query}%");
            });
        }

        if ($categorySlug) {
            $articlesQuery->whereHas('category', function ($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }

        if ($dateFrom) {
            $articlesQuery->whereDate('published_at', '>=', $dateFrom);
        }
        if ($dateTo) {
            $articlesQuery->whereDate('published_at', '<=', $dateTo);
        }

        switch ($sort) {
            case 'oldest':
                $articlesQuery->orderBy('published_at', 'asc');
                break;
            case 'views':
                $articlesQuery->orderByDesc('views');
                break;
            case 'recent':
            default:
                $articlesQuery->orderByDesc('published_at');
                break;
        }

        $articles = $articlesQuery->paginate(12);

        return view('article.search', compact(
            'articles',
            'query',
            'categories',
            'selectedCategory',
            'categorySlug',
            'dateFrom',
            'dateTo',
            'sort',
            'searchType',
            'semanticError'
        ));
    }

    public function author(Author $author)
    {
        $articles = Article::published()
            ->where('author_id', $author->id)
            ->with(['category', 'author'])
            ->recent()
            ->paginate(12);

        $categories = Category::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('article.author', compact('author', 'articles', 'categories'));
    }

    public function tag(Tag $tag)
    {
        $articles = Article::published()
            ->whereHas('tags', fn($q) => $q->where('tags.id', $tag->id))
            ->with(['category', 'author', 'tags'])
            ->recent()
            ->paginate(12);

        $categories = Category::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('article.tag', compact('tag', 'articles', 'categories'));
    }
}
