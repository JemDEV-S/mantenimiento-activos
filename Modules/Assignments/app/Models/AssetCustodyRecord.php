<?php

namespace Modules\Assignments\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssetCustodyRecord extends Model
{
    protected $fillable = [
        'asset_id', 'employee_id', 'ubicacion_id', 'tipo_custodia',
        'fecha_inicio', 'fecha_fin', 'is_vigente', 'notas',
    ];

    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
        'is_vigente' => 'boolean',
    ];

    public function asset(): BelongsTo { return $this->belongsTo(\Modules\Assets\Models\Asset::class); }
    public function employee(): BelongsTo { return $this->belongsTo(\Modules\Staff\Models\Employee::class); }
    public function ubicacion(): BelongsTo { return $this->belongsTo(\Modules\Organization\Models\Ubicacion::class); }
}
