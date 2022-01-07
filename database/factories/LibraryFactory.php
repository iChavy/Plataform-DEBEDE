<?php

namespace Database\Factories;

use App\Models\Library;

use App\Models\User;
use App\Models\Game;

use Illuminate\Database\Eloquent\Factories\Factory;

class LibraryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Library::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ID_Usuario' => User::all()->random()->id,
            'Codigo_Juego' => Game::all()->random()->id
        ];
    }
}
