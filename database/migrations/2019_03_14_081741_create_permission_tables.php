<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');

        Schema::create($tableNames['permissions'], function (Blueprint $table) {
            $table->increments('id')->comment('主键 ID');
            $table->string('name')->comment('权限名称');
            $table->string('guard_name')->comment('守卫名称');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `{$tableNames['permissions']}` COMMENT '权限表'");

        Schema::create($tableNames['roles'], function (Blueprint $table) {
            $table->increments('id')->comment('主键 ID');
            $table->string('name')->comment('角色名称');
            $table->string('guard_name')->comment('守卫名称');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE `{$tableNames['roles']}` COMMENT '角色表'");

        Schema::create($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames, $columnNames) {
            $table->unsignedInteger('permission_id')->comment('权限 ID，关联 permissions 表主键 ID');
            $table->string('model_type')->comment('模型类型');
            $table->unsignedBigInteger($columnNames['model_morph_key'])->comment('模型 ID');
            $table->index([$columnNames['model_morph_key'], 'model_type',]);

            $table->foreign('permission_id')
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->primary(['permission_id', $columnNames['model_morph_key'], 'model_type'],
                'model_has_permissions_permission_model_type_primary');
        });
        DB::statement("ALTER TABLE `{$tableNames['model_has_permissions']}` COMMENT '模型拥有的权限关联表'");

        Schema::create($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames, $columnNames) {
            $table->unsignedInteger('role_id')->comment('角色 ID，关联 roles 表主键 ID');

            $table->string('model_type')->comment('模型类型');
            $table->unsignedBigInteger($columnNames['model_morph_key'])->comment('模型 ID');
            $table->index([$columnNames['model_morph_key'], 'model_type',]);

            $table->foreign('role_id')
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary(['role_id', $columnNames['model_morph_key'], 'model_type'],
                'model_has_roles_role_model_type_primary');
        });
        DB::statement("ALTER TABLE `{$tableNames['model_has_roles']}` COMMENT '模型拥有的角色关联表'");

        Schema::create($tableNames['role_has_permissions'], function (Blueprint $table) use ($tableNames) {
            $table->unsignedInteger('permission_id')->comment('权限 ID，关联 permissions 表主键 ID');
            $table->unsignedInteger('role_id')->comment('角色 ID，关联 roles 表主键 ID');

            $table->foreign('permission_id')
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->foreign('role_id')
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);
        });
        DB::statement("ALTER TABLE `{$tableNames['role_has_permissions']}` COMMENT '角色拥有的权限关联表'");

        app('cache')
            ->store(config('permission.cache.store') !== 'default' ? config('permission.cache.store') : null)
            ->forget(config('permission.cache.key'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableNames = config('permission.table_names');

        Schema::drop($tableNames['role_has_permissions']);
        Schema::drop($tableNames['model_has_roles']);
        Schema::drop($tableNames['model_has_permissions']);
        Schema::drop($tableNames['roles']);
        Schema::drop($tableNames['permissions']);
    }
}
