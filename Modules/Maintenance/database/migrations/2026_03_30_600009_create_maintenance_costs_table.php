<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenance_costs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('maintenance_order_id');
            $table->enum('categoria', ['repuesto', 'mano_obra', 'traslado', 'tercero', 'otro']);
            $table->string('descripcion');
            $table->decimal('monto_estimado', 10, 2)->nullable();
            $table->decimal('monto_real', 10, 2)->nullable();
            $table->string('moneda')->default('PEN');
            $table->unsignedBigInteger('proveedor_id')->nullable();
            $table->string('numero_factura')->nullable();
            $table->enum('estado_aprobacion', ['pendiente', 'aprobado', 'rechazado'])->default('pendiente');
            $table->foreignId('aprobado_por')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenance_costs');
    }
};
