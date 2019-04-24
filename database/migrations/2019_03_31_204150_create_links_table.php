<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('links', static function (Blueprint $table) {
            $table->increments('id')->comment('主键 ID');
            $table->string('name', 64)->comment('资源名称')->index('idx_name');
            $table->string('href')->comment('资源链接')->index('idx_href');
            $table->unsignedTinyInteger('status')->default(1)->comment('资源状态(1:正常 2:停用)');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE `links` COMMENT "资源表"');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('links');
    }
}
