<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TopicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $sentence = $this->faker->sentence();
        $updatedAt = $this->faker->dateTimeThisMonth();
        $createdAt = $this->faker->dateTimeThisMonth($updatedAt);

        return [
            'title' => $sentence,
            'body' => $this->faker->text(),
            'excerpt' => $sentence,
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
        ];
    }
}
