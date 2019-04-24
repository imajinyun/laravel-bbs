<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFileGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('file_groups', static function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment('主键 ID');
            $table->string('name', 50)->comment('分组名称');
            $table->string('code', 50)->comment('分组代码');
            $table->boolean('is_public')->default(1)->comment('是否公开(0:否 1:是)');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `file_groups` COMMENT '文件分组表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('file_groups');
    }
}
