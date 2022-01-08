<?php

namespace Database\Factories;

use App\Models\Transaction;

use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ID_Usuario' => User::all()->random()->id,            
            'Fecha' => $this->faker->dateTime($max = 'now',$timezone = 'UTC')

        ];
    }
}
