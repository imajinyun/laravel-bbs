<?php

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
    public function run()
    {
        /** @var \Faker\Generator $faker */
        $faker = app(\Faker\Generator::class);

        $userIds = User::all()->pluck('id')->toArray();
        $topicIds = Topic::all()->pluck('id')->toArray();

        /** @var \Illuminate\Database\Eloquent\FactoryBuilder $factory */
        $factory = factory(Reply::class)
            ->times(1000)
            ->make()
            ->each(function ($reply) use ($faker, $userIds, $topicIds) {
                $reply->user_id = $faker->randomElement($userIds);
                $reply->topic_id = $faker->randomElement($topicIds);
            });
        $replys = $factory->toArray();
        Reply::insert($replys);
    }
}
