<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agent_devices', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('token')->unique();
            $table->string('hostname')->nullable();
            $table->string('identificador')->nullable();
            $table->string('fabricante')->nullable();
            $table->string('modelo')->nullable();
            $table->string('serial')->nullable();
            $table->string('sistema_operativo')->nullable();
            $table->string('version_agente')->nullable();
            $table->unsignedBigInteger('asset_id')->nullable();
            $table->enum('estado_vinculacion', ['no_vinculado', 'vinculado', 'pendiente'])->default('no_vinculado');
            $table->boolean('is_online')->default(false);
            $table->string('ultima_ip')->nullable();
            $table->datetime('ultimo_heartbeat')->nullable();
            $table->datetime('primera_sincronizacion')->nullable();
            $table->datetime('ultima_sincronizacion')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index('asset_id');
            $table->index('is_online');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agent_devices');
    }
};
