<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ai_request_id')->constrained('ai_requests')->cascadeOnDelete();
            $table->text('respuesta_original');
            $table->text('respuesta_parseada')->nullable();
            $table->string('formato_salida')->nullable();
            $table->enum('accion_usuario', ['aceptada', 'editada', 'rechazada', 'ignorada', 'pendiente'])->default('pendiente');
            $table->text('contenido_editado')->nullable();
            $table->text('motivo_rechazo')->nullable();
            $table->tinyInteger('calificacion')->nullable();
            $table->boolean('es_util')->nullable();
            $table->string('aplicada_en_type')->nullable();
            $table->unsignedBigInteger('aplicada_en_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_responses');
    }
};
