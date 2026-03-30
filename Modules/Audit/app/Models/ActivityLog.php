<?php

namespace Modules\Audit\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ActivityLog extends Model
{
    protected $fillable = [
        'uuid', 'user_id', 'accion', 'modulo', 'auditable_type',
        'auditable_id', 'descripcion', 'valores_anteriores', 'valores_nuevos',
        'campos_modificados', 'ip_address', 'user_agent', 'session_id',
        'ruta', 'url', 'metodo_http', 'codigo_respuesta', 'duracion_ms',
    ];

    protected $casts = [
        'valores_anteriores' => 'array',
        'valores_nuevos' => 'array',
        'campos_modificados' => 'array',
    ];

    public function user(): BelongsTo { return $this->belongsTo(\App\Models\User::class); }
    public function auditable(): MorphTo { return $this->morphTo(); }
}
