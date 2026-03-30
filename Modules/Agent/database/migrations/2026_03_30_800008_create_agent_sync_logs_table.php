<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agent_sync_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_device_id')->constrained('agent_devices')->cascadeOnDelete();
            $table->enum('tipo', ['heartbeat', 'hardware', 'software', 'red', 'alerta', 'registro']);
            $table->enum('estado', ['exitoso', 'fallido', 'parcial'])->default('exitoso');
            $table->integer('payload_size_bytes')->nullable();
            $table->integer('tiempo_respuesta_ms')->nullable();
            $table->string('ip_address')->nullable();
            $table->text('error_message')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agent_sync_logs');
    }
};
