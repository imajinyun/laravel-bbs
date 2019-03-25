<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedFileGroupsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data = [
            ['name' => '默认文件组', 'code' => 'default'],
            ['name' => '缩略图片组', 'code' => 'thumb'],
            ['name' => '用户头像组', 'code' => 'avatar'],
            ['name' => '临时目录组', 'code' => 'tmp'],
            ['name' => '全局设置组', 'code' => 'system'],
            ['name' => '用户私有组', 'code' => 'private'],
        ];
        $now = now()->toDateTimeString();
        $data = array_map(function ($value) use ($now) {
            $value['created_at'] = $now;
            $value['updated_at'] = $now;

            return $value;
        }, $data);
        DB::table('file_groups')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('file_groups')->truncate();
    }
}
