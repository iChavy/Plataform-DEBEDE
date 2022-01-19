<?php

namespace Database\Factories;

use App\Models\FollowUp;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FollowUpFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FollowUp::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ID_Usuario1' => User::all()->random()->id,
            'ID_Usuario2' => User::all()->random()->id,
            'borrado' => $this->faker->randomElement($array = array('false'))
        ];
    }
}
