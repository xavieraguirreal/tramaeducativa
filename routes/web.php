<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ArticleController::class, 'index'])->name('home');
Route::get('/buscar', [ArticleController::class, 'search'])->name('search');
Route::get('/sobre-nosotros', [PageController::class, 'about'])->name('about');
Route::get('/mi-lista', [PageController::class, 'readingList'])->name('reading-list');
Route::get('/rss', [PageController::class, 'rss'])->name('rss');
Route::get('/categoria/{category}', [ArticleController::class, 'category'])->name('category');
Route::get('/autor/{author}', [ArticleController::class, 'author'])->name('author');
Route::get('/etiqueta/{tag}', [ArticleController::class, 'tag'])->name('tag');
Route::get('/{article}', [ArticleController::class, 'show'])->name('article.show');
