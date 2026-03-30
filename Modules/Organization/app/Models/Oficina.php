<?php

namespace Modules\Organization\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Oficina extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'codigo', 'nombre', 'subgerencia_id', 'sede_id',
        'responsable_id', 'piso', 'numero_ambiente', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function subgerencia(): BelongsTo
    {
        return $this->belongsTo(Subgerencia::class);
    }

    public function sede(): BelongsTo
    {
        return $this->belongsTo(Sede::class);
    }

    public function responsable(): BelongsTo
    {
        return $this->belongsTo(\Modules\Staff\Models\Employee::class, 'responsable_id');
    }

    public function areas(): HasMany
    {
        return $this->hasMany(Area::class);
    }
}
