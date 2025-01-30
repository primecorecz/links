<?php

namespace Primecorecz\Links\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Primecorecz\Links\Models\Tag;

class TagFactory extends Factory
{
    protected $model = Tag::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'type' => 'microsite',
        ];
    }
}
