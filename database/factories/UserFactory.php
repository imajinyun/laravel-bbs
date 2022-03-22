<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $datetime = $this->faker->dateTimeBetween('-2 years');

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$J6BFBA/Fb/tZuAsXuYneL.MUKPWq04xchN9x.Y5koSAeqrHpNCHwi', // laraveler
            'introduction' => $this->faker->sentence(),
            'remember_token' => Str::random(10),
            'created_at' => $datetime,
            'updated_at' => $datetime,
        ];
    }

    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
