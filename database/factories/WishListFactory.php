<?php

namespace Database\Factories;

use App\Models\WishList;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class WishListFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WishList::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'NombreLista' => $this->faker->text($maxNbChars = 100),
            'ID_Usuario' => User::all()->random()->id
        ];
    }
}
