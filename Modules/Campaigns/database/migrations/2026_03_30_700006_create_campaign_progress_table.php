<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campaign_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('maintenance_campaign_id')->constrained('maintenance_campaigns')->cascadeOnDelete();
            $table->date('fecha');
            $table->integer('atendidos_acumulado')->default(0);
            $table->integer('pendientes')->default(0);
            $table->integer('observados')->default(0);
            $table->integer('fuera_servicio')->default(0);
            $table->decimal('costo_acumulado', 12, 2)->default(0);
            $table->decimal('cobertura', 5, 2)->default(0);
            $table->text('notas')->nullable();
            $table->timestamps();

            $table->unique(['maintenance_campaign_id', 'fecha']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campaign_progress');
    }
};
