<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ai_conversations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('ai_provider_id')->constrained('ai_providers');
            $table->string('titulo')->nullable();
            $table->string('modulo')->nullable();
            $table->string('contextable_type')->nullable();
            $table->unsignedBigInteger('contextable_id')->nullable();
            $table->enum('estado', ['activa', 'cerrada', 'archivada'])->default('activa');
            $table->integer('total_mensajes')->default(0);
            $table->integer('total_tokens')->default(0);
            $table->decimal('costo_total', 10, 6)->default(0);
            $table->timestamps();

            $table->index(['contextable_type', 'contextable_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ai_conversations');
    }
};
