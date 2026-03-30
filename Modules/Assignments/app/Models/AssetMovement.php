<?php

namespace Modules\Assignments\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssetMovement extends Model
{
    protected $fillable = [
        'asset_id', 'tipo', 'sede_origen_id', 'oficina_origen_id',
        'area_origen_id', 'ubicacion_origen_id', 'empleado_origen_id',
        'sede_destino_id', 'oficina_destino_id', 'area_destino_id',
        'ubicacion_destino_id', 'empleado_destino_id', 'motivo', 'estado',
        'autorizado_por', 'documento_id', 'created_by',
    ];

    public function asset(): BelongsTo { return $this->belongsTo(\Modules\Assets\Models\Asset::class); }
    public function autorizadoPor(): BelongsTo { return $this->belongsTo(\App\Models\User::class, 'autorizado_por'); }
    public function createdBy(): BelongsTo { return $this->belongsTo(\App\Models\User::class, 'created_by'); }
}
