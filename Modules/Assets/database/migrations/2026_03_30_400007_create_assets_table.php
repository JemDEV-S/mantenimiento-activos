<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('codigo_interno')->unique()->nullable();
            $table->string('codigo_patrimonial')->unique()->nullable();
            $table->string('numero_serie')->nullable();
            $table->foreignId('asset_type_id')->constrained('asset_types');
            $table->foreignId('marca_id')->nullable()->constrained('marcas');
            $table->foreignId('modelo_id')->nullable()->constrained('modelos');
            $table->foreignId('asset_status_id')->constrained('asset_statuses');
            $table->unsignedBigInteger('ubicacion_id')->nullable();
            $table->unsignedBigInteger('oficina_id')->nullable();
            $table->unsignedBigInteger('area_id')->nullable();
            $table->unsignedBigInteger('responsable_id')->nullable();
            $table->unsignedBigInteger('proveedor_id')->nullable();
            $table->date('fecha_compra')->nullable();
            $table->date('fecha_garantia_fin')->nullable();
            $table->decimal('valor_compra', 12, 2)->nullable();
            $table->decimal('valor_actual', 12, 2)->nullable();
            $table->string('moneda')->default('PEN');
            $table->enum('criticidad', ['alta', 'media', 'baja'])->default('media');
            $table->enum('condicion', ['nuevo', 'bueno', 'regular', 'malo', 'inservible'])->default('bueno');
            $table->integer('frecuencia_mantenimiento_dias')->nullable();
            $table->text('notas')->nullable();
            $table->unsignedBigInteger('agent_device_id')->nullable();
            $table->foreignId('parent_asset_id')->nullable()->constrained('assets');
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
            $table->softDeletes();

            $table->index('asset_type_id');
            $table->index('asset_status_id');
            $table->index('oficina_id');
            $table->index('responsable_id');
            $table->index('numero_serie');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
