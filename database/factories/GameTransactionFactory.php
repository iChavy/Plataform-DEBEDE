<?php

namespace Database\Factories;

use App\Models\GameTransaction;

use App\Models\Transaction;
use App\Models\Game;

use Illuminate\Database\Eloquent\Factories\Factory;

class GameTransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GameTransaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Codigo_Juego' => Game::all()->random()->id, 
            'ID_Transaccion' => Transaction::all()->random()->id,
            'borrado' => $this->faker->boolean
        ];
    }
}
