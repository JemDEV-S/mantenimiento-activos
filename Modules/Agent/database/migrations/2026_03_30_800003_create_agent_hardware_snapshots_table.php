<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agent_hardware_snapshots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_device_id')->constrained('agent_devices')->cascadeOnDelete();
            $table->string('hash');
            $table->string('hostname')->nullable();
            $table->string('fabricante')->nullable();
            $table->string('modelo')->nullable();
            $table->string('serial')->nullable();
            $table->json('bios')->nullable();
            $table->json('placa_base')->nullable();
            $table->json('procesador')->nullable();
            $table->integer('ram_total_mb')->nullable();
            $table->integer('ram_disponible_mb')->nullable();
            $table->json('ram_slots')->nullable();
            $table->json('discos')->nullable();
            $table->json('monitores')->nullable();
            $table->json('gpu')->nullable();
            $table->json('usb_dispositivos')->nullable();
            $table->json('perifericos')->nullable();
            $table->boolean('tiene_cambios')->default(false);
            $table->text('resumen_cambios')->nullable();
            $table->timestamps();

            $table->index(['agent_device_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agent_hardware_snapshots');
    }
};
