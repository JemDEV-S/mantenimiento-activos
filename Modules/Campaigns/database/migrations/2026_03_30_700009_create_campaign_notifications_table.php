<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campaign_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('maintenance_campaign_id')->constrained('maintenance_campaigns')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users');
            $table->enum('tipo', ['inicio', 'recordatorio', 'avance', 'cierre', 'reprogramacion']);
            $table->enum('canal', ['database', 'email', 'broadcast'])->default('database');
            $table->text('mensaje');
            $table->datetime('read_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('campaign_notifications');
    }
};
