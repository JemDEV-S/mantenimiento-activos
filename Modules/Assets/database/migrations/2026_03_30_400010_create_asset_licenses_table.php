<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asset_licenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained('assets')->cascadeOnDelete();
            $table->string('nombre');
            $table->string('clave_licencia')->nullable();
            $table->enum('tipo', ['oem', 'retail', 'volumen', 'suscripcion']);
            $table->string('version')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->decimal('costo', 10, 2)->nullable();
            $table->enum('estado', ['activa', 'vencida', 'revocada'])->default('activa');
            $table->text('notas')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asset_licenses');
    }
};
