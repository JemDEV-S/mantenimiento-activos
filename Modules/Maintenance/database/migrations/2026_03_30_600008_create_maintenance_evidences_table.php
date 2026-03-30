<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenance_evidences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('maintenance_order_id')->nullable();
            $table->unsignedBigInteger('maintenance_record_id')->nullable();
            $table->enum('tipo', ['foto_antes', 'foto_durante', 'foto_despues', 'captura', 'documento', 'video', 'otro']);
            $table->enum('etapa', ['recepcion', 'diagnostico', 'proceso', 'entrega'])->nullable();
            $table->string('nombre_original');
            $table->string('file_path');
            $table->bigInteger('file_size')->nullable();
            $table->string('mime_type')->nullable();
            $table->foreignId('uploaded_by')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenance_evidences');
    }
};
