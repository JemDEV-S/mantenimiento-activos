<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_prompt_templates', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre');
            $table->enum('categoria', ['redaccion', 'resumen', 'diagnostico', 'clasificacion', 'consulta', 'informe', 'analisis']);
            $table->string('modulo')->nullable();
            $table->text('system_prompt');
            $table->text('user_prompt');
            $table->json('variables_requeridas')->nullable();
            $table->enum('formato_salida', ['texto', 'json', 'markdown'])->default('texto');
            $table->integer('version')->default(1);
            $table->text('ejemplo_resultado')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_prompt_templates');
    }
};
