<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $datetime = now();

        return [
            'created_at' => $datetime,
            'updated_at' => $datetime,
        ];
    }
}
