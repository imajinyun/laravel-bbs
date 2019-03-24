<?php

use App\Models\FileGroups;
use Illuminate\Database\Seeder;

class FileGroupsTableSeeder extends Seeder
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
            ['name' => '默认文件组', 'code' => 'default'],
            ['name' => '缩略图片组', 'code' => 'thumb'],
            ['name' => '用户头像组', 'code' => 'avatar'],
            ['name' => '临时目录组', 'code' => 'tmp'],
            ['name' => '全局设置组', 'code' => 'system'],
            ['name' => '用户私有组', 'code' => 'private'],
        ];
        $factory = factory(FileGroups::class)
            ->times(6)
            ->make()
            ->each(function ($fileGroup, $index) use ($data) {
                $fileGroup->name = $data[$index]['name'];
                $fileGroup->code = $data[$index]['code'];

                if ($fileGroup->code === 'private') {
                    $fileGroup->is_public = 0;
                }
            });
        $fileGroups = $factory->toArray();
        FileGroups::insert($fileGroups);
    }
}
