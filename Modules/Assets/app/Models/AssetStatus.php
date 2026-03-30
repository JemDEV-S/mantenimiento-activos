<?php

namespace Modules\Assets\Models;

use Illuminate\Database\Eloquent\Model;

class AssetStatus extends Model
{
    protected $fillable = [
        'nombre', 'slug', 'color', 'permite_asignacion',
        'permite_mantenimiento', 'is_default', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'permite_asignacion' => 'boolean',
        'permite_mantenimiento' => 'boolean',
        'is_default' => 'boolean',
        'is_active' => 'boolean',
    ];
}
