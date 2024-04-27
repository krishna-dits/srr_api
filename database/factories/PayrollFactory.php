<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PayrollFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'user_id' => \App\Models\User::all()->random()->id,

            'designation_id' => \App\Models\Designation::all()->random()->id ,

            'wages_rate_formula' => $this->faker->sentence,

            'washing_allowance_formula' => $this->faker->sentence,

            'incentive_rate_formula' => $this->faker->sentence,

            'provident_fund_formula' => $this->faker->sentence,

            'esis_formula' => $this->faker->sentence,

            'da_formula' => $this->faker->sentence,

            'canteen_allowance_formula' => $this->faker->sentence,

            'convey_allowance_formula' => $this->faker->sentence,

            'medical_allowance_formula' => $this->faker->sentence,

            'children_allowance_formula' => $this->faker->sentence,

            'special_allowance_formula' => $this->faker->sentence,

            'dust_allowance_formula' => $this->faker->sentence,

            'professional_formula' => $this->faker->sentence,

            'dearness_allowance_formula' => $this->faker->sentence,

            'houserent_allowance_formula' => $this->faker->sentence,

            'eshare_allowance_formula' => $this->faker->sentence,

            'bonus_formula' => $this->faker->sentence,

            'total_deduction' => $this->faker->randomDigit,

            'net_amount' => $this->faker->randomDigit,
        ];
    }
}
