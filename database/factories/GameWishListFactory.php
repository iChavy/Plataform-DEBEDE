<?php

namespace Database\Factories;

use App\Models\GameWishList;

//use App\Models\WishList;
use App\Models\Game;

use Illuminate\Database\Eloquent\Factories\Factory;

class GameWishListFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GameWishList::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //'ID_Lista' => WishList::all()->random()->id,
            'Codigo_Juego' => Game::all()->random()->id
        ];
    }
}
