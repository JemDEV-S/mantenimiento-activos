<?php

namespace Modules\Agent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgentAlert extends Model
{
    protected $fillable = [
        'agent_device_id', 'tipo', 'severidad', 'titulo', 'descripcion',
        'datos_alerta', 'estado', 'atendida_por', 'notas_resolucion',
    ];

    protected $casts = ['datos_alerta' => 'array'];

    public function device(): BelongsTo { return $this->belongsTo(AgentDevice::class, 'agent_device_id'); }
    public function atendidaPor(): BelongsTo { return $this->belongsTo(\App\Models\User::class, 'atendida_por'); }
}
