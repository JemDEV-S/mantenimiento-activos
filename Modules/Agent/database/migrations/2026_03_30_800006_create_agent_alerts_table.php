<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agent_alerts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_device_id')->constrained('agent_devices')->cascadeOnDelete();
            $table->enum('tipo', ['cambio_hardware', 'disco_critico', 'ram_critica', 'equipo_offline', 'antivirus', 'software_no_autorizado', 'cambio_red', 'otro']);
            $table->enum('severidad', ['baja', 'media', 'alta', 'critica'])->default('media');
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->json('datos_alerta')->nullable();
            $table->enum('estado', ['nueva', 'vista', 'atendida', 'descartada'])->default('nueva');
            $table->foreignId('atendida_por')->nullable()->constrained('users');
            $table->text('notas_resolucion')->nullable();
            $table->timestamps();

            $table->index(['estado', 'severidad']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agent_alerts');
    }
};
