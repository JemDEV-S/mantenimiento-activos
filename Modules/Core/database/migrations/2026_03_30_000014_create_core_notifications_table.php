<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('core_notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('channel', ['database', 'email', 'broadcast'])->default('database');
            $table->string('type');
            $table->string('notifiable_type');
            $table->unsignedBigInteger('notifiable_id');
            $table->string('sourceable_type')->nullable();
            $table->unsignedBigInteger('sourceable_id')->nullable();
            $table->string('subject')->nullable();
            $table->text('data');
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->index(['notifiable_type', 'notifiable_id']);
            $table->index(['sourceable_type', 'sourceable_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('core_notifications');
    }
};
