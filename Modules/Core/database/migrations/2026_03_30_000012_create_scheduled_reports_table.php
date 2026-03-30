<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scheduled_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_definition_id')->constrained('report_definitions')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users');
            $table->string('name');
            $table->enum('frequency', ['daily', 'weekly', 'monthly', 'quarterly']);
            $table->integer('day_of_week')->nullable();
            $table->integer('day_of_month')->nullable();
            $table->time('time');
            $table->enum('export_format', ['pdf', 'excel', 'csv'])->default('pdf');
            $table->json('filters')->nullable();
            $table->json('recipients');
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_run_at')->nullable();
            $table->timestamp('next_run_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scheduled_reports');
    }
};
