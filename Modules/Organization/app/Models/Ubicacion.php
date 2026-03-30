<?php

namespace Modules\Organization\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ubicacion extends Model
{
    use SoftDeletes;

    protected $table = 'ubicaciones';

    protected $fillable = [
        'codigo', 'nombre', 'referencia', 'sede_id', 'oficina_id',
        'piso', 'edificio', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function sede(): BelongsTo
    {
        return $this->belongsTo(Sede::class);
    }

    public function oficina(): BelongsTo
    {
        return $this->belongsTo(Oficina::class);
    }
}
