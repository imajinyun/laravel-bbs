<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Reply::class, function (Faker $faker) {
    $datetime = $faker->dateTimeThisMonth();

    return [
        'content' => $faker->sentence(),
        'created_at' => $datetime,
        'updated_at' => $datetime,
    ];
});
