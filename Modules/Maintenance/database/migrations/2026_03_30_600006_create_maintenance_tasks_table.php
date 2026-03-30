<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenance_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('maintenance_order_id')->nullable();
            $table->unsignedBigInteger('maintenance_record_id')->nullable();
            $table->enum('tipo', ['diagnostico', 'limpieza', 'reparacion', 'reemplazo', 'actualizacion', 'configuracion', 'otro']);
            $table->text('descripcion');
            $table->enum('estado', ['pendiente', 'en_proceso', 'completada', 'cancelada'])->default('pendiente');
            $table->integer('tiempo_estimado_minutos')->nullable();
            $table->integer('tiempo_real_minutos')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenance_tasks');
    }
};
