<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProvidentFundFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'foumula' => $this->faker->word,
            'designation_id' => \App\Models\Designation::all()->random()->id,
        ];
    }
}
