<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('dni')->unique();
            $table->string('nombres');
            $table->string('apellido_paterno');
            $table->string('apellido_materno');
            $table->string('email')->nullable();
            $table->string('telefono')->nullable();
            $table->string('cargo')->nullable();
            $table->enum('tipo_vinculo', ['nombrado', 'contratado', 'cas', 'locador', 'practicante']);
            $table->unsignedBigInteger('oficina_id')->nullable();
            $table->unsignedBigInteger('area_id')->nullable();
            $table->foreignId('user_id')->nullable()->unique()->constrained('users');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['apellido_paterno', 'apellido_materno', 'nombres']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
