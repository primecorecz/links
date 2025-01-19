<?php

namespace Primecorecz\Links\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function getTable(): string
    {
        return config('primecore-links.db.posts_table');
    }
}
