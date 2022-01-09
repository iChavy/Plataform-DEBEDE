<?php

namespace Database\Factories;

use App\Models\GameGenre;

use App\Models\Game;
use App\Models\Gender;

use Illuminate\Database\Eloquent\Factories\Factory;

class GameGenreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GameGenre::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ID_genero' => Gender::all()->random()->id,
            'Codigo_Juego' => Game::all()->random()->id,
            'borrado' => $this->faker->boolean
        ];
    }
}
