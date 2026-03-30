<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('report_definitions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('module');
            $table->string('category');
            $table->string('query_class');
            $table->json('filters')->nullable();
            $table->json('columns')->nullable();
            $table->string('default_sort')->nullable();
            $table->enum('chart_type', ['none', 'bar', 'line', 'pie', 'doughnut', 'area'])->default('none');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('report_definitions');
    }
};
