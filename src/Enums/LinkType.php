<?php

declare(strict_types=1);

namespace Primecorecz\Links\Enums;

enum LinkType: string
{
    case Custom = 'custom';
    case Post = 'post';
    case Position = 'position';
    case Area = 'area';
}
