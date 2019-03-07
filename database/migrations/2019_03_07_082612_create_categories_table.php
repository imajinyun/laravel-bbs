<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id')
                ->unsigned()
                ->comment('主键 ID');
            $table->string('name')
                ->index('idx_name')
                ->comment('分类名称');
            $table->string('description')
                ->nullable()
                ->comment('分类描述');
            $table->integer('post_count')
                ->unsigned()
                ->default(0)
                ->comment('帖子数量');
            $table->timestamps();

        });

        $query = "ALTER TABLE `categories` COMMENT '分类表'";
        \Illuminate\Support\Facades\DB::statement($query);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
