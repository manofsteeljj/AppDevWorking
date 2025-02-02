<?php

namespace Database\Factories;

use App\Models\CarDesign;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarDesignFactory extends Factory
{
    protected $model = CarDesign::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'model' => $this->faker->year,
            'description' => $this->faker->sentence,
        ];
    }
}
