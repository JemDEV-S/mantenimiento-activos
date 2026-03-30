<?php

namespace Modules\Organization\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sede extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'codigo', 'nombre', 'direccion', 'telefono', 'email',
        'latitud', 'longitud', 'is_active',
    ];

    protected $casts = [
        'latitud' => 'decimal:7',
        'longitud' => 'decimal:7',
        'is_active' => 'boolean',
    ];

    public function gerencias(): HasMany
    {
        return $this->hasMany(Gerencia::class);
    }

    public function oficinas(): HasMany
    {
        return $this->hasMany(Oficina::class);
    }

    public function ubicaciones(): HasMany
    {
        return $this->hasMany(Ubicacion::class);
    }
}
