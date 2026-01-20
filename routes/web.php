<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ArticleController::class, 'index'])->name('home');
Route::get('/buscar', [ArticleController::class, 'search'])->name('search');
Route::get('/categoria/{category}', [ArticleController::class, 'category'])->name('category');
Route::get('/{article}', [ArticleController::class, 'show'])->name('article.show');
