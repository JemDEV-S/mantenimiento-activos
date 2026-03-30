<?php

namespace Modules\Assets\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssetStatusHistory extends Model
{
    protected $fillable = [
        'asset_id', 'estado_anterior_id', 'estado_nuevo_id',
        'motivo', 'notas', 'motivo_baja_id', 'changed_by',
    ];

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }

    public function estadoAnterior(): BelongsTo
    {
        return $this->belongsTo(AssetStatus::class, 'estado_anterior_id');
    }

    public function estadoNuevo(): BelongsTo
    {
        return $this->belongsTo(AssetStatus::class, 'estado_nuevo_id');
    }

    public function motivoBaja(): BelongsTo
    {
        return $this->belongsTo(MotivoBaja::class);
    }

    public function changedBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'changed_by');
    }
}
