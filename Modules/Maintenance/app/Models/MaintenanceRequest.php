<?php

namespace Modules\Maintenance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaintenanceRequest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'codigo', 'asset_id', 'solicitante_id', 'oficina_id',
        'maintenance_priority_id', 'tipo_solicitud', 'descripcion_problema',
        'sintomas', 'estado', 'fecha_asignacion', 'fecha_resolucion',
        'fecha_cierre', 'tecnico_id', 'notas_resolucion',
        'calificacion_satisfaccion', 'created_by',
    ];

    protected $casts = [
        'fecha_asignacion' => 'datetime',
        'fecha_resolucion' => 'datetime',
        'fecha_cierre' => 'datetime',
    ];

    public function asset(): BelongsTo { return $this->belongsTo(\Modules\Assets\Models\Asset::class); }
    public function solicitante(): BelongsTo { return $this->belongsTo(\Modules\Staff\Models\Employee::class, 'solicitante_id'); }
    public function oficina(): BelongsTo { return $this->belongsTo(\Modules\Organization\Models\Oficina::class); }
    public function priority(): BelongsTo { return $this->belongsTo(MaintenancePriority::class, 'maintenance_priority_id'); }
    public function tecnico(): BelongsTo { return $this->belongsTo(\Modules\Staff\Models\Tecnico::class); }
    public function orders(): HasMany { return $this->hasMany(MaintenanceOrder::class); }
    public function createdBy(): BelongsTo { return $this->belongsTo(\App\Models\User::class, 'created_by'); }
}
