<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenance_requests', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->unsignedBigInteger('asset_id');
            $table->unsignedBigInteger('solicitante_id');
            $table->unsignedBigInteger('oficina_id')->nullable();
            $table->foreignId('maintenance_priority_id')->nullable()->constrained('maintenance_priorities');
            $table->enum('tipo_solicitud', ['incidencia', 'solicitud_preventivo', 'solicitud_revision']);
            $table->text('descripcion_problema');
            $table->text('sintomas')->nullable();
            $table->enum('estado', ['abierta', 'asignada', 'en_atencion', 'resuelta', 'cerrada', 'cancelada'])->default('abierta');
            $table->datetime('fecha_asignacion')->nullable();
            $table->datetime('fecha_resolucion')->nullable();
            $table->datetime('fecha_cierre')->nullable();
            $table->unsignedBigInteger('tecnico_id')->nullable();
            $table->text('notas_resolucion')->nullable();
            $table->tinyInteger('calificacion_satisfaccion')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
            $table->softDeletes();

            $table->index('asset_id');
            $table->index('estado');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenance_requests');
    }
};
