<?php

use App\Models\User;
use Faker\Generator;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var \Faker\Generator $faker */
        $faker = app(Generator::class);

        $avatars = [
            'https://entities.oss-cn-beijing.aliyuncs.com/laravel/bbs/avatar/Awesome8dae1Coer.jpg',
            'https://entities.oss-cn-beijing.aliyuncs.com/laravel/bbs/avatar/Aiqueeyov7aiFaiy.jpg',
            'https://entities.oss-cn-beijing.aliyuncs.com/laravel/bbs/avatar/Cae8ro9Reequae2x.jpg',
            'https://entities.oss-cn-beijing.aliyuncs.com/laravel/bbs/avatar/ChooDi9booDuo5uo.jpg',
            'https://entities.oss-cn-beijing.aliyuncs.com/laravel/bbs/avatar/DeiH5uo6ooTahRat.jpg',
            'https://entities.oss-cn-beijing.aliyuncs.com/laravel/bbs/avatar/Eewa6jezoQuoeghi.jpg',
            'https://entities.oss-cn-beijing.aliyuncs.com/laravel/bbs/avatar/Eiyoo9ohthie9ahl.jpg',
            'https://entities.oss-cn-beijing.aliyuncs.com/laravel/bbs/avatar/Ohr8ohtahdeefiem.jpg',
            'https://entities.oss-cn-beijing.aliyuncs.com/laravel/bbs/avatar/Oo5ia7Aib3aaquoh.jpg',
            'https://entities.oss-cn-beijing.aliyuncs.com/laravel/bbs/avatar/OobapaiV1eweeTh6.jpg',
            'https://entities.oss-cn-beijing.aliyuncs.com/laravel/bbs/avatar/Oorooyealai9dobo.jpg',
            'https://entities.oss-cn-beijing.aliyuncs.com/laravel/bbs/avatar/Peb3wuKuiPha1gei.jpg',
            'https://entities.oss-cn-beijing.aliyuncs.com/laravel/bbs/avatar/Tooz8meeha6gooVu.jpg',
            'https://entities.oss-cn-beijing.aliyuncs.com/laravel/bbs/avatar/aMagh1EefaNgi2ei.jpg',
            'https://entities.oss-cn-beijing.aliyuncs.com/laravel/bbs/avatar/aecah3Eo1shahchu.jpg',
            'https://entities.oss-cn-beijing.aliyuncs.com/laravel/bbs/avatar/ueCie3oufai7euco.jpg',
        ];

        /** @var \Illuminate\Database\Eloquent\FactoryBuilder $factory */
        $factory = factory(User::class)
            ->times(15)
            ->make()
            ->each(function ($user) use ($faker, $avatars) {
                $user->avatar = $faker->randomElement($avatars);
            });

        // 让隐藏字段可见，并将数据集合转换为数组
        $users = $factory->makeVisible(['password', 'remember_token'])->toArray();
        User::insert($users);

        $user = User::find(1);
        $user->assignRole('Founder');
        $user->name = 'laravel';
        $user->email = config('mail.username');
        $user->avatar = $avatars[count($avatars) - 1];
        $user->save();

        $user = User::find(2);
        $user->assignRole('Maintainer');
        $user->name = strtolower(config('mail.from.name'));
        $user->email = config('app.maintainer_email')[0];
        $user->avatar = $avatars[0];
        $user->save();
    }
}
