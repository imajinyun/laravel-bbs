<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\FileGroups::class, static function (Faker $faker) {
    $datetime = now();

    return [
        'is_public' => 1,
        'created_at' => $datetime,
        'updated_at' => $datetime,
    ];
});
