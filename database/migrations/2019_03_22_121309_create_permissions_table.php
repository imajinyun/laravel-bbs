<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('roles', static function (Blueprint $table) {
            $table->increments('id')->comment('主键 ID');
            $table->string('name', 64)->comment('角色名称');
            $table->string('slug', 64)->unique()->comment('角色编码');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE roles COMMENT '角色表'");

        Schema::create('permissions', static function (Blueprint $table) {
            $table->increments('id')->comment('主键 ID');
            $table->string('name', 64)->comment('权限名称');
            $table->string('slug')->nullable()->unique()->comment('权限编码');
            $table->unsignedInteger('parent_id')->default(0)->comment('父级 ID');
            $table->unsignedTinyInteger('level')->default(0)->comment('权限层级');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE permissions COMMENT '权限表'");

        Schema::create('role_permissions', static function (Blueprint $table) {
            $table->unsignedInteger('role_id')->comment('角色 ID，关联 roles 表主键 ID');
            $table->unsignedInteger('permission_id')->comment('权限 ID，关联 permissions 表主键 ID');

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');

            $table->primary(['role_id', 'permission_id']);
        });
        DB::statement("ALTER TABLE role_permissions COMMENT '角色权限表'");

        Schema::create('user_roles', static function (Blueprint $table) {
            $table->unsignedInteger('user_id')->comment('用户 ID，关联 users 表主键 ID');
            $table->unsignedInteger('role_id')->comment('角色 ID，关联 roles 表主键 ID');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->primary(['user_id', 'role_id']);
        });
        DB::statement("ALTER TABLE user_roles COMMENT '用户角色表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('user_roles');
        Schema::dropIfExists('role_permissions');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
    }
}
