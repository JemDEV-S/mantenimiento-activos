<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenance_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('maintenance_order_id');
            $table->unsignedBigInteger('asset_id');
            $table->unsignedBigInteger('tecnico_id');
            $table->datetime('fecha');
            $table->text('problema_reportado');
            $table->text('diagnostico')->nullable();
            $table->text('causa_raiz')->nullable();
            $table->text('acciones_realizadas')->nullable();
            $table->text('recomendaciones')->nullable();
            $table->enum('condicion_antes', ['bueno', 'regular', 'malo', 'inservible'])->nullable();
            $table->enum('condicion_despues', ['bueno', 'regular', 'malo', 'inservible'])->nullable();
            $table->unsignedBigInteger('nuevo_estado_id')->nullable();
            $table->date('fecha_proximo_mantenimiento')->nullable();
            $table->boolean('requiere_seguimiento')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenance_records');
    }
};
