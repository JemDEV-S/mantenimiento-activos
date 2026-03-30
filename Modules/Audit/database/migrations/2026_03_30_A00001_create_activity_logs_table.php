<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->enum('accion', ['create', 'update', 'delete', 'view', 'download', 'export', 'login', 'logout', 'assign', 'approve', 'generate', 'import']);
            $table->string('modulo');
            $table->string('auditable_type');
            $table->unsignedBigInteger('auditable_id');
            $table->text('descripcion')->nullable();
            $table->json('valores_anteriores')->nullable();
            $table->json('valores_nuevos')->nullable();
            $table->json('campos_modificados')->nullable();
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->string('session_id')->nullable();
            $table->string('ruta')->nullable();
            $table->text('url')->nullable();
            $table->string('metodo_http')->nullable();
            $table->integer('codigo_respuesta')->nullable();
            $table->integer('duracion_ms')->nullable();
            $table->timestamps();

            $table->index(['auditable_type', 'auditable_id']);
            $table->index(['user_id', 'created_at']);
            $table->index('modulo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
