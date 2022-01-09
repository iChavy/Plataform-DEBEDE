<?php

namespace Database\Factories;

use App\Models\Functionality;
use Illuminate\Database\Eloquent\Factories\Factory;

class FunctionalityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Functionality::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Nombre' => $this->faker->unique()->text($maxNbChars = 100),
            'Descripcion' => $this->faker->unique()->text($maxNbChars = 200),
            'borrado' => $this->faker->boolean
        ];
    }
}
