<?php

namespace Modules\Assets\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Modelo extends Model
{
    protected $fillable = [
        'marca_id', 'asset_type_id', 'nombre', 'numero_parte',
        'especificaciones', 'is_active',
    ];

    protected $casts = ['especificaciones' => 'array', 'is_active' => 'boolean'];

    public function marca(): BelongsTo
    {
        return $this->belongsTo(Marca::class);
    }

    public function assetType(): BelongsTo
    {
        return $this->belongsTo(AssetType::class);
    }
}
