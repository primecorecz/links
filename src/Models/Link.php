<?php

namespace Primecorecz\Links\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;
use Spatie\Tags\HasTags;

/**
 * @property string $title
 * @property string $url
 * @property ?string $linkable_type
 */
class Link extends Model
{
    use HasFactory;
    use HasTags;

    public const string TAG_TYPE = 'microsite';

    public const int PER_GROUP = 4;

    protected $guarded = [];

    public function getTable(): string
    {
        return config('primecore-links.db.links_table', 'magazin.links');
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

    protected function titleOrLinkableTitle(): Attribute
    {
        // @phpstan-ignore property.notFound
        return Attribute::get(fn () => $this->attributes['title'] ?? $this->linkable?->linkTitle);
    }

    protected function urlOrLinkableUrl(): Attribute
    {
        // @phpstan-ignore property.notFound
        return Attribute::get(fn () => $this->attributes['url'] ?? $this->linkable?->linkUrl);
    }

    protected function type(): Attribute
    {
        return Attribute::get(fn () => match ($this->linkable_type) {
            'magazine_post' => 'post',
            'iris_area' => 'area',
            'iris_position' => 'position',
            default => 'custom',
        });
    }

    public static function prepareViewData(Tag|string $tag, int $linksPerGroup = 4): Collection
    {
        $links = static::query()
            ->withAnyTags($tag, static::TAG_TYPE)
            ->with('linkable')
            ->inRandomOrder()
            ->get()
            ->groupBy('type')

            // Add latests posts when not enough predefined posts
            ->tap(function (Collection $collection) use ($linksPerGroup): void {
                $predefinedPostLinks = $collection->get('post') ?? new Collection;

                $latestsPostLinks = Post::query()
                    ->isPublished()
                    ->whereNotIn('id', $predefinedPostLinks->pluck('linkable_id'))
                    ->orderBy('published_at', 'desc')
                    ->limit($linksPerGroup)
                    ->get()
                    ->map(fn (Post $post) => new Link([
                        'title' => $post->linkTitle,
                        'url' => $post->linkUrl,
                    ]));

                $collection->put(
                    'post',
                    $predefinedPostLinks
                        // Cannot merge two Eloquent collections, convert to base Collection
                        // https://laraveldaily.com/tip/merging-eloquent-collections
                        ->toBase()
                        // @phpstan-ignore argument.type
                        ->merge($latestsPostLinks)
                );
            })

            // Limit number of links per group
            ->map(fn (Collection $group) => $group
                ->take($linksPerGroup)
            )

            // Display in order
            ->sortBy(fn ($group, $key) => match ($key) {
                'position' => 1,
                'area' => 2,
                'post' => 3,
                default => 4,
            });

        return $links;
    }
}
