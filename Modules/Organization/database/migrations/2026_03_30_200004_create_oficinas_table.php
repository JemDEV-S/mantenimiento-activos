<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('oficinas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre');
            $table->foreignId('subgerencia_id')->constrained('subgerencias')->cascadeOnDelete();
            $table->foreignId('sede_id')->constrained('sedes');
            $table->unsignedBigInteger('responsable_id')->nullable();
            $table->string('piso')->nullable();
            $table->string('numero_ambiente')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('oficinas');
    }
};
