<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('delivery_receipts', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->enum('tipo', ['entrega', 'devolucion']);
            $table->unsignedBigInteger('assignment_id')->nullable();
            $table->unsignedBigInteger('movement_id')->nullable();
            $table->unsignedBigInteger('entregado_por_employee_id')->nullable();
            $table->unsignedBigInteger('recibido_por_employee_id')->nullable();
            $table->date('fecha');
            $table->string('lugar')->nullable();
            $table->text('firma_entrega')->nullable();
            $table->text('firma_recepcion')->nullable();
            $table->text('observaciones')->nullable();
            $table->enum('estado', ['borrador', 'firmado', 'anulado'])->default('borrador');
            $table->unsignedBigInteger('document_id')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_receipts');
    }
};
