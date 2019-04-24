<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('topics', static function (Blueprint $table) {
            $table->increments('id')->unsigned()->comment('主键 ID');
            $table->string('title')->index('idx_title')->comment('话题标题');
            $table->text('body')->comment('话题内容');
            $table->unsignedInteger('user_id')->index('idx_user_id')->comment('用户 ID，关联 users 表主键 ID');
            $table->unsignedInteger('category_id')->index('idx_category_id')->comment('分类 ID，关联 categories 表主键 ID');
            $table->unsignedInteger('last_reply_user_id')->default(0)->comment('最后回复的用户 ID，关联 users 表主键 ID');
            $table->unsignedInteger('reply_count')->default(0)->comment('回复数量');
            $table->unsignedInteger('view_count')->default(0)->comment('查看数量');
            $table->unsignedInteger('sort_value')->default(0)->comment('排序值');
            $table->text('excerpt')->nullable()->comment('文章摘要');
            $table->string('slug')->nullable()->comment('SEO 友好的 URI');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        DB::statement('ALTER TABLE `topics` COMMENT "话题表"');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('topics');
    }
}
