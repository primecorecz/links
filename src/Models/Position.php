<?php

namespace Primecorecz\Links\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    public function getTable(): string
    {
        return config('primecore-links.db.positions_table');
    }
}
