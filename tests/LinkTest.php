<?php

use Primecorecz\Links\Models\Area;
use Primecorecz\Links\Models\Link;
use Primecorecz\Links\Models\Position;
use Primecorecz\Links\Models\Post;

it('creates a link', function () {
    Link::factory()->create();

    expect(Link::count())->toBe(1);
});

it('registers config', function () {
    expect(config('primecore-links.db'))->toHaveKeys(['links_table', 'posts_table', 'positions_table']);
});

it('registers morph map', function () {
    $link = Link::factory()->create();
    $post = Post::factory()->create();

    $link->linkable()->associate($post);
    $link->save();

    expect($link->linkable_type)->toBe('magazine_post');
});

it('has related model', function () {
    $link = Link::factory()
        ->for(Post::factory(), 'linkable')
        ->create();

    expect(Link::first()->linkable)->toBeInstanceOf(Post::class);
});

it('has link type attribute', function () {
    $postLink = Link::factory()
        ->for(Post::factory(), 'linkable')
        ->create();

    $positionLink = Link::factory()
        ->for(Position::factory(), 'linkable')
        ->create();

    $areaLink = Link::factory()
        ->for(Area::factory(), 'linkable')
        ->create();

    $customLink = Link::factory()->create();

    expect($postLink->type)->toBe('post');
    expect($positionLink->type)->toBe('position');
    expect($areaLink->type)->toBe('area');
    expect($customLink->type)->toBe('custom');
});
