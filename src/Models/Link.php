<?php

namespace Primecorecz\Links\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Tags\HasTags;

class Link extends Model
{
    use HasFactory;
    use HasTags;

    protected $guarded = [];

    public function getTable(): string
    {
        return config('primecore-links.db.links_table');
    }

    public function linkable(): MorphTo
    {
        return $this->morphTo();
    }

    public static function getTagClassName(): string
    {
        return Tag::class;
    }

    public function tags(): MorphToMany
    {
        return $this
            ->morphToMany(self::getTagClassName(), 'taggable', config('primecore-links.db.taggables_table'), null, 'tag_id')
            ->orderBy('order_column');
    }
}
