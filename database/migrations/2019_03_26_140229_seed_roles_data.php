<?php

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Migrations\Migration;

class SeedRolesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        $data = [
            ['name' => '超级管理员组', 'slug' => 'Administrator'],
            ['name' => '普通管理员组', 'slug' => 'Manager'],
            ['name' => '开发组', 'slug' => 'Developer'],
            ['name' => '运营组', 'slug' => 'Operator'],
        ];
        $now = now()->toDateTimeString();
        $data = array_map(static function ($value) use ($now) {
            $value['created_at'] = $now;
            $value['updated_at'] = $now;

            return $value;
        }, $data);
        DB::table('roles')->insert($data);
        $permissions = Permission::all();

        $roles = Role::all();
        foreach ($roles as $role) {
            $role->givePermissionTo($permissions);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('roles')->truncate();
        Schema::enableForeignKeyConstraints();
    }
}
