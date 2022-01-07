<?php

namespace Database\Factories;

use App\Models\Valuation;

//use App\Models\User;
use App\Models\Game;

use Illuminate\Database\Eloquent\Factories\Factory;

class ValuationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Valuation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //'ID_Usuario' => User::all()->random()->id,
            'Codigo_Juego' => Game::all()->random()->id,
            'Comentario' => $this->faker->text($maxNbChars = 500),
            'Like' => $this->faker->boolean


        ];
    }
}
