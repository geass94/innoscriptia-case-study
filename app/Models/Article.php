<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'external_id',
        'source',
        'title',
        'description',
        'content',
        'url',
        'image_url',
        'author',
        'category',
        'published_at',
        'content_hash',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function scopeBySource(Builder $query, string|array $source): Builder
    {
        return is_array($source)
            ? $query->whereIn('source', $source)
            : $query->where('source', $source);
    }

    public function scopeByCategory(Builder $query, string|array $category): Builder
    {
        return is_array($category)
            ? $query->whereIn('category', $category)
            : $query->where('category', $category);
    }

    public function scopeByAuthor(Builder $query, string|array $author): Builder
    {
        return is_array($author)
            ? $query->whereIn('author', $author)
            : $query->where('author', $author);
    }

    public function scopeByDateRange(Builder $query, ?string $from = null, ?string $to = null): Builder
    {
        if ($from) {
            $query->where('published_at', '>=', $from);
        }
        if ($to) {
            $query->where('published_at', '<=', $to);
        }

        return $query;
    }

    public function scopeSearch(Builder $query, ?string $keyword = null): Builder
    {
        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                    ->orWhere('description', 'like', "%{$keyword}%")
                    ->orWhere('content', 'like', "%{$keyword}%");
            });
        }

        return $query;
    }

    public static function generateContentHash(string $title, string $url, ?string $publishedAt = null): string
    {
        return hash('sha256', $title.'|'.$url.'|'.($publishedAt ?? ''));
    }
}
