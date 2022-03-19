<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $avatars = [
            '/laravel/bbs/avatar/Awesome8dae1Coer.jpg',
            '/laravel/bbs/avatar/Aiqueeyov7aiFaiy.jpg',
            '/laravel/bbs/avatar/Cae8ro9Reequae2x.jpg',
            '/laravel/bbs/avatar/ChooDi9booDuo5uo.jpg',
            '/laravel/bbs/avatar/DeiH5uo6ooTahRat.jpg',
            '/laravel/bbs/avatar/Eewa6jezoQuoeghi.jpg',
            '/laravel/bbs/avatar/Eiyoo9ohthie9ahl.jpg',
            '/laravel/bbs/avatar/Ohr8ohtahdeefiem.jpg',
            '/laravel/bbs/avatar/Oo5ia7Aib3aaquoh.jpg',
            '/laravel/bbs/avatar/OobapaiV1eweeTh6.jpg',
            '/laravel/bbs/avatar/Oorooyealai9dobo.jpg',
            '/laravel/bbs/avatar/Peb3wuKuiPha1gei.jpg',
            '/laravel/bbs/avatar/Tooz8meeha6gooVu.jpg',
            '/laravel/bbs/avatar/aMagh1EefaNgi2ei.jpg',
            '/laravel/bbs/avatar/aecah3Eo1shahchu.jpg',
            '/laravel/bbs/avatar/ueCie3oufai7euco.jpg',
        ];
        User::factory()
            ->count(15)
            ->sequence(fn ($sequence) => ['avatar' => $avatars[$sequence->index]])
            ->create();

        $user = User::find(1);
        $user->name = 'laravel';
        $user->email = config('mail.username');
        $user->avatar = $avatars[count($avatars) - 1];
        $user->assignRole(['Administrator']);
        $user->save();

        $user = User::find(2);
        $user->name = strtolower(config('mail.from.name'));
        $user->email = config('app.admin_mails')[0];
        $user->avatar = $avatars[0];
        $user->assignRole(['Administrator']);
        $user->save();
    }
}
