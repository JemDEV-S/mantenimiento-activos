<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('system_events', function (Blueprint $table) {
            $table->id();
            $table->string('tipo');
            $table->enum('severidad', ['info', 'advertencia', 'error', 'critico'])->default('info');
            $table->enum('fuente', ['sistema', 'cola', 'agente', 'ia', 'scheduler', 'storage', 'otro'])->default('sistema');
            $table->string('titulo');
            $table->text('descripcion')->nullable();
            $table->json('datos_evento')->nullable();
            $table->enum('estado', ['nuevo', 'reconocido', 'resuelto', 'ignorado'])->default('nuevo');
            $table->foreignId('reconocido_por')->nullable()->constrained('users');
            $table->foreignId('resuelto_por')->nullable()->constrained('users');
            $table->text('notas_resolucion')->nullable();
            $table->datetime('reconocido_at')->nullable();
            $table->datetime('resuelto_at')->nullable();
            $table->timestamps();

            $table->index(['estado', 'severidad']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('system_events');
    }
};
