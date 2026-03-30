<?php

namespace Modules\Audit\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SystemEvent extends Model
{
    protected $fillable = [
        'tipo', 'severidad', 'fuente', 'titulo', 'descripcion',
        'datos_evento', 'estado', 'reconocido_por', 'resuelto_por',
        'notas_resolucion', 'reconocido_at', 'resuelto_at',
    ];

    protected $casts = [
        'datos_evento' => 'array',
        'reconocido_at' => 'datetime',
        'resuelto_at' => 'datetime',
    ];

    public function reconocidoPor(): BelongsTo { return $this->belongsTo(\App\Models\User::class, 'reconocido_por'); }
    public function resueltoPor(): BelongsTo { return $this->belongsTo(\App\Models\User::class, 'resuelto_por'); }
}
