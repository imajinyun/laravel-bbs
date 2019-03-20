<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment('主键 ID');
            $table->string('name', 64)->comment('设置键');
            $table->json('value')->comment('设置值');
            $table->string('namespace', 32)->default('default')->comment('设置命名空间');
            $table->timestamps();
            $table->unique(['name', 'namespace'], 'uk_name');
        });

        \DB::statement("ALTER TABLE `settings` COMMENT '系统设置表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
