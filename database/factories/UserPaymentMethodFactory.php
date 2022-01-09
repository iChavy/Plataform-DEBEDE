<?php

namespace Database\Factories;

use App\Models\UserPaymentMethod;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserPaymentMethodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserPaymentMethod::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Fecha' => $this->faker->dateTime($max = 'now'),
            'ID_Metodo' => PaymentMethod::all()->random()->id,
            'ID_Usuario' => User::all()->random()->id,
            'borrado' => $this->faker->boolean

        ];
    }
}
