<?php

namespace Modules\Staff\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
    use SoftDeletes;

    protected $table = 'proveedores';

    protected $fillable = [
        'ruc', 'razon_social', 'nombre_comercial', 'contacto_nombre',
        'contacto_telefono', 'contacto_email', 'direccion', 'categoria',
        'notas', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];
}
