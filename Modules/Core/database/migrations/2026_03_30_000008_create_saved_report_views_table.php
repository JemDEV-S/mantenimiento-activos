<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('saved_report_views', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_definition_id')->constrained('report_definitions')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users');
            $table->string('name');
            $table->json('filters')->nullable();
            $table->json('columns')->nullable();
            $table->string('sort_by')->nullable();
            $table->enum('sort_direction', ['asc', 'desc'])->default('asc');
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saved_report_views');
    }
};
