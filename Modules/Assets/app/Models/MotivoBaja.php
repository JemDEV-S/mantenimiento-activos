<?php

namespace Modules\Assets\Models;

use Illuminate\Database\Eloquent\Model;

class MotivoBaja extends Model
{
    protected $table = 'motivos_baja';

    protected $fillable = ['nombre', 'slug', 'descripcion', 'requiere_documento', 'is_active'];

    protected $casts = ['requiere_documento' => 'boolean', 'is_active' => 'boolean'];
}
