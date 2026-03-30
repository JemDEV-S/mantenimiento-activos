<?php

namespace Modules\Assets\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssetComponent extends Model
{
    protected $fillable = [
        'asset_id', 'tipo', 'marca', 'modelo', 'numero_serie',
        'capacidad', 'especificaciones', 'estado',
    ];

    protected $casts = ['especificaciones' => 'array'];

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }
}
