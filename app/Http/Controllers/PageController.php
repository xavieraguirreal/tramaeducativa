<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Author;
use App\Models\Category;

class PageController extends Controller
{
    public function about()
    {
        $categories = Category::where('is_active', true)
            ->orderBy('order')
            ->get();

        $authors = Author::where('is_active', true)->get();

        return view('pages.about', compact('categories', 'authors'));
    }

    public function readingList()
    {
        $categories = Category::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('pages.reading-list', compact('categories'));
    }

    public function rss()
    {
        $articles = Article::published()
            ->with(['category', 'author'])
            ->orderByDesc('published_at')
            ->take(20)
            ->get();

        return response()
            ->view('pages.rss', compact('articles'))
            ->header('Content-Type', 'application/rss+xml; charset=UTF-8');
    }
}
