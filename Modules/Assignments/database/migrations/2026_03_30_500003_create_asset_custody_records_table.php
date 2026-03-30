<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asset_custody_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_id');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->unsignedBigInteger('ubicacion_id')->nullable();
            $table->enum('tipo_custodia', ['titular', 'temporal'])->default('titular');
            $table->datetime('fecha_inicio');
            $table->datetime('fecha_fin')->nullable();
            $table->boolean('is_vigente')->default(true);
            $table->text('notas')->nullable();
            $table->timestamps();

            $table->index(['asset_id', 'is_vigente']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asset_custody_records');
    }
};
