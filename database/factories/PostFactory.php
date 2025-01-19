<?php

namespace Primecorecz\Links\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Primecorecz\Links\Models\Post;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug,
        ];
    }
}
