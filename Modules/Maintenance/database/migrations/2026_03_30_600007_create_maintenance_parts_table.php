<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenance_parts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('maintenance_record_id');
            $table->enum('tipo', ['repuesto', 'componente', 'consumible', 'accesorio']);
            $table->string('nombre');
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('serial_nuevo')->nullable();
            $table->string('serial_anterior')->nullable();
            $table->integer('cantidad')->default(1);
            $table->decimal('costo_unitario', 10, 2)->nullable();
            $table->decimal('costo_total', 10, 2)->nullable();
            $table->unsignedBigInteger('proveedor_id')->nullable();
            $table->enum('estado_instalacion', ['instalado', 'pendiente', 'devuelto'])->default('instalado');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenance_parts');
    }
};
