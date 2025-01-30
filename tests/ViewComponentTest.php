<?php

use Primecorecz\Links\Models\Link;
use Primecorecz\Links\Models\Position;
use Primecorecz\Links\Models\Tag;

it('renders the component', function () {
    $this->blade('<x-primecore::links tag="test" />')->assertSee('Užitečné odkazy:');
});

it('contains tagged links', function () {
    $positionLink = Link::factory()
        ->for(Position::factory(), 'linkable')
        ->has(Tag::factory()->state(['name' => 'test']))
        ->create();

    $this->blade('<x-primecore::links tag="test" />')
        ->assertSee(Position::first()->linkUrl);
});

test('custom url overrides linkable url', function () {
    $positionLink = Link::factory()
        ->state(['url' => fake()->url()])
        ->for(Position::factory(), 'linkable')
        ->has(Tag::factory()->state(['name' => 'test']))
        ->create();

    $this->blade('<x-primecore::links tag="test" />')
        ->assertSee($positionLink->url)
        ->assertDontSee(Position::first()->linkUrl);
});
