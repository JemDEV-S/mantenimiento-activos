<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asset_movements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_id');
            $table->enum('tipo', ['traslado', 'reasignacion', 'prestamo', 'devolucion', 'retiro', 'ingreso']);
            $table->unsignedBigInteger('sede_origen_id')->nullable();
            $table->unsignedBigInteger('oficina_origen_id')->nullable();
            $table->unsignedBigInteger('area_origen_id')->nullable();
            $table->unsignedBigInteger('ubicacion_origen_id')->nullable();
            $table->unsignedBigInteger('empleado_origen_id')->nullable();
            $table->unsignedBigInteger('sede_destino_id')->nullable();
            $table->unsignedBigInteger('oficina_destino_id')->nullable();
            $table->unsignedBigInteger('area_destino_id')->nullable();
            $table->unsignedBigInteger('ubicacion_destino_id')->nullable();
            $table->unsignedBigInteger('empleado_destino_id')->nullable();
            $table->text('motivo')->nullable();
            $table->enum('estado', ['solicitado', 'aprobado', 'en_transito', 'completado', 'cancelado'])->default('solicitado');
            $table->foreignId('autorizado_por')->nullable()->constrained('users');
            $table->unsignedBigInteger('documento_id')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asset_movements');
    }
};
