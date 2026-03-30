<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agent_network_snapshots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_device_id')->constrained('agent_devices')->cascadeOnDelete();
            $table->string('hash');
            $table->json('adaptadores')->nullable();
            $table->string('ip_primaria')->nullable();
            $table->string('mac_primaria')->nullable();
            $table->string('gateway')->nullable();
            $table->json('dns')->nullable();
            $table->string('dominio')->nullable();
            $table->json('wifi')->nullable();
            $table->json('vpn')->nullable();
            $table->json('puertos_abiertos')->nullable();
            $table->boolean('tiene_cambios')->default(false);
            $table->text('resumen_cambios')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agent_network_snapshots');
    }
};
