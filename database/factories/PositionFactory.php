<?php

namespace Primecorecz\Links\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Primecorecz\Links\Models\Position;

class PositionFactory extends Factory
{
    protected $model = Position::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug,
        ];
    }
}
