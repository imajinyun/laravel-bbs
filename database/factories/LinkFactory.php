<?php

namespace Database\Factories;

use Faker\Generator as Faker;

$factory->define(\App\Models\Link::class, static function (Faker $faker) {

    $datetime = now()->toDateTimeString();

    return [
        'name' => $faker->catchPhrase,
        'href' => $faker->url,
        'created_at' => $datetime,
        'updated_at' => $datetime,
    ];
});
