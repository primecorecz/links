<?php

// config for Primecorecz/Links
return [
    'db' => [
        'links_table' => env('PRIMECORE_LINKS_TABLE', 'magazine.links'),
        'posts_table' => env('PRIMECORE_POSTS_TABLE', 'magazine.posts'),
        'positions_table' => env('PRIMECORE_POSITIONS_TABLE', 'iris.positions'),
    ],
];
