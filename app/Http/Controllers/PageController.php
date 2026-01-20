<?php

namespace App\Http\Controllers;

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
}
