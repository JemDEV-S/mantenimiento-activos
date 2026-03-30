<?php

namespace Modules\Audit\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class AuditTrail extends Model
{
    protected $fillable = [
        'uuid', 'user_id', 'tipo_evento', 'severidad', 'modulo',
        'auditable_type', 'auditable_id', 'accion', 'resumen',
        'estado_antes', 'estado_despues', 'contexto', 'is_system_event',
        'requiere_revision', 'revisado_por', 'notas_revision', 'revisado_at',
    ];

    protected $casts = [
        'estado_antes' => 'array',
        'estado_despues' => 'array',
        'contexto' => 'array',
        'is_system_event' => 'boolean',
        'requiere_revision' => 'boolean',
        'revisado_at' => 'datetime',
    ];

    public function user(): BelongsTo { return $this->belongsTo(\App\Models\User::class); }
    public function auditable(): MorphTo { return $this->morphTo(); }
    public function revisadoPor(): BelongsTo { return $this->belongsTo(\App\Models\User::class, 'revisado_por'); }
}
