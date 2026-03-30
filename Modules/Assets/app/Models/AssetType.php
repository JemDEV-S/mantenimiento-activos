<?php

namespace Modules\Assets\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssetType extends Model
{
    protected $fillable = [
        'asset_category_id', 'nombre', 'slug', 'descripcion',
        'atributos_por_defecto', 'vida_util_anios', 'is_active',
    ];

    protected $casts = ['atributos_por_defecto' => 'array', 'is_active' => 'boolean'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(AssetCategory::class, 'asset_category_id');
    }

    public function assets(): HasMany
    {
        return $this->hasMany(Asset::class);
    }

    public function modelos(): HasMany
    {
        return $this->hasMany(Modelo::class);
    }
}
