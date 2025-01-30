<?php

use Primecorecz\Links\Models\Area;
use Primecorecz\Links\Models\Link;
use Primecorecz\Links\Models\Position;
use Primecorecz\Links\Models\Post;
use Primecorecz\Links\Models\Tag;

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

describe('prepareViewData', function () {

    it('returns collection', function () {
        expect(Link::prepareViewData(tag: 'test'))->toBeInstanceOf(\Illuminate\Support\Collection::class);
    });

    it('contains tagged links', function () {
        $positionLink = Link::factory()
            ->for(Position::factory(), 'linkable')
            ->has(Tag::factory()->state(['name' => 'test']))
            ->create();

        expect(Link::prepareViewData(tag: 'test')
            ->flatten()
        )->toContainModel($positionLink);
    });

    it('does not contains other tagged links', function () {
        $positionLink = Link::factory()
            ->for(Position::factory(), 'linkable')
            ->has(Tag::factory()->state(['name' => 'test']))
            ->create();

        expect(Link::prepareViewData(tag: 'other')
            ->flatten()
        )->not()->toContainModel($positionLink);
    });

    it('groups links by type', function () {

        $tag = Tag::factory()->state(['name' => 'test'])->create();

        $postLink = Link::factory()
            ->for(Post::factory(), 'linkable')
            ->hasAttached($tag)
            ->create();

        $positionLink = Link::factory()
            ->for(Position::factory(), 'linkable')
            ->hasAttached($tag)
            ->create();

        $areaLink = Link::factory()
            ->for(Area::factory(), 'linkable')
            ->hasAttached($tag)
            ->create();

        $customLink = Link::factory()
            ->hasAttached($tag)
            ->create();

        expect(Link::prepareViewData(tag: 'test')->keys())->toContain('post', 'position', 'area', 'custom');

    });

    it('sorts groups in order', function () {

        $tag = Tag::factory()->state(['name' => 'test'])->create();

        $areaLink = Link::factory()
            ->for(Area::factory(), 'linkable')
            ->hasAttached($tag)
            ->create();

        $customLink = Link::factory()
            ->hasAttached($tag)
            ->create();

        $positionLink = Link::factory()
            ->for(Position::factory(), 'linkable')
            ->hasAttached($tag)
            ->create();

        expect(Link::prepareViewData(tag: 'test')->keys())->toMatchArray(['position', 'area', 'post',  'custom']);

    });

    it('omits empty groups', function () {

        $positionLink = Link::factory()
            ->for(Position::factory(), 'linkable')
            ->has(Tag::factory()->state(['name' => 'test']))
            ->create();

        expect(Link::prepareViewData(tag: 'test')->keys())->not()->toContain('area');

    });

    it('creates latest posts group when no predefined posts', function () {
        $post = Post::factory()->create();

        expect(Link::prepareViewData(tag: 'test')->get('post'))->not()->toBeNull();

        expect(Link::prepareViewData(tag: 'test')->get('post')->pluck('url'))->toContain($post->linkUrl);
    });

    it('appends latest posts when not enough predefined posts', function () {
        $postLink = Link::factory()
            ->state(['url' => null])
            ->for(Post::factory()->state(['slug' => 'linked-post']), 'linkable')
            ->has(Tag::factory()->state(['name' => 'test']))
            ->create();

        // $otherPost = Post::factory()->state(['slug' => 'other-post'])->create();
        Post::factory()->count(3)->create();

        expect(Link::prepareViewData(tag: 'test')
            ->get('post')
            ->pluck('urlOrLinkableUrl')
        )->toContain(
            ...Post::all()->pluck('linkUrl')
        );
    });

    it('limits links per group', function () {
        $tag = Tag::factory()->state(['name' => 'test'])->create();

        Link::factory()
            ->for(Position::factory(), 'linkable')
            ->hasAttached($tag)
            ->count(5)
            ->create();

        expect(Link::prepareViewData(tag: 'test')->get('position'))->toHaveCount(4);
    });

});
