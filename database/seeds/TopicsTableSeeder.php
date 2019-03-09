<?php

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
    public function run()
    {
        /** @var \Faker\Generator $faker */
        $faker = app(\Faker\Generator::class);

        $userIds = User::all()->pluck('id')->toArray();
        $categoryIds = Category::all()->pluck('id')->toArray();

        /** @var \Illuminate\Database\Eloquent\FactoryBuilder $factory */
        $factory = factory(Topic::class)
            ->times(100)
            ->make()
            ->each(function ($topic) use ($faker, $userIds, $categoryIds) {
                $topic->user_id = $faker->randomElement($userIds);
                $topic->category_id = $faker->randomElement($categoryIds);
            });
        $topics = $factory->toArray();
        Topic::insert($topics);
    }
}
