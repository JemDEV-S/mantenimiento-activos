<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asset_status_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained('assets')->cascadeOnDelete();
            $table->foreignId('estado_anterior_id')->nullable()->constrained('asset_statuses');
            $table->foreignId('estado_nuevo_id')->constrained('asset_statuses');
            $table->text('motivo')->nullable();
            $table->text('notas')->nullable();
            $table->foreignId('motivo_baja_id')->nullable()->constrained('motivos_baja');
            $table->foreignId('changed_by')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asset_status_histories');
    }
};
