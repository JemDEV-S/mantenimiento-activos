<?php

namespace Modules\Campaigns\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaintenanceCampaign extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'codigo', 'nombre', 'objetivo', 'descripcion', 'campaign_status_id',
        'maintenance_type_id', 'alcance', 'fecha_inicio_planificada',
        'fecha_fin_planificada', 'fecha_inicio_real', 'fecha_fin_real',
        'total_activos_programados', 'total_atendidos', 'total_pendientes',
        'total_observados', 'total_fuera_servicio', 'costo_estimado',
        'costo_ejecutado', 'cobertura_porcentual', 'tiempo_promedio_atencion_minutos',
        'resumen_cierre', 'recomendaciones', 'coordinador_id',
        'aprobado_por', 'cerrado_por', 'created_by',
    ];

    protected $casts = [
        'fecha_inicio_planificada' => 'date',
        'fecha_fin_planificada' => 'date',
        'fecha_inicio_real' => 'date',
        'fecha_fin_real' => 'date',
        'costo_estimado' => 'decimal:2',
        'costo_ejecutado' => 'decimal:2',
        'cobertura_porcentual' => 'decimal:2',
    ];

    public function status(): BelongsTo { return $this->belongsTo(CampaignStatus::class, 'campaign_status_id'); }
    public function maintenanceType(): BelongsTo { return $this->belongsTo(\Modules\Maintenance\Models\MaintenanceType::class); }
    public function coordinador(): BelongsTo { return $this->belongsTo(\Modules\Staff\Models\Employee::class, 'coordinador_id'); }
    public function aprobadoPor(): BelongsTo { return $this->belongsTo(\App\Models\User::class, 'aprobado_por'); }
    public function cerradoPor(): BelongsTo { return $this->belongsTo(\App\Models\User::class, 'cerrado_por'); }
    public function createdBy(): BelongsTo { return $this->belongsTo(\App\Models\User::class, 'created_by'); }
    public function scopeFilters(): HasMany { return $this->hasMany(CampaignScopeFilter::class, 'maintenance_campaign_id'); }
    public function assets(): HasMany { return $this->hasMany(CampaignAsset::class, 'maintenance_campaign_id'); }
    public function technicians(): HasMany { return $this->hasMany(CampaignTechnician::class, 'maintenance_campaign_id'); }
    public function progress(): HasMany { return $this->hasMany(CampaignProgress::class, 'maintenance_campaign_id'); }
    public function milestones(): HasMany { return $this->hasMany(CampaignMilestone::class, 'maintenance_campaign_id'); }
    public function campaignDocuments(): HasMany { return $this->hasMany(CampaignDocument::class, 'maintenance_campaign_id'); }
    public function notifications(): HasMany { return $this->hasMany(CampaignNotification::class, 'maintenance_campaign_id'); }
}
