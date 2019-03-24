<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
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

        $data = [
            ['name' => '超级管理员组',],
            ['name' => '普通管理员组',],
            ['name' => '用户组',],
            ['name' => '运营组',],
        ];
        $factory = factory(Role::class)
            ->times(count($data))
            ->make()
            ->each(function ($role, $index) use ($data) {
                $role->name = $data[$index]['name'];
            });
        $roles = $factory->toArray();
        Role::insert($roles);
    }
}
