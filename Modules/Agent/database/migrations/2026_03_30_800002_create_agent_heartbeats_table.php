<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agent_heartbeats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_device_id')->constrained('agent_devices')->cascadeOnDelete();
            $table->string('ip_address')->nullable();
            $table->string('version_agente')->nullable();
            $table->bigInteger('uptime_seconds')->nullable();
            $table->decimal('cpu_uso_porcentaje', 5, 2)->nullable();
            $table->integer('ram_total_mb')->nullable();
            $table->integer('ram_uso_mb')->nullable();
            $table->decimal('ram_uso_porcentaje', 5, 2)->nullable();
            $table->decimal('disco_total_gb', 10, 2)->nullable();
            $table->decimal('disco_uso_gb', 10, 2)->nullable();
            $table->decimal('disco_uso_porcentaje', 5, 2)->nullable();
            $table->boolean('conectividad_internet')->default(true);
            $table->enum('estado_general', ['normal', 'advertencia', 'critico'])->default('normal');
            $table->json('metricas_extra')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agent_heartbeats');
    }
};
