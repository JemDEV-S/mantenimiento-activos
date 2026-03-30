<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('clave')->unique();
            $table->text('valor')->nullable();
            $table->enum('tipo_dato', ['string', 'integer', 'boolean', 'json', 'text'])->default('string');
            $table->string('modulo')->nullable();
            $table->string('grupo')->nullable();
            $table->string('descripcion')->nullable();
            $table->text('valor_por_defecto')->nullable();
            $table->boolean('is_editable')->default(true);
            $table->boolean('is_sensitive')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
