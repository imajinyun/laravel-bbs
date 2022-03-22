<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $datetime = $this->faker->dateTimeThisMonth();

        return [
            'content' => $this->faker->sentence(),
            'created_at' => $datetime,
            'updated_at' => $datetime,
        ];
    }
}
