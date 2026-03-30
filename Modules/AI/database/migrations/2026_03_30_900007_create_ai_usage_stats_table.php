<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_usage_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ai_provider_id')->constrained('ai_providers');
            $table->date('fecha');
            $table->string('modulo')->nullable();
            $table->string('categoria')->nullable();
            $table->integer('total_solicitudes')->default(0);
            $table->integer('total_tokens_entrada')->default(0);
            $table->integer('total_tokens_salida')->default(0);
            $table->decimal('costo_total', 10, 6)->default(0);
            $table->integer('tiempo_promedio_ms')->nullable();
            $table->decimal('calificacion_promedio', 3, 2)->nullable();
            $table->integer('total_aceptadas')->default(0);
            $table->integer('total_rechazadas')->default(0);
            $table->timestamps();

            $table->unique(['ai_provider_id', 'fecha', 'modulo', 'categoria'], 'ai_usage_stats_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_usage_stats');
    }
};
