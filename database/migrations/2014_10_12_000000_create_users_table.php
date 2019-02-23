<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')
                ->comment('主键 ID');
            $table->string('name')
                ->comment('用户名');
            $table->string('email')
                ->unique()
                ->comment('邮箱');
            $table->timestamp('email_verified_at')
                ->nullable()
                ->comment('邮箱验证时间');
            $table->string('password')
                ->comment('密码');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
