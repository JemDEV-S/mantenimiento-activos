<?php

namespace Modules\Agent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgentNetworkSnapshot extends Model
{
    protected $fillable = [
        'agent_device_id', 'hash', 'adaptadores', 'ip_primaria', 'mac_primaria',
        'gateway', 'dns', 'dominio', 'wifi', 'vpn', 'puertos_abiertos',
        'tiene_cambios', 'resumen_cambios',
    ];

    protected $casts = [
        'adaptadores' => 'array', 'dns' => 'array', 'wifi' => 'array',
        'vpn' => 'array', 'puertos_abiertos' => 'array', 'tiene_cambios' => 'boolean',
    ];

    public function device(): BelongsTo { return $this->belongsTo(AgentDevice::class, 'agent_device_id'); }
}
