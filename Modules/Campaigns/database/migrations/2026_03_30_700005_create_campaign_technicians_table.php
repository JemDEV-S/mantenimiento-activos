<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campaign_technicians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('maintenance_campaign_id')->constrained('maintenance_campaigns')->cascadeOnDelete();
            $table->unsignedBigInteger('tecnico_id');
            $table->enum('rol', ['lider', 'tecnico', 'apoyo'])->default('tecnico');
            $table->string('zona_asignada')->nullable();
            $table->unsignedBigInteger('sede_id')->nullable();
            $table->integer('numero_lote')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->integer('total_asignados')->default(0);
            $table->integer('total_completados')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campaign_technicians');
    }
};
