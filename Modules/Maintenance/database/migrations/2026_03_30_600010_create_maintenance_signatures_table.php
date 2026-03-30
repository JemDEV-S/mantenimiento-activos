<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenance_signatures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('maintenance_order_id')->nullable();
            $table->unsignedBigInteger('maintenance_record_id')->nullable();
            $table->enum('tipo_firmante', ['tecnico', 'responsable', 'supervisor', 'usuario']);
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->string('nombre_firmante');
            $table->string('cargo_firmante')->nullable();
            $table->text('firma_digital')->nullable();
            $table->boolean('es_conforme')->default(true);
            $table->text('observaciones')->nullable();
            $table->string('ip_address')->nullable();
            $table->datetime('signed_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenance_signatures');
    }
};
