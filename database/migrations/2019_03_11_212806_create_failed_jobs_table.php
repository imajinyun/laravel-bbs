<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFailedJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('failed_jobs', static function (Blueprint $table) {
            $table->bigIncrements('id')->comment('主键 ID');
            $table->text('connection')->comment('连接');
            $table->text('queue')->comment('队列');
            $table->longText('payload')->comment('载荷');
            $table->longText('exception')->comment('异常');
            $table->timestamp('failed_at')->useCurrent()->comment('失败时间');
        });

        DB::statement('ALTER TABLE `failed_jobs` COMMENT "失败的作业表"');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('failed_jobs');
    }
}
