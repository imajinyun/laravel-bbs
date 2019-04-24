<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPhoneToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('users', static function (Blueprint $table) {
            $table->string('phone', 32)->nullable()->after('name')->comment('手机号');
            $table->string('email', 64)->nullable()->change();
            $table->unique('phone', 'uk_phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('users', static function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->string('email', 64)->nullable(false)->change();
        });
    }
}
