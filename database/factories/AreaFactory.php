<?php

namespace Primecorecz\Links\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Primecorecz\Links\Models\Area;

class AreaFactory extends Factory
{
    protected $model = Area::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence,
            'slug' => $this->faker->slug,
        ];
    }
}
