<?php

namespace Database\Factories;

use App\Models\GeographicRestriction;

use App\Models\Country;
use App\Models\Game;

use Illuminate\Database\Eloquent\Factories\Factory;

class GeographicRestrictionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GeographicRestriction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ID_Pais' => Country::all()->random()->id,
            'Codigo_Juego' => Game::all()->random()->id
        ];
    }
}
