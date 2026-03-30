<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('report_executions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_definition_id')->constrained('report_definitions')->cascadeOnDelete();
            $table->foreignId('scheduled_report_id')->nullable()->constrained('scheduled_reports');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->json('filters')->nullable();
            $table->integer('result_count')->default(0);
            $table->integer('duration_ms')->nullable();
            $table->string('file_path')->nullable();
            $table->string('file_format')->nullable();
            $table->enum('status', ['pending', 'running', 'completed', 'failed'])->default('pending');
            $table->text('error_message')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('report_executions');
    }
};
