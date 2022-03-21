<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id()->comment('主键 ID');
            $table->string('trace_id')->comment('Trace ID');
            $table->string('uri')->comment('地址');
            $table->string('level')->comment('级别');
            $table->string('message')->comment('消息');
            $table->text('content')->comment('内容');
            $table->timestamp('reported_at')->comment('报告时间');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE `logs` COMMENT "日志表"');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
}
