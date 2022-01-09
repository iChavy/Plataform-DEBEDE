<?php

namespace Database\Factories;

use App\Models\Game;

use App\Models\User;
use App\Models\AgeRestriction;


use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Game::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Nombre' => $this->faker->unique()->text($maxNbChars = 100),
            'Numero_Ventas' => $this->faker->numberBetween($min = 0, $max = 1000000),
            'Precio' => $this->faker->numberBetween($min = 5000, $max = 70000),
            'Link' => $this->faker->unique()->url,
            'Link_Demo' => $this->faker->unique()->url,
            'ID_Usuario' => User::all()->random()->id,
            'ID_Restriccion' => AgeRestriction::all()->random()->id,
            'borrado' => $this->faker->boolean

        ];
    }
}
