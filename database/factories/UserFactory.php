<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Role;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Correo_electronico' => $this->faker->unique()->email,
            'Contrasenya' => $this->faker->password,
            'Fecha_Nacimiento' => $this->faker->date($format = 'Y-m-d', $max = 'now'), 
            'Saldo_Moneda' => $this->faker->numberBetween($min=0, $max=10000000),
            'ID_Rol' => Role::all()->random()->id,
            'ID_Pais' => Country::all()->random()->id,
            'borrado' => $this->faker->boolean
        ];
    }
}
