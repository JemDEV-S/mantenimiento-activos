<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_requests', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('ai_provider_id')->constrained('ai_providers');
            $table->foreignId('ai_prompt_template_id')->nullable()->constrained('ai_prompt_templates');
            $table->foreignId('ai_conversation_id')->nullable()->constrained('ai_conversations');
            $table->foreignId('user_id')->constrained('users');
            $table->string('modelo_usado');
            $table->string('categoria')->nullable();
            $table->string('modulo')->nullable();
            $table->string('contextable_type')->nullable();
            $table->unsignedBigInteger('contextable_id')->nullable();
            $table->text('system_prompt_enviado')->nullable();
            $table->text('user_prompt_enviado');
            $table->json('datos_contexto')->nullable();
            $table->integer('tokens_entrada')->nullable();
            $table->integer('tokens_salida')->nullable();
            $table->decimal('costo_estimado', 10, 6)->nullable();
            $table->integer('tiempo_respuesta_ms')->nullable();
            $table->enum('estado', ['pendiente', 'enviada', 'completada', 'fallida'])->default('pendiente');
            $table->text('error_message')->nullable();
            $table->timestamps();

            $table->index(['contextable_type', 'contextable_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_requests');
    }
};
