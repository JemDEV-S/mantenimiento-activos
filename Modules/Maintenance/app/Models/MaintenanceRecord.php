<?php

namespace Modules\Maintenance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MaintenanceRecord extends Model
{
    protected $fillable = [
        'maintenance_order_id', 'asset_id', 'tecnico_id', 'fecha',
        'problema_reportado', 'diagnostico', 'causa_raiz',
        'acciones_realizadas', 'recomendaciones', 'condicion_antes',
        'condicion_despues', 'nuevo_estado_id', 'fecha_proximo_mantenimiento',
        'requiere_seguimiento',
    ];

    protected $casts = [
        'fecha' => 'datetime',
        'fecha_proximo_mantenimiento' => 'date',
        'requiere_seguimiento' => 'boolean',
    ];

    public function order(): BelongsTo { return $this->belongsTo(MaintenanceOrder::class, 'maintenance_order_id'); }
    public function asset(): BelongsTo { return $this->belongsTo(\Modules\Assets\Models\Asset::class); }
    public function tecnico(): BelongsTo { return $this->belongsTo(\Modules\Staff\Models\Tecnico::class); }
    public function parts(): HasMany { return $this->hasMany(MaintenancePart::class); }
    public function tasks(): HasMany { return $this->hasMany(MaintenanceTask::class); }
    public function evidences(): HasMany { return $this->hasMany(MaintenanceEvidence::class); }
    public function signatures(): HasMany { return $this->hasMany(MaintenanceSignature::class); }
}
