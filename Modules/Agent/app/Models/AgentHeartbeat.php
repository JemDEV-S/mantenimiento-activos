<?php

namespace Modules\Agent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgentHeartbeat extends Model
{
    protected $fillable = [
        'agent_device_id', 'ip_address', 'version_agente', 'uptime_seconds',
        'cpu_uso_porcentaje', 'ram_total_mb', 'ram_uso_mb', 'ram_uso_porcentaje',
        'disco_total_gb', 'disco_uso_gb', 'disco_uso_porcentaje',
        'conectividad_internet', 'estado_general', 'metricas_extra',
    ];

    protected $casts = ['conectividad_internet' => 'boolean', 'metricas_extra' => 'array'];

    public function device(): BelongsTo { return $this->belongsTo(AgentDevice::class, 'agent_device_id'); }
}
