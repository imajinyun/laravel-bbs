<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
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

        $menus = config('menu.admin');
        $roles = [];
        $roles[] = ['id' => $menus['id'], 'name' => $menus['name']];
        foreach ($menus['children'] as $keys => $item) {
            foreach ($item['children'] as $key => $menu) {
                if (isset($menu['children']) && count($menu['children']) > 0) {
                    foreach ($menu['children'] as $k => $v) {
                        $roles[] = ['id' => $v['id'], 'name' => $v['name'],];
                    }
                }
                $roles[] = ['id' => $menu['id'], 'name' => $menu['name']];
            }
            $roles[] = ['id' => $item['id'], 'name' => $item['name']];
        }

        $factory = factory(Permission::class)
            ->times(count($roles))
            ->make()
            ->each(function ($permission, $index) use ($roles) {
                $permission->id = $roles[$index]['id'];
                $permission->name = $roles[$index]['name'];
            });
        $roles = $factory->toArray();
        Permission::insert($roles);
    }
}
