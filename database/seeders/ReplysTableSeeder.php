<?php

namespace Database\Seeders;

use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReplysTableSeeder extends Seeder
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
        $topicIds = Topic::all()->pluck('id')->toArray();

        Reply::factory()
            ->count(800)
            ->sequence(fn ($sequence) => ['user_id' => $faker->randomElement($userIds)])
            ->sequence(fn ($sequence) => ['topic_id' => $faker->randomElement($topicIds)])
            ->create();
    }
}
