<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_exports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->enum('formato', ['excel', 'pdf', 'csv', 'json']);
            $table->string('modulo');
            $table->string('tipo_entidad');
            $table->json('filtros_aplicados')->nullable();
            $table->integer('cantidad_registros')->default(0);
            $table->string('file_path')->nullable();
            $table->bigInteger('file_size')->nullable();
            $table->enum('estado', ['solicitado', 'procesando', 'completado', 'fallido', 'expirado'])->default('solicitado');
            $table->text('error_message')->nullable();
            $table->datetime('solicitado_at');
            $table->datetime('completado_at')->nullable();
            $table->datetime('expira_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_exports');
    }
};
