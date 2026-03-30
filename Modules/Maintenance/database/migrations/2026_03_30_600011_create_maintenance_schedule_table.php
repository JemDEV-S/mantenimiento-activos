<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenance_schedule', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_id')->unique();
            $table->foreignId('maintenance_type_id')->constrained('maintenance_types');
            $table->integer('frecuencia_dias');
            $table->date('ultima_ejecucion')->nullable();
            $table->date('proxima_fecha')->nullable();
            $table->unsignedBigInteger('tecnico_id')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenance_schedule');
    }
};
