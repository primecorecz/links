<?php

// config for Primecorecz/Links
return [
    'db' => [
        'links_table' => env('PRIMECORE_LINKS_TABLE', 'magazin.links'),
        'tags_table' => env('PRIMECORE_TAGS_TABLE', 'magazin.tags'),
        'taggables_table' => env('PRIMECORE_TAGGABLES_TABLE', 'magazin.taggables'),
        'posts_table' => env('PRIMECORE_POSTS_TABLE', 'magazin.posts'),
        'positions_table' => env('PRIMECORE_POSITIONS_TABLE', 'iris.positions'),
        'areas_table' => env('PRIMECORE_AREAS_TABLE', 'iris.areas'),
    ],
];
