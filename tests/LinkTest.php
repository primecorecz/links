<?php

use Primecorecz\Links\Models\Link;
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

    expect($link->linkable_type)->toBe('post');
});

it('has related model', function () {
    $link = Link::factory()->create();
    $post = Post::factory()->create();

    $link->linkable()->associate($post);
    $link->save();

    expect(Link::first()->linkable)->toBeInstanceOf(Post::class);
});
