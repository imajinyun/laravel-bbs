<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('files', static function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment('主键 ID');
            $table->unsignedInteger('group_id')->comment('分组 ID，关联 file_groups 表主键 ID');
            $table->unsignedInteger('user_id')->comment('用户 ID，关联 users 表主键 ID');
            $table->string('uri')->comment('文件 URI');
            $table->string('mime')->comment('文件 MIME');
            $table->unsignedInteger('size')->default(0)->comment('文件大小');
            $table->unsignedTinyInteger('status')->default(1)->comment('文件状态(1:正常 2:禁用)');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE `files` COMMENT '文件表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
}
