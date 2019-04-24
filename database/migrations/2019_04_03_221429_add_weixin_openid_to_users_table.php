<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWeixinOpenidToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('users', static function (Blueprint $table) {
            $table->string('weixin_openid')->nullable()->after('password')->comment('微信 OpenID');
            $table->string('weixin_unionid')->nullable()->after('weixin_openid')->comment('微信 UnionID');
            $table->string('password')->nullable()->change();
            $table->unique('weixin_openid', 'uk_openid');
            $table->unique('weixin_unionid', 'uk_unionid');
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
            $table->dropColumn('weixin_openid');
            $table->dropColumn('weixin_unionid');
            $table->string('password')->nullable(false)->change();
        });
    }
}
