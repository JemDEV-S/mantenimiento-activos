<?php

namespace Modules\Assignments\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetAssignment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'asset_id', 'employee_id', 'oficina_id', 'area_id', 'ubicacion_id',
        'tipo', 'proposito', 'condiciones', 'fecha_asignacion',
        'fecha_devolucion_esperada', 'fecha_devolucion_real', 'estado',
        'documento_entrega_id', 'documento_devolucion_id', 'assigned_by',
    ];

    protected $casts = [
        'fecha_asignacion' => 'date',
        'fecha_devolucion_esperada' => 'date',
        'fecha_devolucion_real' => 'date',
    ];

    public function asset(): BelongsTo { return $this->belongsTo(\Modules\Assets\Models\Asset::class); }
    public function employee(): BelongsTo { return $this->belongsTo(\Modules\Staff\Models\Employee::class); }
    public function oficina(): BelongsTo { return $this->belongsTo(\Modules\Organization\Models\Oficina::class); }
    public function area(): BelongsTo { return $this->belongsTo(\Modules\Organization\Models\Area::class); }
    public function ubicacion(): BelongsTo { return $this->belongsTo(\Modules\Organization\Models\Ubicacion::class); }
    public function assignedBy(): BelongsTo { return $this->belongsTo(\App\Models\User::class, 'assigned_by'); }
}
