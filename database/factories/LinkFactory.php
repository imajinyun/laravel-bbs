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
        $datetime = now()->toDateTimeString();

        return [
            'name' => $this->faker->catchPhrase,
            'href' => $this->faker->url,
            'created_at' => $datetime,
            'updated_at' => $datetime,
        ];
    }
}
