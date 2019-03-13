<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary()->comment('主键 ID');
            $table->string('type')->comment('通知类型');
            $table->string('notifiable_type')->comment('应通知的类型');
            $table->unsignedBigInteger('notifiable_id')->comment('应通知的 ID');
            $table->text('data')->comment('通知数据');
            $table->timestamp('read_at')->nullable()->comment('阅读时间');
            $table->timestamps();
            $table->index(['notifiable_type', 'notifiable_id'], 'idx_notifiable_type_id');
        });

        \DB::statement('ALTER TABLE `notifications` COMMENT="通知表"');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
