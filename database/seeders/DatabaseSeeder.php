<?php

namespace Database\Seeders;

use Database\Seeders\LinksTableSeeder;
use Database\Seeders\ReplysTableSeeder;
use Database\Seeders\TopicsTableSeeder;
use Database\Seeders\UsersTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(UsersTableSeeder::class);
        $this->command->info('The users table has been seeded!');

        $this->call(TopicsTableSeeder::class);
        $this->command->info('The topics table has been seeded!');

        $this->call(ReplysTableSeeder::class);
        $this->command->info('The replies table has been seeded!');

        $this->call(LinksTableSeeder::class);
        $this->command->info('The links table has been seeded!');
    }
}
