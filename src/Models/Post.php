<?php

namespace Primecorecz\Links\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Primecorecz\Links\Contracts\Linkable;

/**
 * @property string $title
 * @property string $slug
 */
class Post extends Model implements Linkable
{
    use HasFactory;

    public function scopeIsPublished(Builder $query): void
    {
        $query
            ->where('draft', 0)
            ->where('published_at', '<', now());
    }

    public function getTable(): string
    {
        return config('primecore-links.db.posts_table');
    }

    public function linkTitle(): Attribute
    {
        return Attribute::get(fn () => $this->title);
    }

    public function linkUrl(): Attribute
    {
        return Attribute::get(fn () => "https://magazin.personalka.cz/clanky/{$this->slug}");
    }
}
