<?php

namespace Database\Factories;

use App\Models\AgeRestriction;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgeRestrictionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AgeRestriction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Tipo_restriccion' => $this->faker->unique()->text($maxNbChars = 40),
            'borrado' => $this->faker->boolean,
            'Edad' => $this->faker->numberBetween($min = 0, $max = 17)
        ];
    }
}
