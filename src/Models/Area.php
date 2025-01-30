<?php

namespace Primecorecz\Links\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Primecorecz\Links\Contracts\Linkable;

/**
 * @property string $name
 * @property string $slug
 */
class Area extends Model implements Linkable
{
    use HasFactory;

    public function getTable(): string
    {
        return config('primecore-links.db.areas_table');
    }

    public function linkTitle(): Attribute
    {
        return Attribute::get(fn () => "Nabídky práce {$this->name}");
    }

    public function linkUrl(): Attribute
    {
        return Attribute::get(fn () => "https://personalka.cz/prace/{$this->slug}");
    }
}
