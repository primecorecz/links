<?php

use Primecorecz\Links\Models\Link;

it('creates a link', function () {
    Link::factory()->create();

    expect(Link::count())->toBe(1);
});

it('registers config', function () {
    expect(config('primecore-links.db'))->toHaveKeys(['links_table', 'posts_table', 'positions_table']);
});
