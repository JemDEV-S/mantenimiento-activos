<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agent_software_snapshots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_device_id')->constrained('agent_devices')->cascadeOnDelete();
            $table->string('hash');
            $table->json('sistema_operativo')->nullable();
            $table->string('nombre_equipo_red')->nullable();
            $table->json('software_instalado')->nullable();
            $table->integer('software_conteo')->default(0);
            $table->json('antivirus')->nullable();
            $table->json('programas_inicio')->nullable();
            $table->json('actualizaciones_pendientes')->nullable();
            $table->boolean('tiene_cambios')->default(false);
            $table->text('resumen_cambios')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agent_software_snapshots');
    }
};
