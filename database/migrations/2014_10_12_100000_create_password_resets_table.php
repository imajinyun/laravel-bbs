<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasswordResetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('password_resets', static function (Blueprint $table) {
            $table->string('email', 50)->index('idx_email')->comment('邮箱');
            $table->string('token')->comment('令牌');
            $table->timestamp('created_at')->nullable()->comment('创建时间');

        });

        DB::statement('ALTER TABLE `password_resets` COMMENT "密码重置表"');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('password_resets');
    }
}
