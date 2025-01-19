<?php

use Primecorecz\Links\Models\Link;

it('creates a link', function () {
    Link::factory()->create();

    expect(Link::count())->toBe(1);
});
