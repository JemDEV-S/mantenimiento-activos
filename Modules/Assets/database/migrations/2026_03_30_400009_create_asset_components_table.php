<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asset_components', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained('assets')->cascadeOnDelete();
            $table->string('tipo');
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('numero_serie')->nullable();
            $table->string('capacidad')->nullable();
            $table->json('especificaciones')->nullable();
            $table->enum('estado', ['operativo', 'defectuoso', 'reemplazado'])->default('operativo');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asset_components');
    }
};
