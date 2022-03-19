<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        /** @var \Faker\Generator $faker */
        $faker = app(\Faker\Generator::class);

        $userIds = User::all()->pluck('id')->toArray();
        $categoryIds = Category::all()->pluck('id')->toArray();

        Topic::factory()
            ->count(100)
            ->sequence(fn ($sequence) => ['user_id' => $faker->randomElement($userIds)])
            ->sequence(fn ($sequence) => ['category_id' => $faker->randomElement($categoryIds)])
            ->create();
    }
}
