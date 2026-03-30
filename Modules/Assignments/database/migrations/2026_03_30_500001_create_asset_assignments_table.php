<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asset_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_id');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('oficina_id')->nullable();
            $table->unsignedBigInteger('area_id')->nullable();
            $table->unsignedBigInteger('ubicacion_id')->nullable();
            $table->enum('tipo', ['personal', 'area', 'oficina', 'temporal']);
            $table->text('proposito')->nullable();
            $table->text('condiciones')->nullable();
            $table->date('fecha_asignacion');
            $table->date('fecha_devolucion_esperada')->nullable();
            $table->date('fecha_devolucion_real')->nullable();
            $table->enum('estado', ['vigente', 'devuelto', 'transferido', 'cancelado'])->default('vigente');
            $table->unsignedBigInteger('documento_entrega_id')->nullable();
            $table->unsignedBigInteger('documento_devolucion_id')->nullable();
            $table->foreignId('assigned_by')->constrained('users');
            $table->timestamps();
            $table->softDeletes();

            $table->index('asset_id');
            $table->index('employee_id');
            $table->index('estado');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asset_assignments');
    }
};
