<?php

namespace Database\Factories;

use App\Models\RoleFunctionality;
use App\Models\Role;
use App\Models\Functionality;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFunctionalityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RoleFunctionality::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ID_funcionalidad' => Functionality::all()->random()->id,
            'ID_Rol' => Role::all()->random()->id,
            'borrado' => $this->faker->boolean
        ];
    }
}
