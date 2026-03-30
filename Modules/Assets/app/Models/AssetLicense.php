<?php

namespace Modules\Assets\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssetLicense extends Model
{
    protected $fillable = [
        'asset_id', 'nombre', 'clave_licencia', 'tipo', 'version',
        'fecha_inicio', 'fecha_vencimiento', 'costo', 'estado', 'notas',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_vencimiento' => 'date',
        'costo' => 'decimal:2',
    ];

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }
}
