<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Topic::class, static function (Faker $faker) {

    $sentence = $faker->sentence();
    $updatedAt = $faker->dateTimeThisMonth();
    $createdAt = $faker->dateTimeThisMonth($updatedAt);

    return [
        'title' => $sentence,
        'body' => $faker->text(),
        'excerpt' => $sentence,
        'created_at' => $createdAt,
        'updated_at' => $updatedAt,
    ];
});
