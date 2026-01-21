<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'featured_image',
        'featured_image_caption',
        'category_id',
        'author_id',
        'status',
        'is_featured',
        'views',
        'embedding',
        'embedding_hash',
        'published_at',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeRecent(Builder $query): Builder
    {
        return $query->orderByDesc('published_at');
    }

    public function scopeMostViewed(Builder $query): Builder
    {
        return $query->orderByDesc('views');
    }

    public function getFeaturedImageUrlAttribute(): string
    {
        if ($this->featured_image) {
            if (str_starts_with($this->featured_image, 'http')) {
                return $this->featured_image;
            }
            return asset('storage/' . $this->featured_image);
        }
        return 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=800&h=400&fit=crop';
    }

    public function incrementViews(): void
    {
        $this->increment('views');
    }

    public function getReadingTimeAttribute(): int
    {
        $words = str_word_count(strip_tags($this->body));
        return max(1, ceil($words / 200));
    }

    /**
     * Get formatted body with HTML support
     * Supports: headings, paragraphs, lists, blockquotes, bold, italic, links
     */
    public function getFormattedBodyAttribute(): string
    {
        $body = $this->body;

        // If body contains HTML tags, sanitize and return
        if (preg_match('/<[^>]+>/', $body)) {
            // Allow safe HTML tags
            $allowed = '<h2><h3><h4><p><br><strong><b><em><i><u><a><ul><ol><li><blockquote><hr><span><div>';
            $body = strip_tags($body, $allowed);

            // Add IDs to headings for TOC
            $body = preg_replace_callback(
                '/<(h[2-4])([^>]*)>([^<]+)<\/\1>/i',
                function ($matches) {
                    $tag = $matches[1];
                    $attrs = $matches[2];
                    $text = $matches[3];
                    $id = \Str::slug($text);
                    // Check if already has id
                    if (strpos($attrs, 'id=') === false) {
                        return "<{$tag}{$attrs} id=\"{$id}\">{$text}</{$tag}>";
                    }
                    return $matches[0];
                },
                $body
            );

            return $body;
        }

        // Plain text: convert newlines to paragraphs
        $paragraphs = preg_split('/\n\s*\n/', trim($body));
        $html = '';
        foreach ($paragraphs as $p) {
            $p = trim($p);
            if (!empty($p)) {
                $html .= '<p>' . nl2br(e($p)) . '</p>';
            }
        }

        return $html;
    }
}
