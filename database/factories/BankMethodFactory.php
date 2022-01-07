<?php

namespace Database\Factories;

use App\Models\BankMethod;
use App\Models\Bank;
use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

class BankMethodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BankMethod::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ID_Banco' => Bank::all()->random()->id,
            'ID_Metodo' => PaymentMethod::all()->random()->id
        ];
    }
}
