<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedPermissionsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data = self::each(config('menu'));

        $now = now()->toDateTimeString();
        $data = collect($data)
            ->map(function ($value) use ($now) {
                $value['created_at'] = $now;
                $value['updated_at'] = $now;

                return $value;
            })
            ->toArray();
        DB::table('permissions')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('permissions')->truncate();
    }

    private static function each($data, $child = 'children')
    {
        static $list = [];

        if (is_array($data)) {
            foreach ($data as $key => $val) {
                $item = $val;
                if (isset($val[$child])) {
                    unset($item[$child]);
                    self::each($val[$child]);
                }
                $list[] = $item;
            }
        }

        return $list;
    }
}