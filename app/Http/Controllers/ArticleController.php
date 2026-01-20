<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use App\Models\Tag;
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

        $articles = Article::published()
            ->with(['category', 'author'])
            ->when($query, function ($q) use ($query) {
                $q->where(function ($subQuery) use ($query) {
                    $subQuery->where('title', 'like', "%{$query}%")
                        ->orWhere('excerpt', 'like', "%{$query}%")
                        ->orWhere('body', 'like', "%{$query}%");
                });
            })
            ->recent()
            ->paginate(12);

        $categories = Category::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('article.search', compact('articles', 'query', 'categories'));
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
