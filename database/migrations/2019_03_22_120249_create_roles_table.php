<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id')->comment('主键 ID');
            $table->string('name', 64)->comment('角色名称');
            $table->string('slug', 64)->unique()->comment('角色编码');
            $table->timestamps();
        });
        \DB::statement("ALTER TABLE roles COMMENT '角色表'");

        Schema::create('user_roles', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->comment('用户 ID，关联 users 表主键 ID');
            $table->unsignedInteger('role_id')->comment('角色 ID，关联 roles 表主键 ID');
            $table->primary(['user_id', 'role_id']);
        });
        \DB::statement("ALTER TABLE user_roles COMMENT '用户角色表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
