<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campaign_assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('maintenance_campaign_id')->constrained('maintenance_campaigns')->cascadeOnDelete();
            $table->unsignedBigInteger('asset_id');
            $table->unsignedBigInteger('tecnico_id')->nullable();
            $table->enum('estado', ['programado', 'en_proceso', 'completado', 'observado', 'reprogramado', 'no_atendido', 'fuera_servicio'])->default('programado');
            $table->integer('numero_lote')->nullable();
            $table->string('zona')->nullable();
            $table->date('fecha_programada')->nullable();
            $table->date('fecha_atendida')->nullable();
            $table->unsignedBigInteger('maintenance_order_id')->nullable();
            $table->integer('prioridad')->default(0);
            $table->unsignedBigInteger('reprogramado_a_campaign_id')->nullable();
            $table->text('motivo_reprogramacion')->nullable();
            $table->timestamps();

            $table->index(['maintenance_campaign_id', 'estado']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campaign_assets');
    }
};
