<?php

namespace Database\Factories;

use App\Models\UserCoin;

use App\Models\User;
use App\Models\CoinPack;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserCoinFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserCoin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ID_Usuario' => User::all()->random()->id,
            'ID_paquete' => CoinPack::all()->random()->id,
            'borrado' => $this->faker->boolean
        ];
    }
}
