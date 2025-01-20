<?php

// config for Primecorecz/Links
return [
    'db' => [
        'links_table' => env('PRIMECORE_LINKS_TABLE', 'magazine.links'),
        'tags_table' => env('PRIMECORE_TAGS_TABLE', 'magazine.tags'),
        'taggables_table' => env('PRIMECORE_TAGGABLES_TABLE', 'magazine.taggables'),
        'posts_table' => env('PRIMECORE_POSTS_TABLE', 'magazine.posts'),
        'positions_table' => env('PRIMECORE_POSITIONS_TABLE', 'iris.positions'),
    ],
];
