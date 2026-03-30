<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ubicaciones', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre');
            $table->text('referencia')->nullable();
            $table->foreignId('sede_id')->constrained('sedes');
            $table->foreignId('oficina_id')->nullable()->constrained('oficinas');
            $table->string('piso')->nullable();
            $table->string('edificio')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ubicaciones');
    }
};
