<?php

namespace Modules\Maintenance\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenancePriority extends Model
{
    protected $fillable = [
        'nombre', 'slug', 'nivel', 'color', 'tiempo_respuesta_horas',
        'tiempo_resolucion_horas', 'is_active',
    ];
    protected $casts = ['is_active' => 'boolean'];
}
