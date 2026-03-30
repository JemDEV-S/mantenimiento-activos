<?php

namespace Modules\Maintenance\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceType extends Model
{
    protected $fillable = ['nombre', 'slug', 'color', 'requiere_aprobacion', 'is_active'];
    protected $casts = ['requiere_aprobacion' => 'boolean', 'is_active' => 'boolean'];
}
