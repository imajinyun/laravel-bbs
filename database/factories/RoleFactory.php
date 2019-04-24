<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Role::class, static function (Faker $faker) {
    $datetime = now();

    return [
        'created_at' => $datetime,
        'updated_at' => $datetime,
    ];
});
