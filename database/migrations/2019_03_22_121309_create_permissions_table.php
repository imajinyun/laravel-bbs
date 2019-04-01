<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id')->comment('主键 ID');
            $table->string('name', 64)->comment('权限名称');
            $table->string('slug')->nullable()->unique()->comment('权限编码');
            $table->unsignedInteger('parent_id')->default(0)->comment('父级 ID');
            $table->unsignedTinyInteger('level')->default(0)->comment('权限层级');
            $table->timestamps();
        });
        \DB::statement("ALTER TABLE permissions COMMENT '权限表'");

        Schema::create('role_permissions', function (Blueprint $table) {
            $table->unsignedInteger('role_id')->comment('角色 ID，关联 roles 表主键 ID');
            $table->unsignedInteger('permission_id')->comment('权限 ID，关联 permissions 表主键 ID');
            $table->primary(['role_id', 'permission_id']);

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
        });
        \DB::statement("ALTER TABLE role_permissions COMMENT '角色权限表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('role_permissions');
    }
}
