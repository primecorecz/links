<?php

namespace Primecorecz\Links\Contracts;

use Illuminate\Database\Eloquent\Casts\Attribute;

interface Linkable
{
    public function linkTitle(): Attribute;

    public function linkUrl(): Attribute;
}
