<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('modelos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('marca_id')->constrained('marcas')->cascadeOnDelete();
            $table->foreignId('asset_type_id')->nullable()->constrained('asset_types');
            $table->string('nombre');
            $table->string('numero_parte')->nullable();
            $table->json('especificaciones')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['marca_id', 'nombre']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('modelos');
    }
};
