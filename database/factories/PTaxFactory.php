<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PTaxFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tax_percentage' => $this->faker->randomDigit,
            'designation_id' => \App\Models\Designation::all()->random()->id,
        ];
    }
}
