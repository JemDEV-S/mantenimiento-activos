<?php

namespace Modules\Organization\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subgerencia extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'codigo', 'nombre', 'gerencia_id', 'responsable_id', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function gerencia(): BelongsTo
    {
        return $this->belongsTo(Gerencia::class);
    }

    public function responsable(): BelongsTo
    {
        return $this->belongsTo(\Modules\Staff\Models\Employee::class, 'responsable_id');
    }

    public function oficinas(): HasMany
    {
        return $this->hasMany(Oficina::class);
    }
}
