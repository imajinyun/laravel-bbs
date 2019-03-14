<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SeedPermissionsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::create(['name' => 'manage_articles']);
        Permission::create(['name' => 'manage_users']);
        Permission::create(['name' => 'manage_settings']);

        // Create roles and assign created permissions
        $founder = Role::create(['name' => 'Founder']);
        $founder->givePermissionTo('manage_articles');
        $founder->givePermissionTo('manage_users');
        $founder->givePermissionTo('manage_settings');

        $maintainer = Role::create(['name' => 'Maintainer']);
        $maintainer->givePermissionTo('manage_articles');
        $maintainer->givePermissionTo('manage_users');
        $maintainer->givePermissionTo('manage_settings');

        $user = Role::create(['name' => 'User']);
        $user->givePermissionTo('manage_articles');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        $tableNames = config('permission.table_names');

        Model::unguard();
        DB::table($tableNames['role_has_permissions'])->delete();
        DB::table($tableNames['model_has_roles'])->delete();
        DB::table($tableNames['model_has_permissions'])->delete();
        DB::table($tableNames['roles'])->delete();
        DB::table($tableNames['permissions'])->delete();
        Model::reguard();
    }
}
