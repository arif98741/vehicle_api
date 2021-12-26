<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'emails' => $this->faker->unique->safeEmail(),
            'phone' => $this->faker->numberBetween(111111111, 999999999),
            'email_verified_at' => now(),
            'user_slug' => Str::slug($this->faker->text(20)),
            'password' => Hash::make('123'), // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's emails address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
