<?php

namespace Modules\Staff\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'codigo', 'dni', 'nombres', 'apellido_paterno', 'apellido_materno',
        'email', 'telefono', 'cargo', 'tipo_vinculo', 'oficina_id',
        'area_id', 'user_id', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function getNombreCompletoAttribute(): string
    {
        return "{$this->apellido_paterno} {$this->apellido_materno}, {$this->nombres}";
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function oficina(): BelongsTo
    {
        return $this->belongsTo(\Modules\Organization\Models\Oficina::class);
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo(\Modules\Organization\Models\Area::class);
    }

    public function tecnico(): HasOne
    {
        return $this->hasOne(Tecnico::class);
    }
}
