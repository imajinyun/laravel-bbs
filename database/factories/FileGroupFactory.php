<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FileGroupFactory extends Factory
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
            'is_public' => 1,
            'created_at' => $datetime,
            'updated_at' => $datetime,
        ];
    }
}
