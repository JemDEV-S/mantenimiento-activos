<?php

namespace Modules\Organization\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'codigo', 'nombre', 'oficina_id', 'responsable_id', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function oficina(): BelongsTo
    {
        return $this->belongsTo(Oficina::class);
    }

    public function responsable(): BelongsTo
    {
        return $this->belongsTo(\Modules\Staff\Models\Employee::class, 'responsable_id');
    }
}
