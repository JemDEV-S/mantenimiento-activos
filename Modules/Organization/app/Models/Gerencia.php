<?php

namespace Modules\Organization\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gerencia extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'codigo', 'nombre', 'abreviatura', 'sede_id',
        'responsable_id', 'sort_order', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function sede(): BelongsTo
    {
        return $this->belongsTo(Sede::class);
    }

    public function responsable(): BelongsTo
    {
        return $this->belongsTo(\Modules\Staff\Models\Employee::class, 'responsable_id');
    }

    public function subgerencias(): HasMany
    {
        return $this->hasMany(Subgerencia::class);
    }
}
