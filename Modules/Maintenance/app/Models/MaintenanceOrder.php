<?php

namespace Modules\Maintenance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaintenanceOrder extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'codigo', 'maintenance_request_id', 'asset_id', 'maintenance_type_id',
        'maintenance_priority_id', 'campaign_asset_id', 'estado', 'tecnico_id',
        'supervisor_id', 'fecha_programada', 'fecha_inicio', 'fecha_fin',
        'fecha_cierre', 'duracion_estimada_minutos', 'duracion_real_minutos',
        'notas_internas', 'created_by',
    ];

    protected $casts = [
        'fecha_programada' => 'datetime',
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
        'fecha_cierre' => 'datetime',
    ];

    public function request(): BelongsTo { return $this->belongsTo(MaintenanceRequest::class, 'maintenance_request_id'); }
    public function asset(): BelongsTo { return $this->belongsTo(\Modules\Assets\Models\Asset::class); }
    public function type(): BelongsTo { return $this->belongsTo(MaintenanceType::class, 'maintenance_type_id'); }
    public function priority(): BelongsTo { return $this->belongsTo(MaintenancePriority::class, 'maintenance_priority_id'); }
    public function tecnico(): BelongsTo { return $this->belongsTo(\Modules\Staff\Models\Tecnico::class); }
    public function supervisor(): BelongsTo { return $this->belongsTo(\Modules\Staff\Models\Employee::class, 'supervisor_id'); }
    public function record(): HasOne { return $this->hasOne(MaintenanceRecord::class); }
    public function tasks(): HasMany { return $this->hasMany(MaintenanceTask::class); }
    public function costs(): HasMany { return $this->hasMany(MaintenanceCost::class); }
    public function evidences(): HasMany { return $this->hasMany(MaintenanceEvidence::class); }
    public function signatures(): HasMany { return $this->hasMany(MaintenanceSignature::class); }
    public function createdBy(): BelongsTo { return $this->belongsTo(\App\Models\User::class, 'created_by'); }
}
