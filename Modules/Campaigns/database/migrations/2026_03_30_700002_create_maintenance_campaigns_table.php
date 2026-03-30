<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenance_campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre');
            $table->text('objetivo')->nullable();
            $table->text('descripcion')->nullable();
            $table->foreignId('campaign_status_id')->constrained('campaign_statuses');
            $table->unsignedBigInteger('maintenance_type_id');
            $table->enum('alcance', ['municipalidad', 'sede', 'gerencia', 'subgerencia', 'oficina', 'tipo_activo']);
            $table->date('fecha_inicio_planificada');
            $table->date('fecha_fin_planificada');
            $table->date('fecha_inicio_real')->nullable();
            $table->date('fecha_fin_real')->nullable();
            $table->integer('total_activos_programados')->default(0);
            $table->integer('total_atendidos')->default(0);
            $table->integer('total_pendientes')->default(0);
            $table->integer('total_observados')->default(0);
            $table->integer('total_fuera_servicio')->default(0);
            $table->decimal('costo_estimado', 12, 2)->default(0);
            $table->decimal('costo_ejecutado', 12, 2)->default(0);
            $table->decimal('cobertura_porcentual', 5, 2)->default(0);
            $table->integer('tiempo_promedio_atencion_minutos')->nullable();
            $table->text('resumen_cierre')->nullable();
            $table->text('recomendaciones')->nullable();
            $table->unsignedBigInteger('coordinador_id')->nullable();
            $table->foreignId('aprobado_por')->nullable()->constrained('users');
            $table->foreignId('cerrado_por')->nullable()->constrained('users');
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenance_campaigns');
    }
};
