<?php

namespace Primecorecz\Links\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends \Spatie\Tags\Tag
{
    use HasFactory;

    public function getTable(): string
    {
        return config('primecore-links.db.tags_table');
    }
}
