<?php

namespace Primecorecz\Links\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Primecorecz\Links\Links
 */
class Links extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Primecorecz\Links\Links::class;
    }
}
