<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_trails', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->enum('tipo_evento', ['cambio_datos', 'acceso', 'seguridad', 'sistema', 'documento', 'sync_agente', 'interaccion_ia', 'accion_campana', 'operacion_masiva']);
            $table->enum('severidad', ['info', 'baja', 'media', 'alta', 'critica'])->default('info');
            $table->string('modulo');
            $table->string('auditable_type')->nullable();
            $table->unsignedBigInteger('auditable_id')->nullable();
            $table->string('accion');
            $table->text('resumen');
            $table->json('estado_antes')->nullable();
            $table->json('estado_despues')->nullable();
            $table->json('contexto')->nullable();
            $table->boolean('is_system_event')->default(false);
            $table->boolean('requiere_revision')->default(false);
            $table->foreignId('revisado_por')->nullable()->constrained('users');
            $table->text('notas_revision')->nullable();
            $table->datetime('revisado_at')->nullable();
            $table->timestamps();

            $table->index(['auditable_type', 'auditable_id']);
            $table->index(['tipo_evento', 'severidad']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_trails');
    }
};
