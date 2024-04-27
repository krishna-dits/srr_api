<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WagesRateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'rate_per_day' => $this->faker->randomDigit,
            'designation_id' => \App\Models\Designation::all()->random()->id,
        ];
    }
}
