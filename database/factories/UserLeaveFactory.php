<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class UserLeaveFactory extends Factory
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

            'leave_type' => 'earn', 

            'leave_no' => 'AME/Leave/2023',

            'year' => '2023',

            'created_at' => Carbon::now(),
        ];
    }
}
