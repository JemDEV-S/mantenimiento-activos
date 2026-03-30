<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campaign_scope_filters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('maintenance_campaign_id')->constrained('maintenance_campaigns')->cascadeOnDelete();
            $table->enum('tipo', ['sede', 'gerencia', 'subgerencia', 'oficina', 'tipo_activo', 'estado_activo', 'criticidad', 'ultimo_mantenimiento']);
            $table->enum('operador', ['igual', 'diferente', 'mayor', 'menor', 'entre', 'en']);
            $table->text('valor');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campaign_scope_filters');
    }
};
