<?php

namespace Modules\Assets\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AssetCategory extends Model
{
    protected $fillable = ['nombre', 'slug', 'descripcion', 'icono', 'sort_order', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];

    public function types(): HasMany
    {
        return $this->hasMany(AssetType::class);
    }
}
