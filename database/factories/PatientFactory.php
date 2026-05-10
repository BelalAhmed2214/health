<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),

            'national_id' => fake()->unique()->numerify('##############'),

            'mobile' => fake()->phoneNumber(),

            'date_of_birth' => fake()->date(),

            'marital_status' => fake()->randomElement([
                'single',
                'married',
                'divorced',
                'widowed'
            ]),

            'children_count' => fake()->numberBetween(0, 5),

            'governorate' => fake()->randomElement([
                'cairo',
                'alexandria',
                'giza',
                'dakahlia'
            ]),

            'address' => fake()->address(),

            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
        ];
    }
}
