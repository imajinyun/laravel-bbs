<?php

namespace Database\Factories;

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, static function (Faker $faker) {
    $datetime = $faker->dateTimeBetween('-2 years');

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now()->toDateTimeString(),
        'password' => '$2y$10$J6BFBA/Fb/tZuAsXuYneL.MUKPWq04xchN9x.Y5koSAeqrHpNCHwi', // laraveler
        'introduction' => $faker->sentence(),
        'remember_token' => Str::random(10),
        'created_at' => $datetime,
        'updated_at' => $datetime,
    ];
});
