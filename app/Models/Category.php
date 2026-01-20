<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'color',
        'description',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function publishedArticles(): HasMany
    {
        return $this->hasMany(Article::class)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->orderByDesc('published_at');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public static function active()
    {
        return static::where('is_active', true)->orderBy('order')->get();
    }
}
