<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->increments('id')
                ->unsigned()
                ->comment('主键 ID');
            $table->unsignedInteger('topic_id')
                ->default(0)
                ->comment('话题 ID，关联 topics 表主键 ID');
            $table->unsignedInteger('user_id')
                ->default(0)
                ->comment('用户 ID，关联 users 表主键 ID');
            $table->text('content')
                ->comment('回复内容');
            $table->timestamps();
        });

        $query = "ALTER TABLE `replies` COMMENT='回复表'";
        \DB::statement($query);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replies');
    }
}
