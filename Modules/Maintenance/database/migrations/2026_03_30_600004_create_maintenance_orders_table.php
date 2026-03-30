<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenance_orders', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->unsignedBigInteger('maintenance_request_id')->nullable();
            $table->unsignedBigInteger('asset_id');
            $table->foreignId('maintenance_type_id')->constrained('maintenance_types');
            $table->foreignId('maintenance_priority_id')->constrained('maintenance_priorities');
            $table->unsignedBigInteger('campaign_asset_id')->nullable();
            $table->enum('estado', ['creada', 'programada', 'en_proceso', 'en_espera', 'completada', 'cerrada', 'cancelada'])->default('creada');
            $table->unsignedBigInteger('tecnico_id')->nullable();
            $table->unsignedBigInteger('supervisor_id')->nullable();
            $table->datetime('fecha_programada')->nullable();
            $table->datetime('fecha_inicio')->nullable();
            $table->datetime('fecha_fin')->nullable();
            $table->datetime('fecha_cierre')->nullable();
            $table->integer('duracion_estimada_minutos')->nullable();
            $table->integer('duracion_real_minutos')->nullable();
            $table->text('notas_internas')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
            $table->softDeletes();

            $table->index('asset_id');
            $table->index('estado');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenance_orders');
    }
};
