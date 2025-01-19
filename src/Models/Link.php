<?php

namespace Primecorecz\Links\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Primecorecz\Links\Enums\LinkType;

class Link extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function casts(): array
    {
        return [
            'type' => LinkType::class,
        ];
    }

    public function linkable(): MorphTo
    {
        return $this->morphTo();
    }
}
