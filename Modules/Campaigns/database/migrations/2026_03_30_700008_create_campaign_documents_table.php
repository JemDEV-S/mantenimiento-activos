<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campaign_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('maintenance_campaign_id')->constrained('maintenance_campaigns')->cascadeOnDelete();
            $table->unsignedBigInteger('document_id')->nullable();
            $table->enum('rol_documento', ['plan', 'informe_avance', 'informe_final', 'acta_individual', 'resumen_lote', 'aprobacion', 'cierre']);
            $table->string('titulo');
            $table->string('file_path')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campaign_documents');
    }
};
