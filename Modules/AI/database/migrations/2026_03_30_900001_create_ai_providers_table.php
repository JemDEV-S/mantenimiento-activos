<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_providers', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->enum('tipo', ['openai', 'anthropic', 'google', 'azure', 'ollama', 'custom']);
            $table->string('base_url')->nullable();
            $table->text('api_key_encrypted')->nullable();
            $table->string('modelo_default')->nullable();
            $table->json('modelos_disponibles')->nullable();
            $table->integer('max_tokens')->default(4096);
            $table->decimal('temperatura', 3, 2)->default(0.70);
            $table->integer('limite_diario')->nullable();
            $table->integer('limite_mensual')->nullable();
            $table->decimal('costo_por_input_token', 10, 8)->nullable();
            $table->decimal('costo_por_output_token', 10, 8)->nullable();
            $table->boolean('is_active')->default(true);
            $table->datetime('ultimo_health_check')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_providers');
    }
};
